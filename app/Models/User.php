<?php

namespace PhotoGallery\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function rules($isUpdate = false, $id = null)
    {
        if (!$isUpdate) {
            $rules = [
                'first_name'            => 'required',
                'last_name'             => 'required',
                'email'                 => 'required|email|unique:users,email',
                'password'              => 'required|min:6|confirmed'
            ];
        } else {
            $rules = [
                'first_name'            => 'required',
                'last_name'             => 'required'
            ];
        }
        return $rules;
    }

    public static $messages = [
        'first_name.required'   => 'First Name is required',
        'last_name.required'    => 'Last Name is required',
        'email.required'        => 'Email is required',
        'email.email'           => 'Email is invalid',
        'password.required'     => 'Password is required',
        'password.min'          => 'Password needs to have at least 6 characters'
    ];

    public function socialLogins()
    {
        return $this->hasMany('PhotoGallery\Models\SocialLogin', 'user_id', 'id');
    }

    public function isLinkedToSocialLogin($provider) 
    {
        foreach ($this->socialLogins as $socialLogin) {
            if ($socialLogin->provider == $provider) {
                return true;
            }
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany('PhotoGallery\Models\Role', 'user_roles', 'user_id', 'role_id')->withTimestamps();
    }

    public function hasRole($rolename)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $rolename) {
                return true;
            }
        }
        return false;
    }

    public function addRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }
}
