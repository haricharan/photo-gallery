<?php

namespace PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as ImageManager;

class Image extends Model
{

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
     * @param string $archivePath
     */
    public function setExif($archivePath)
    {
        try {
            $destFileFullName = $archivePath . '/' . $this->path . '/' . $this->filename;
            $imageManager = ImageManager::make($destFileFullName);
            $exif_tags = \PhotoGallery\Models\Exif::getAllTags();
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
     * @param string $archivePath
     */
    public function setIptc($archivePath)
    {
        try {
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
        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
    * Create Image Copies
    *
    * @param string $archivePath
    */
    public function createCopies($archivePath, $destDir, $extension)
    {
        try {
            ImageManager::configure(array('driver' => 'imagick'));
            $orginalFileFullName = $archivePath . '/' . $this->path . '/' . $this->filename;
            $imageManager = ImageManager::make($orginalFileFullName);

            $iHeight = $imageManager->height();
            $iWidth = $imageManager->height();

            $imageSizes = ImageSize::active()->get();
            \Log::debug($imageSizes);
            foreach ($imageSizes as $imageSize) {
                if ($iWidth >= $iHeight) {
                    $newWidth = $imageSize->max_edge_length;
                    $newHeight = null;
                } 
                $newWidth = null;
                $newHeight = $imageSize->max_edge_length;

                $newImage = $imageManager->resize($newWidth, $newHeight, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $imageHash = str_random(32);
                // $destFileFullName = '/' . $destFilePath . '/' . $imageHash . '.' . $extension;
                $newImage->save($archivePath . '/' . $destDir . '/' . $imageHash . '.' . $extension, 100);

                $imageCopy = ImageCopy::create([
                                'image_id' => $this->id,
                                'image_size_id' => $imageSize->id,
                                'filename' => $imageHash . '.' . $extension
                            ]);
            }

        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
