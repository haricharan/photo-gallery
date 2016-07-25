<?php 

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSize extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'image_sizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'max_width', 'max_height', 'is_active'];    

}
