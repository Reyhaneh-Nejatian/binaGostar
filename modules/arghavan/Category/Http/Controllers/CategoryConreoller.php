<?php

namespace arghavan\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use arghavan\Category\Http\Requests\CategoryRequest;
use arghavan\Category\Models\Category;
use arghavan\Category\Repositories\CategoryRepo;

class CategoryConreoller extends Controller
{
    public $categoryRepo;
    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    public function index()
    {
        $this->authorize('manage',Category::class);
        $categories = $this->categoryRepo->paginate();
        return view('Category::index',compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('manage',Category::class);
        $this->categoryRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return back();

    }

    public function edit($categoryId)
    {
        $this->authorize('manage',Category::class);
        $category = $this->categoryRepo->findById($categoryId);
        $categories = $this->categoryRepo->allExceptById($categoryId);
        return view('Category::edit',compact('category','categories'));
    }

    public function update($categoryId,CategoryRequest $request)
    {
        $this->authorize('manage',Category::class);
        $this->categoryRepo->update($categoryId,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect(route('categories.index'));
    }

    public function destroy($categoryId)
    {
        $this->authorize('manage',Category::class);
        $this->categoryRepo->delete($categoryId);
//        return toastr()->success('عملیات با موفقیت انجام شد!','موفق');
    }

    public function categoryAttr($categoryId)
    {
        return $attributes = $this->categoryRepo->getAttribute($categoryId);
    }
}
