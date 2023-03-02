<?php


namespace arghavan\ProductAttributes\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use arghavan\ProductAttributes\Http\Requests\AttributeRequest;
use arghavan\ProductAttributes\Models\Attribute;
use arghavan\ProductAttributes\Repositories\AttributeRepo;
use arghavan\Product\Repositories\ProductRepo;


class AttributeController extends Controller
{
    public $attributeRepo;
    public $productRepo;

    public function __construct(AttributeRepo $attributeRepo , ProductRepo $productRepo)
    {
        $this->attributeRepo = $attributeRepo;
        $this->productRepo = $productRepo;
    }


    public function index()
    {
        $attributes = $this->attributeRepo->paginate();
        return view('ProductAttributes::index',compact('attributes'));
    }

    public function addAttribute($productId)
    {
        $product = $this->productRepo->findById($productId);
        $attributes = $this->attributeRepo->paginate();
        return view('ProductAttributes::index',compact('product','attributes'));
    }


    public function create()
    {
    }

    public function store(AttributeRequest $request)
    {
        $this->authorize('create',Attribute::class);
        $this->attributeRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->back();
    }

    public function show(){

    }

    public function edit($id)
    {
        $attribute = $this->attributeRepo->findById($id);
        $this->authorize('edit',$attribute);
        return view('ProductAttributes::edit',compact('attribute'));

    }

    public function update($id, AttributeRequest $request)
    {
        $attribute = $this->attributeRepo->findById($id);
        $this->authorize('edit',$attribute);
        $this->attributeRepo->update($id,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect(route('products.addAttribute',$request->id_product));
    }



    public function destroy($id)
    {
        $this->authorize('delete',Attribute::class);
        $this->attributeRepo->delete($id);
    }



}
