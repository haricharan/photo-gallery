<?php

namespace PhotoGallery\Jobs;

use DateTime;
use Storage;
use PhotoGallery\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Intervention\Image\ImageManagerStatic as ImageManager;

class CheckInputDisk extends Job implements SelfHandling
{
    protected $inputDisk, $archiveDisk;
    protected $inputDiskPath, $archiveDiskPath;
    
    
    /**
    * Create a new job instance.
         *
         * @return void
         */
        public function __construct($inputDiskName, $archiveDiskName)
        {
            try {
                $this->inputDisk = Storage::disk($inputDiskName);
                $this->archiveDisk = Storage::disk($archiveDiskName);
                $this->inputDiskPath = $this->inputDisk->getDriver()->getAdapter()->getPathPrefix();
                $this->archiveDiskPath = $this->archiveDisk->getDriver()->getAdapter()->getPathPrefix();
            } catch (Exception $e) {
                \Log::error('Disk not found');
                \Log::error($e->getMessage());
            }
        }
    
    
    /**
    * Execute the job.
    *
    * @return void
    */
    public function handle()
    {
        foreach ($this->inputDisk->allFiles('/') as $filename) {
            try {
                $fileParts = pathinfo($filename);
                if ($fileParts['extension'] == 'jpg') {
                    \Debugbar::debug($filename);
                    $sourceFile = $this->inputDisk->get($filename);
                    $destFilePath = (new DateTime())->format('Ymd');
                    $imageHash = str_random(32);
                    $destFileName = $imageHash . '.' . $fileParts['extension'];

                    $this->archiveDisk->put(
                                    '/' . $destFilePath . '/' . $destFileName,
                                    $sourceFile);
            
                    \Log::debug($this->archiveDiskPath);
            
                    $image = \PhotoGallery\Models\Image::create([
                                    'filename' => $destFileName,
                                    'original_filename' => $fileParts['basename'],
                                    'path' => $destFilePath
                                ]);
                    \Log::info($this->archiveDiskPath);
                    $image->setExif($this->archiveDiskPath);
                    $image->setIptc($this->archiveDiskPath);
                }
            } catch (Exception $e) {
                \Log::error($e->getMessage());
            }
        }
    }
}
