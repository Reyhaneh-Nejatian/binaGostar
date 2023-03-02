<?php


namespace arghavan\ProductAttributes\Repositories;


use arghavan\ProductAttributes\Models\Attribute;

class AttributeRepo
{

    public function store($request)
    {
        return Attribute::create([
              'attribute' => $request->name,
              'value' => $request->value,
              'product_id' => $request->id_product,
        ]);
    }

    public function paginate()
    {
        return Attribute::query()->paginate(10);
    }
//
    public function findById($attributeId)
    {
        return Attribute::query()->findOrFail($attributeId);
    }

    public function update($attributeId, $request)
    {
        return Attribute::query()->whereId($attributeId)->update([
            'attribute' => $request->name,
            'value' => $request->value,
        ]);
    }

    public function delete($attributeId)
    {
        $attribute = $this->findById($attributeId);
        $attribute->delete();
    }
}
