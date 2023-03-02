<?php

namespace arghavan\Slider\Database\Repositories;


use arghavan\Slider\Models\Slider;

class SliderRepo{

    public function all()
    {
        return Slider::query()->orderBy('priority')->get();
    }
    public function paginate()
    {
        return Slider::query()->paginate(5);
    }

    public function store($request)
    {
        return Slider::create([
            'user_id' => auth()->id(),
            'priority' => $request->priority,
            'media_id' => $request->media_id,
            'link' => $request->link,
            'status' => $request->status,
        ]);
    }

    public function update($sliderId,$request)
    {
         Slider::query()->whereId($sliderId)->update([
            'priority' => $request->priority,
            'media_id' => $request->media_id,
            'link' => $request->link,
            'status' => $request->status,
        ]);
    }

    public function delete($sliderId)
    {
        $slider = $this->findById($sliderId);

        if($slider->image){

            $slider->image->delete();
        }
        $slider->delete();
    }

    public function findById($sliderId)
    {
        return Slider::query()->findOrFail($sliderId);
    }

}
