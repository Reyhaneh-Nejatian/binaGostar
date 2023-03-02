<?php


namespace arghavan\ProductImage\Repositories;


use arghavan\ProductImage\Models\Image;

class ImageRepo
{

    public function store($request)
    {
        return Image::create([
              'product_id' => $request->id_product,
              'media_id' => $request->media_id,
              'status' => $request->status,
        ]);
    }

    public function paginate()
    {
        return Image::query()->paginate(5);
    }
//
    public function findById($imageId)
    {
        return Image::query()->findOrFail($imageId);
    }

    public function update($imageId, $request)
    {
        return Image::query()->whereId($imageId)->update([
            'media_id' => $request->media_id,
            'status' => $request->status,
        ]);
    }

    public function delete($imageId)
    {
        $image = $this->findById($imageId);
        $image->delete();
    }
}
