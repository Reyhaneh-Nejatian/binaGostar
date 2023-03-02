<?php

namespace arghavan\Models\Database\Repositories;

use arghavan\Category\Models\Category;
use arghavan\Models\Models\Models;
use arghavan\Product\Models\Product;

class ModelRepo{

    public function all()
    {
        return Models::query()->get();
    }

    public function paginate()
    {
        return Models::query()->paginate(8);
    }

    public function latest()
    {
        return Models::query()->latest()->take(5)->get();
    }

    public function store($request)
    {
        return Models::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);
    }

    public function update($modelId,$request)
    {
         Models::query()->whereId($modelId)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);
    }

    public function delete($modelId)
    {
        $model = $this->findById($modelId);
        $model->delete();
    }

    public function findById($modelId)
    {
        return Models::query()->findOrFail($modelId);
    }

    public function models($menu)
    {
        $category = Category::query()->whereSlug($menu)->first('id');
        $models = Product::query()->where('category_id',$category->id)->pluck('model_id')->toArray();
        return Models::query()->whereIn('id',$models)->get();
    }

}
