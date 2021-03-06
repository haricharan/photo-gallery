<?php 

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Iptc extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'iptc';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'tag_name', 'tag_name_php', 'is_active'];

    /**
     * Return IPTC tags as an array
     * 
     * @return array
     */
    public static function getAllTags()
    {
        $tags = Iptc::active()->get()->toArray();
        return array_flip(array_column($tags, 'tag_name_php', 'id'));
    }
    
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
