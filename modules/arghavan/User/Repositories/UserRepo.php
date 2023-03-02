<?php


namespace arghavan\User\Repositories;


use arghavan\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepo
{
    public $query;
    public function __construct()
    {
        $this->query = User::query();
    }
    public function findByEmail($email)
    {
        return User::query()->where('email',$email)->first();
    }

    public function store($request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'username' => $request->username,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            'image_id' => $request->image_id,
        ]);
    }

    public function paginate()
    {
        return User::query()->paginate(3);
    }

    public function searchStatus($status)
    {
        if($status == 'approved')
        {
            $this->query->where('email_verified_at','!=', null);
        }
        elseif ($status == 'rejected')
        {
            $this->query->where('email_verified_at', '==', null);
        }
        return $this;
    }

    public function searchEmail($email)
    {
        if(!is_null($email))
            $this->query->where('email','like',"%" .$email. "%");
        return $this;
    }
    public function searchName($name)
    {
        if(!is_null($name))
            $this->query->where('name','like',"%" .$name. "%");
        return $this;

    }
    public function searchMobile($mobile)
    {
        if(!is_null($mobile))
            $this->query->where('mobile','like',"%" .$mobile. "%");
        return $this;

    }


    public function paginateParents($status=null)
    {
        return $this->query->latest()->paginate(3);
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function updateProfile($request)
    {
        if(auth()->user()->email != $request->email){

            auth()->user()->email = $request->email;
            auth()->user()->email_verified_at = null;
        }

        auth()->user()->username = $request->username;
        auth()->user()->mobile = $request->mobile;

        if($request->password){
            auth()->user()->password = Hash::make($request->password);
        }

        auth()->user()->save();
    }

    public function update($userId,$request)
    {
        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'username' => $request->username,
            'status' => $request->status,
            'image_id' => $request->image_id,
        ];

        if(! is_null($request->password)){
            $update['password'] = Hash::make($request->password);
        }

        $user = $this->findById($userId);
        $user->syncRoles([]);
        if($request['role']){
            $user->assignRole($request['role']);
        }

        return User::query()->whereId($userId)->update($update);
    }
}
