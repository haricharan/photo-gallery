<?php

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    protected $table = 'social_logins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'social_id', 'provider', 'token', 'nickname', 'email', 'avatar'];
}
