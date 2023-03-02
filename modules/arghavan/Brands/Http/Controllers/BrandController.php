<?php

namespace arghavan\Brands\Http\Controllers;

use App\Http\Controllers\Controller;
use arghavan\Brands\Database\Repositories\BrandRepo;
use arghavan\Brands\Models\Brand;
use arghavan\Brands\Http\Requests\BrandRequest;
use arghavan\Media\Services\MediaFileService;


class BrandController extends Controller
{
    public $brandRepo;
    public function __construct(BrandRepo $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    public function index()
    {
        $this->authorize('manage',Brand::class);
        $brands = $this->brandRepo->paginate();
        return view('Brand::index',compact('brands'));
    }

    public function store(BrandRequest $request)
    {
        $this->authorize('manage',Brand::class);
        $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $this->brandRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $this->authorize('manage',Brand::class);
        $brand = $this->brandRepo->findById($id);
        return view('Brand::edit',compact('brand'));
    }

    public function update($id,BrandRequest $request)
    {
        $this->authorize('manage',Brand::class);
        $brand = $this->brandRepo->findById($id);

        if($request->hasFile('image'))
        {
            $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            if($brand->image)
            {
                $brand->image->delete();
            }
        }
        else
        {
            $request->request->add(['media_id' => $brand->media_id]);
        }

        $this->brandRepo->update($id,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('brands.index');
    }

    public function destroy($id)
    {
        $this->authorize('manage',Brand::class);
        $this->brandRepo->delete($id);
    }
}
