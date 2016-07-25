<?php 

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keyword';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
