<?php


namespace arghavan\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use arghavan\Brands\Database\Repositories\BrandRepo;
use arghavan\Models\Database\Repositories\ModelRepo;
use arghavan\Category\Repositories\CategoryRepo;
use arghavan\Media\Services\MediaFileService;
use arghavan\Product\Http\Requests\ProductRequest;
use arghavan\Product\Models\Product;
use arghavan\Product\Repositories\ProductRepo;

class ProductController extends Controller
{
    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values;
    public $productRepo;
    public $categoryRepo;
    public $brandRepo;
    public $modelRepo;

    public function __construct(ProductRepo $productRepo, CategoryRepo $categoryRepo, BrandRepo $brandRepo,ModelRepo $modelRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->brandRepo = $brandRepo;
        $this->modelRepo = $modelRepo;
    }

    public function add()
    {
        if(!in_array($this->attr,$this->attribute_arr))
        {
            array_push($this->inputs,$this->attr);
            array_push($this->attribute_arr,$this->attr);
        }
    }

    public function index()
    {
        $this->authorize('index',Product::class);
        $products = $this->productRepo
            ->searchStatus(request('status'));
        $products = $products->paginateParents();
        return view('Product::index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create',Product::class);
        $categories = $this->categoryRepo->all();
        $brands = $this->brandRepo->all();
        $models = $this->modelRepo->all();
        return view('Product::create', compact('categories','brands','models'));
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('create',Product::class);

        $files=[];
        foreach ($request->file('image') as $img)
        {

            $file = MediaFileService::publicUpload($img);
            $files[] = $file->id;

        }
        $files = implode(",",$files);
        $request->request->add(['image_id' => $files]);

        //            $request->request->add(['image_id' => MediaFileService::publicUpload($img)->id]);






//        $request->request->add(['image_id[]' => MediaFileService::publicUpload($image[])->id]);

        $this->productRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('products.index');
    }

    public function edit($productId)
    {
        $product = $this->productRepo->findById($productId);
        $this->authorize('edit',$product);
        $categories = $this->categoryRepo->all();
        $brands = $this->brandRepo->all();
        $models = $this->modelRepo->all();
        return view('Product::edit', compact('product', 'categories','brands','models'));
    }

    public function update($productId, ProductRequest $request)
    {
        $product = $this->productRepo->findById($productId);
        $this->authorize('edit',$product);

        if ($request->hasFile('image')) {
            $request->request->add(['image_id' => MediaFileService::publicUpload($request->file('image'))->id]);

            if ($product->image) {
                $product->image->delete();
            }
        } else {
            $request->request->add(['image_id' => $product->image_id]);
        }

        $this->productRepo->update($productId, $request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('products.index');
    }

    public function accept($productId)
    {
        $this->authorize('change_confirmation_status',Product::class);
        $this->productRepo->updateConfirmationStatus($productId, Product::CONFIRMATION_STATUS_ACCEPTED);
    }

    public function reject($productId)
    {
        $this->authorize('change_confirmation_status',Product::class);
        $this->productRepo->updateConfirmationStatus($productId, Product::CONFIRMATION_STATUS_REJECTED);
    }

    public function lock($productId)
    {
        $this->authorize('change_confirmation_status',Product::class);
        $this->productRepo->updateConfirmationStatus($productId,Product::CONFIRMATION_STATUS_PENDING);
    }

    public function destroy($productId)
    {
        $this->authorize('delete',Product::class);
        $this->productRepo->delete($productId);
    }

    public function single($id)
    {

    }

}
