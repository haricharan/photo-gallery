<?php 

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSize extends Model
{

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
    protected $fillable = ['name', 'max_edge_length', 'is_active'];

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
