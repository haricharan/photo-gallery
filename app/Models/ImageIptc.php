<?php 

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class ImageIptc extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'image_iptc';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'iptc_id', 'value'];
}
