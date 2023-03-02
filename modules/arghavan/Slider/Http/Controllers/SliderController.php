<?php

namespace arghavan\Slider\Http\Controllers;

use App\Http\Controllers\Controller;
use arghavan\Slider\Database\Repositories\SliderRepo;
use arghavan\Slider\Models\Slider;
use Illuminate\Http\Response;
use arghavan\Media\Services\MediaFileService;
use arghavan\Slider\Http\Requests\SliderRequest;
class SliderController extends Controller
{
    public $sliderRepo;
    public function __construct(SliderRepo $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }
    public function index()
    {
        $this->authorize('manage', Slider::class);
        $sliders = $this->sliderRepo->paginate();
        return view('Slider::index',compact('sliders'));
    }

    public function store(SliderRequest $request)
    {
        $this->authorize('manage', Slider::class);
        $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $this->sliderRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('sliders.index');
    }

    public function edit($id)
    {
        $this->authorize('manage', Slider::class);
        $slider = $this->sliderRepo->findById($id);
        return view('Slider::edit',compact('slider'));
    }

    public function update($sliderId,SliderRequest $request)
    {
        $this->authorize('manage', Slider::class);
        $slider = $this->sliderRepo->findById($sliderId);
        if($request->hasFile('image'))
        {
            $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            if($slider->image)
            {
                $slider->image->delete();
            }
        }
        else
        {
            $request->request->add(['media_id' => $slider->media_id]);
        }

        $this->sliderRepo->update($sliderId,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect(route('sliders.index'));
    }

    public function destroy($id)
    {
        $this->authorize('manage', Slider::class);
        $this->sliderRepo->delete($id);
    }
}
