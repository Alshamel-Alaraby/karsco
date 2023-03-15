<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Models\UserSettingScreen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends \Illuminate\Routing\Controller

{

    public function __construct(private UserSettingScreen $setting)
    {
        $this->setting = $setting;
    }

    public function media(\App\Http\Requests\UploadMediaRequest$request)
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

        if($request->skip){
            $skip = $request->skip;
        }

        $Notifications = auth()->guard('api')->user()->notifications()->latest()->skip($skip)->limit($count)->get();
        $NotificationsCount = auth()->guard('api')->user()->notifications->count();

        return responseJson(200, 'success', ['notifications' => $Notifications,'count' => $NotificationsCount]);
    }

    public function getNotNotRead()
    {
        $user = auth()->guard('api')->user();
        $Notifications = $user->unreadNotifications;
        $NotificationsCount = $Notifications->count();

        return responseJson(200, 'success', ['notifications' => $Notifications,'count' => $NotificationsCount]);
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
