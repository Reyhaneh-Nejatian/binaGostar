<?php


namespace arghavan\Category\Repositories;


use arghavan\Category\Models\Category;
//use arghavan\ProductAttributes\Models\Image;

class CategoryRepo
{
    public function all()
    {
        return Category::all();
    }
    public function paginate()
    {
        return Category::paginate(10);
    }


    public function parent()
    {
        return Category::query()->where('parent_id',"!=",null)->with('parentCategory')->get();
    }

    public function store($value)
    {
        return Category::create([
            'title' => $value->title,
            'slug' => $value->slug,
            'parent_id' => $value->parent_id,
        ]);
    }

    public function delete($categoryId)
    {
        Category::query()->whereId($categoryId)->delete();
    }

    public function findById($categoryId)
    {
        return Category::findOrFail($categoryId);
    }


    public function allExceptById($categoryId)
    {
        return $this->all()->filter(fn ($item) => $item->id != $categoryId);
    }

    public function update($categoryId,$request)
    {
        return Category::whereId($categoryId)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
    }


    public function tree()
    {
        return Category::query()->where('parent_id',null)->with('subCategory')->get();
    }

    public function sub()
    {
        return Category::query()->where('sub_id','!=',null)->get();
    }
}
