<?php


namespace arghavan\ProductImage\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use arghavan\Media\Services\MediaFileService;
use arghavan\ProductImage\Http\Requests\ImageRequest;
use arghavan\ProductImage\Models\Image;
use arghavan\ProductImage\Repositories\ImageRepo;
use arghavan\Product\Repositories\ProductRepo;


class ImageController extends Controller
{
    public $imageRepo;
    public $productRepo;

    public function __construct(ImageRepo $imageRepo , ProductRepo $productRepo)
    {
        $this->imageRepo = $imageRepo;
        $this->productRepo = $productRepo;
    }


    public function index()
    {
        $images = $this->imageRepo->paginate();
        return view('ProductImages::index',compact('images'));
    }

    public function addImage($productId)
    {
        $product = $this->productRepo->findById($productId);
        $images = $this->imageRepo->paginate();
        return view('ProductImages::index',compact('product','images'));
    }


    public function create()
    {
    }

    public function store(ImageRequest $request)
    {
        $this->authorize('create',Image::class);
        $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $this->imageRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->back();
    }

    public function show(){

    }

    public function edit($id)
    {
        $image = $this->imageRepo->findById($id);
        $this->authorize('edit',$image);
        return view('ProductImages::edit',compact('image'));

    }

    public function update($id, ImageRequest $request)
    {
        $image = $this->imageRepo->findById($id);
        $this->authorize('edit',$image);
        if($request->hasFile('image'))
        {
            $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            if($image->image)
            {
                $image->image->delete();
            }
        }
        else
        {
            $request->request->add(['media_id' => $image->media_id]);
        }
        $this->imageRepo->update($id,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect(route('products.addImage',$request->id_product));
    }



    public function destroy($id)
    {
        $this->authorize('delete',Image::class);
        $this->imageRepo->delete($id);
    }



}
