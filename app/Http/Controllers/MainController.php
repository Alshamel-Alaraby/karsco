<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Models\UserSettingScreen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MainController extends \Illuminate\Routing\Controller

{
    public function __construct(private UserSettingScreen $setting)
    {
        $this->setting = $setting;
    }

    public function removeMedia(Request $request, $id)
    {
        $media = Media::find($id);
        if ($media)
            $media->delete();

        return response()->json(true);
    }


    public function getS3SignedUrl(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string',
            'file_name' => 'required|string',
            'mime_type' => 'required|string',
            'size' => 'required|numeric',
        ]);

        // Get file name from request
        $fileName = Uuid::uuid4()->toString() . '.' . pathinfo($request->input('name'), PATHINFO_EXTENSION);
        $media = Media::create(
            [
                "model_type" => "App\Models\File",
                "model_id" => 1,
                "collection_name" => "media",
                "name" => $request->name,
                "file_name" => $fileName,
                "mime_type" => $request->mime_type,
                "disk" => "s3",
                "conversions_disk" => "s3",
                "size" => $request->size,
                "manipulations" => [],
                "custom_properties" => [],
                "responsive_images" => [],
                "generated_conversions" => '{"media":true}',
            ]);
        // Specify the folder where files should be uploaded
        $folder = 'karsco/' . $media->id . '/';
        // Generate a unique file name and prepend the folder path
        $uniqueFileName = $folder . $fileName;
        $contentType = $request->input('content_type', 'application/octet-stream');

        // Generate the pre-signed URL
        $url = $this->get_amazon_url($uniqueFileName, $contentType);

        return response()->json([
            'error' => false,
            'url' => $url,
            'fileName' => $uniqueFileName,
            'media' => new FileResource($media),
            'code' => 200,
        ], 200);
    }

    private function get_amazon_url($name, $contentType)
    {
        $client = Storage::disk('s3')->getClient();
        $expiry = "+50 minutes";
        $command = $client->getCommand('PutObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $name,
            'ContentType' => $contentType,
        ]);
        $request = $client->createPresignedRequest($command, $expiry);

        return (string)$request->getUri();
    }


    public function media(\App\Http\Requests\UploadMediaRequest $request)
    {
        if (is_array($request->media)) {
            $media = File::create();
            foreach ($request->media as $file) {
                $ext = $file->getClientOriginalExtension();
                $media->addMedia($file)->usingFileName(md5(uniqid()) . ".$ext")->toMediaCollection('media');
            }
            return responseJson(200, 'success', FileResource::collection($media->files));
        } else {
            if ($request->media) {
                $media = File::create();
                $file = $request->media;
                $ext = $file->getClientOriginalExtension();
                $media->addMedia($file)->usingFileName(md5(uniqid()) . ".$ext")->toMediaCollection('media');
                return responseJson(200, 'success', new FileResource($media->files[0]));
            }
        }

        if ($request->link && !$request->media) {
            $media = File::create();
            $media->addMediaFromUrl($request->link)->toMediaCollection('media');
            return responseJson(200, 'success', new FileResource($media->files[0]));
        }
        return responseJson(400, 'unsuccessful');
    }

    public function setting(Request $request)
    {

        \Illuminate\Support\Facades\DB::transaction(function () use ($request) {

            $model = $this->setting->where('user_id', $request['user_id'])->where('screen_id', $request['screen_id'])->first();

            $request['data_json'] = json_encode($request['data_json']);

            if (!$model) {
                $this->setting->create($request->all());
            } else {

                $model->update($request->all());
            }
        });

        return responseJson(200, 'success');
    }

    public function getSetting($user_id, $screen_id)
    {
        $model = $this->setting->where('user_id', $user_id)->where('screen_id', $screen_id)->first();
        return responseJson(200, 'success', new \App\Http\Resources\ScreenSetting\ScreenSettingResource($model));
    }

    public function statices()
    {
        $data = [
            "employees" => \App\Models\Employee::count(),
            "users" => \App\Models\User::count(),
            'salesmen' => \App\Models\Salesman::count(),
            'branches' => \App\Models\Branch::count(),

        ];
        return responseJson(200, 'success', $data);
    }

    public function dataTypes()
    {

        $data = \App\Models\DataType::all();
        return responseJson(200, 'success', \App\Http\Resources\DataTypeResource::collection($data));
    }

    public function sendEmail(SendEmailRequest $request)
    {
        $data = $request->validated();
        \Illuminate\Support\Facades\Mail::to($data['to'])->send(new \App\Mail\SendEmail($data));
        return responseJson(200, 'success');
    }

    public function getAllNot(Request $request)
    {
        $count = 15;
        $skip = 0;

        if ($request->skip) {
            $skip = $request->skip;
        }

        $Notifications = auth()->guard('api')->user()->notifications()->latest()->skip($skip)->limit($count)->get();
        $NotificationsCount = auth()->guard('api')->user()->notifications->count();

        return responseJson(200, 'success', ['notifications' => $Notifications, 'count' => $NotificationsCount]);
    }

    public function getNotNotRead()
    {
        $user = auth()->guard('api')->user();
        $Notifications = $user->unreadNotifications;
        $NotificationsCount = $Notifications->count();

        return responseJson(200, 'success', ['notifications' => $Notifications, 'count' => $NotificationsCount]);
    }

    public function clearItem($id)
    {

        DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);

        return responseJson(200, 'success', []);
    }

    public function clearAll()
    {
        $user = auth()->guard('api')->user();
        $user->unreadNotifications()->update(['read_at' => now()]);

        return responseJson(200, 'success', []);
    }


}
