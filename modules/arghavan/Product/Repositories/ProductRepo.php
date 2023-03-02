<?php


namespace arghavan\Product\Repositories;


use arghavan\Category\Models\Category;
use arghavan\Product\Models\Product;

class ProductRepo
{

    public $query;
    public function __construct()
    {
        $this->query = Product::query()->where('confirmation_status',Product::CONFIRMATION_STATUS_ACCEPTED);
    }

    public function store($request)
    {
        if(is_null($request->typeSend)){
            $typeSend = 0;
        }else{
            $typeSend = 1;
        }
        return Product::create([
              'name' => $request->name,
              'priority' => $request->priority,
              'price' => $request->price,
              'discount' => $request->priceOff,
              'weight' => $request->weight,
              'numbers' => $request->numbers,
              'category_id' => $request->category_id,
              'brand_id' => $request->brand_id,
              'model_id' => $request->model_id,
              'image_id' => $request->image_id,
              'confirmation_status' => Product::CONFIRMATION_STATUS_PENDING,
              'description' => $request->description,
              'body' => $request->body,
              'post' => $typeSend,
        ]);
    }

    public function paginate()
    {
        return Product::query()->paginate(8);
    }

    public function paginateParents($status=null)
    {
        return $this->query->latest()->paginate(8);
    }

    public function searchStatus($status)
    {
        if($status)
            $this->query->where('confirmation_status',$status);
        return $this;
    }
    public function searchMenu($menu)
    {
        $category = Category::query()->whereSlug($menu)->first('id');
        return Product::query()->where('category_id',$category->id)->get();
    }

    public function filterBrand($brandId)
    {
        if($brandId)
            $this->query->where('brand_id',$brandId);
        return $this;
    }

    public function filterModel($modelId)
    {
        if($modelId)
            $this->query->where('model_id',$modelId);
        return $this;
    }
    public function filterPrice($price)
    {
        if($price)
            $this->query->where('price',$price);
        return $this;
    }

    public function findById($productId)
    {
        return Product::query()->findOrFail($productId);
    }
    public function find($productId)
    {
        return Product::query()->where('id',$productId)->where('confirmation_status',Product::CONFIRMATION_STATUS_ACCEPTED)->with('productImage','productAttribute')->get();
    }

    public function update($productId, $request)
    {
        if(is_null($request->typeSend)){
            $typeSend = 0;
        }else{
            $typeSend = 1;
        }
        return Product::query()->whereId($productId)->update([
            'name' => $request->name,
            'priority' => $request->priority,
            'price' => $request->price,
            'discount' => $request->priceOff,
            'weight' => $request->weight,
            'numbers' => $request->numbers,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'model_id' => $request->model_id,
            'image_id' => $request->image_id,
            'description' => $request->description,
            'body' => $request->body,
            'post' => $typeSend,
        ]);
    }

    public function delete($productId)
    {
        $product = $this->findById($productId);
        if($product->image){

            $product->image->delete();
        }
        $product->delete();
    }

    public function updateConfirmationStatus($productId, $status)
    {
        return Product::query()->whereId($productId)->update(['confirmation_status' => $status]);
    }

    public function product($value)
    {
//        dd($this->query->latest()->paginate(8));
        $category = Category::query()->whereSlug($value)->first('id');
        return $this->query->where('category_id',$category->id)->where('confirmation_status',Product::CONFIRMATION_STATUS_ACCEPTED)->get();
    }

    public function productNew()
    {
        return Product::query()->where('confirmation_status',Product::CONFIRMATION_STATUS_ACCEPTED)->latest()->take(8)->get();
    }
    public function proposal()
    {
        return Product::query()->where('confirmation_status',Product::CONFIRMATION_STATUS_ACCEPTED)->inRandomOrder()->take(8)->get();
    }

    public function all()
    {
        return Product::query()->get();
    }

    public function decreasingInventory($productId,$numbers)
    {
        $product = $this->findById($productId);
        Product::query()->where('id',$productId)->update([
            'numbers' => $product->numbers - $numbers,
        ]);
    }
}
