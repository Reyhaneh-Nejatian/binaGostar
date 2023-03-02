<?php

namespace arghavan\Models\Http\Controllers;

use App\Http\Controllers\Controller;
use arghavan\Models\Database\Repositories\ModelRepo;
use arghavan\Models\Http\Requests\ModelRequest;
use arghavan\Models\Models\Models;


class ModelController extends Controller
{
    public $modelRepo;
    public function __construct(ModelRepo $modelRepo)
    {
        $this->modelRepo = $modelRepo;
    }

    public function index()
    {
        $this->authorize('manage',Models::class);
        $models = $this->modelRepo->paginate();
        return view('Model::index',compact('models'));
    }

    public function store(ModelRequest $request)
    {
        $this->authorize('manage',Models::class);
        $this->modelRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('models.index');
    }

    public function edit($id)
    {
        $this->authorize('manage',Models::class);
        $model = $this->modelRepo->findById($id);
        return view('Model::edit',compact('model'));
    }

    public function update($id,ModelRequest $request)
    {
        $this->authorize('manage',Models::class);
        $this->modelRepo->update($id,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('models.index');
    }

    public function destroy($id)
    {
        $this->authorize('manage',Models::class);
        $this->modelRepo->delete($id);
    }
}
