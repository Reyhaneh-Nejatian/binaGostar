<?php

namespace arghavan\Payment\Repositories;

use arghavan\Payment\Models\Code;


class CodeRepo
{

    public function store($request)
    {
        return Code::create([
            'order_id' => $request->orderId,
            'code' => $request->code,
        ]);
    }

    public function findById($brandId)
    {
        return Code::query()->findOrFail($brandId);
    }

    public function update($id,$request)
    {
        return Code::query()->whereId($id)->update([
            'code' => $request->code,
        ]);
    }

    public function delete($orderId)
    {
        $code = $this->findById($orderId);
        $code->delete();
    }

}
