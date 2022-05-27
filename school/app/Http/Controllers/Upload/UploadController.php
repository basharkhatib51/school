<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\UploadImageOrFileRequest;
use App\Http\Requests\Upload\UploadImageRequest;
use App\Models\Upload;
use App\Traits\UploadFile;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    use UploadFile;

    /**
     * upload image.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function base64(Request $request): JsonResponse{
        $path=$this->addBase64($request->image);

        return $this->Data(['url' => $path]);
    }
    public function upload_image(UploadImageRequest $request): JsonResponse
    {
        $uploadedFile = $request->file('file');
        $folderName = 'uploads/image/'.Carbon::now()->format('Y-m-d');
        $extension = $uploadedFile->getClientOriginalExtension();
        $filename = time() . uniqid() . '.' . $extension;
        $Media = new Upload();
        $Media->url = $folderName . '/' . $filename;
        $Media->real_path = $uploadedFile->getRealPath();
        $Media->size = $uploadedFile->getSize();
        $Media->mime_type = $uploadedFile->getMimeType();
        $Media->type = 'Image';
        $Media->generated_name = $filename;
        $Media->original_name = $uploadedFile->getClientOriginalName();
        $Media->extension = $extension;
        $Media->save();
        Storage::disk('public')->putFileAs(
            $folderName,
            $uploadedFile,
            $filename
        );
        return $this->Data(['image' => $Media]);
    }
    public function upload_image_or_file(UploadImageOrFileRequest $request): JsonResponse
    {
        $uploadedFile = $request->file('file');
//        dd($uploadedFile);
        $folderName = 'uploads/chat/'.Carbon::now()->format('Y-m-d');
        $filename = time() . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $Media = new Upload();
        $Media->url = $folderName . '/' . $filename;
        $Media->real_path = $uploadedFile->getRealPath();
        $Media->size = $uploadedFile->getSize();
        $Media->mime_type = $uploadedFile->getMimeType();
        $Media->type = $uploadedFile->getType();
        if($Media->mime_type!=='application/pdf')
        $Media->type = 'image';
        $Media->generated_name = $filename;
        $Media->original_name = $uploadedFile->getClientOriginalName();
        $Media->extension = $uploadedFile->getClientOriginalExtension();
        $Media->save();
        Storage::disk('public')->putFileAs(
            $folderName,
            $uploadedFile,
            $filename
        );
        return $this->Data(['file' => $Media]);
    }
    public function image(Upload $upload): JsonResponse
    {
        return $this->Data(['image' => $upload]);
    }
}
