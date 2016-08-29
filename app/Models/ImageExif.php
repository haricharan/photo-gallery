<?php 

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class ImageExif extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'image_exif';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'exif_id', 'value'];
}
