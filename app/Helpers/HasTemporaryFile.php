<?php

namespace App\Helpers;

use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

trait HasTemporaryFile
{
    public function copyTemporaryFile($folder, $prefix = null)
    {
        $temporaryFile = TemporaryFile::whereFolder($folder)->first();
        if ($temporaryFile){
            $toPath = $this->generatePublicUploadPath($temporaryFile->filename, $prefix);

            $fromPath = '/temp/'.$temporaryFile->folder.'/'.$temporaryFile->filename;

            $storage = Storage::disk($temporaryFile->driver);
            $storage->copy($fromPath, $toPath);

            return str($toPath)->remove('/public')->remove('public');
        }
    }

    public function generatePublicUploadPath($filename, $prefix = null): string
    {
        $prefix = $prefix ? trim($prefix).'/' : null;
        return '/public/uploads/'.\Auth::id().'/'.date('y').'/'.date('m').'/'.$prefix.$filename;
    }
}
