<?php

namespace arghavan\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use arghavan\Media\Services\MediaFileService;
use arghavan\RolePermissions\Repositories\RoleRepo;
use arghavan\User\Http\Requests\UpdateProfileInformationRequest;
use arghavan\User\Http\Requests\UpdateUserPhotoRequest;
use arghavan\User\Http\Requests\UpdateUserRequest;
use arghavan\User\Models\User;
use arghavan\User\Repositories\UserRepo;

class UserController extends Controller
{
    public $userRepo;
    public $roleRepo;
    public function __construct(UserRepo $userRepo, RoleRepo $roleRepo){

        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }
    public function index()
    {
        $this->authorize('index',User::class);
        $users = $this->userRepo
            ->searchStatus(request('status'))
            ->searchEmail(request('email'))
            ->searchName(request('name'))
            ->searchMobile(request('mobile'));
        $users = $users->paginateParents();

        $roles = $this->roleRepo->all();
        return view('User::Admin.index', compact('users','roles'));
    }

    public function create()
    {
        $roles = $this->roleRepo->all();
        return view('User::Admin.create',compact('roles'));
    }

    public function store(UpdateUserRequest $request)
    {
        if($request->hasFile('image')){
            $request->request->add(['image_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        }
        $this->userRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('users.index');
    }

    public function edit($userId)
    {
        $this->authorize('edit',User::class);
        $user = $this->userRepo->findById($userId);
        $roles = $this->roleRepo->all();
        return view('User::Admin.edit',compact('user','roles'));
    }
    public function update(UpdateUserRequest $request,$userId)
    {
        $this->authorize('edit',User::class);
        $user = $this->userRepo->findById($userId);
        if($request->hasFile('image')){
            $request->request->add(['image_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            if($user->image){
                $user->image->delete();
            }
        }else{
            $request->request->add(['image_id' => $user->image_id]);
        }

        $this->userRepo->update($userId,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('users.index');

    }

    public function manualVerify($userId)
    {
        $this->authorize('manualVerify',User::class);
        $user = $this->userRepo->findById($userId);
        $user->markEmailAsVerified();
    }

    public function profile()
    {
        $this->authorize('editProfile',User::class);
        return view('User::Admin.profile');
    }

    public function updateProfile(UpdateProfileInformationRequest $request)
    {
        $this->authorize('editProfile',User::class);
        $this->userRepo->updateProfile($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return back();
    }

    public function updatePhoto(UpdateUserPhotoRequest $request)
    {
        $this->authorize('editProfile',User::class);
        $media = MediaFileService::publicUpload($request->file('userPhoto'));

        if(auth()->user()->image) auth()->user()->image->delete();

        auth()->user()->image_id = $media->id;

        auth()->user()->save();
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');

        return back();

    }

    public function destroy($userId)
    {
        $this->authorize('delete',User::class);
        $user = $this->userRepo->findById($userId);
        $user->delete();
    }
}
