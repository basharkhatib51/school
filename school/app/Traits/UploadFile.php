<?php

namespace App\Traits;

use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hash;

trait UploadFile
{
    protected $folderPath = "uploads/quill/";

    public function addBase64($addBase64)
    {
        $image_parts = explode(";base64,", $addBase64);
        if (count($image_parts) == 1)
            return false;
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $path = $this->folderPath . uniqid() . '.' . $image_type;
        file_put_contents($path, $image_base64);
        return "/$path";
    }

}
