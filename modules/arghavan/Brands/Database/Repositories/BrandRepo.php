<?php

namespace arghavan\Brands\Database\Repositories;


use arghavan\Brands\Models\Brand;
use arghavan\Category\Models\Category;
use arghavan\Product\Models\Product;

class BrandRepo{

    public function all()
    {
        return Brand::query()->get();
    }

    public function paginate()
    {
        return Brand::query()->paginate(8);
    }

    public function latest()
    {
        return Brand::query()->latest()->take(5)->get();
    }

    public function store($request)
    {
        return Brand::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'media_id' => $request->media_id,
            'status' => $request->status,
        ]);
    }

    public function update($brandId,$request)
    {
         Brand::query()->whereId($brandId)->update([
            'name' => $request->name,
            'media_id' => $request->media_id,
            'status' => $request->status,
        ]);
    }

    public function delete($brandId)
    {
        $slider = $this->findById($brandId);

        if($slider->image){

            $slider->image->delete();
        }
        $slider->delete();
    }

    public function findById($brandId)
    {
        return Brand::query()->findOrFail($brandId);
    }

    public function brands($menu)
    {
        $category = Category::query()->whereSlug($menu)->first('id');
        $brands = Product::query()->where('category_id',$category->id)->pluck('brand_id')->toArray();
        return Brand::query()->whereIn('id',$brands)->get();
    }

}
