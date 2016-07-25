<?php

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as ImageManager;

class Image extends Model
{
    //     /**
//      * The database table used by the model.
//      *
//      * @var string
//      */
//     protected $table = 'image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['filename', 'original_filename', 'path'];

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return static
     */
     public static function create(array $attributes = [])
     {
         return parent::create($attributes);
     }

    /**
     * Set Exif for Image
     *
     * @var array
     */
    public function setExif($archivePath)
    {
        try {
            \Log::debug('in setExif');
            \Log::debug($this->path);
            \Log::debug($this->filename);
            $destFileFullName = $archivePath . '/' . $this->path . '/' . $this->filename;
            \Log::debug($destFileFullName);
            $imageManager = ImageManager::make($destFileFullName);
            \Log::debug($imageManager);
            $exif_tags = \PhotoGallery\Models\Exif::getAllTags();

            \Log::debug($exif_tags);

            $exif = $imageManager->exif();
            $exif_merged = array_combine(
            array_intersect_key($exif_tags, $exif),
            array_intersect_key($exif, $exif_tags));
            while (list($id, $val) = each($exif_merged)) {
                if (isset($val)) {
                    \PhotoGallery\Models\ImageExif::create([
                    'image_id' => $this->id,
                    'exif_id' => $id,
                    'value' => $val
                ]);
                }
            }
        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
     * Set Iptc for Image
     *
     * @var array
     */
    public function setIptc($archivePath)
    {
        $destFileFullName = $archivePath . '/' . $this->path . '/' . $this->filename;
        $imageManager = ImageManager::make($destFileFullName);
        $iptc_tags = \PhotoGallery\Models\Iptc::getAllTags();
        
        $iptc = $imageManager->iptc();
        $iptc_merged = array_combine(
            array_intersect_key($iptc_tags, $iptc),
            array_intersect_key($iptc, $iptc_tags));
        while (list($id, $val) = each($iptc_merged)) {
            if (isset($val)) {
                \PhotoGallery\Models\ImageIptc::create([
                    'image_id' => $this->id,
                    'iptc_id' => $id,
                    'value' => $val
                ]);
            }
        }
    }
}
