<?php 

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class ImageCopy extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'image_copies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'image_size_id', 'filename'];
}
