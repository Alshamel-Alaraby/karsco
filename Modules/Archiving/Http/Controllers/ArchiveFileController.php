<?php

namespace Modules\Archiving\Http\Controllers;

use App\Http\Requests\AllRequest;
use App\Http\Requests\UpdateArchiveFileRequest;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Archiving\Entities\ArchiveFile;
use Modules\Archiving\Http\Requests\ArchiveFileRequest;
use Modules\Archiving\Http\Requests\ToggleFavouriteRequest;
use Modules\Archiving\Transformers\ArchiveFileResource;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArchiveFileController extends Controller
{

    public function __construct(private ArchiveFile $model, private Media $media)
    {
        $this->model = $model;
        $this->media = $media;
    }

    public function find($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return responseJson(404, 'not found');
        }

        return responseJson(200, 'success', new ArchiveFileResource($model));
    }

    public function all(AllRequest $request)
    {
        $models = $this->model->with("media")->where(function ($q) {
            $arch_doc_type_id=is_array(request()->arch_doc_type_id)?request()->arch_doc_type_id:[request()->arch_doc_type_id];
            if (request()->arch_doc_type_id) {
                $q->whereIn("arch_doc_type_id", $arch_doc_type_id);
            }
        })->filter($request)->orderBy($request->order ? $request->order : 'updated_at', $request->sort ? $request->sort : 'DESC');
        if ($request->search) {
            $search = "\"value\":\"$request->search\"";
            $models = $models->where('data_type_value', 'like', '%"is_reference":1%')->where('data_type_value', 'like', "%$search%");
        }



        
        if ($request->per_page) {
            $models = ['data' => $models->paginate($request->per_page), 'paginate' => true];
        } else {
            $models = ['data' => $models->get(), 'paginate' => false];
        }

        return responseJson(200, 'success', ArchiveFileResource::collection($models['data']), $models['paginate'] ? getPaginates($models['data']) : null);
    }

    public function create(ArchiveFileRequest $request)
    {
        $model = $this->model->create($request->validated());
        $model->refresh();
        return responseJson(200, 'created', new ArchiveFileResource($model));
    }

    public function update($id, UpdateArchiveFileRequest $request)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return responseJson(404, 'not found');
        }
        if ($request->media && !$request->old_media) { // if there is new media and no old media
            $model->clearMediaCollection('media');
            foreach ($request->media as $media) {
                uploadImage($media, [
                    'model_id' => $model->id,
                    'model_type' => get_class($this->model),
                ]);
            }
        }

        if ($request->old_media && !$request->media) { // if there is old media and no new media
            $model->media->whereNotIn('id', $request->old_media)->each(function (Media $media) {
                $media->delete();
            });
        }

        if ($request->old_media && $request->media) { // if there is old media and new media
            $model->media->whereNotIn('id', $request->old_media)->each(function (Media $media) {
                $media->delete();
            });
            foreach ($request->media as $image) {
                uploadImage($image, [
                    'model_id' => $model->id,
                    'model_type' => get_class($this->model),
                ]);
            }
        }
        if (!$request->old_media && !$request->media) { // if this is no old media and new media
            $model->clearMediaCollection('media');
        }

        $model->update($request->validated());
        $model->refresh();
        return responseJson(200, 'updated', new ArchiveFileResource($model));
    }

    public function logs($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return responseJson(404, 'not found');
        }

        $logs = $model->activities()->orderBy('created_at', 'DESC')->get();
        return responseJson(200, 'success', \App\Http\Resources\Log\LogResource::collection($logs));
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return responseJson(404, 'not found');
        }
        $model->delete();
        return responseJson(200, 'deleted');
    }

    public function bulkDelete()
    {

        $ids = request()->ids;
        if (!$ids) {
            return responseJson(400, 'ids is required');
        }
        $models = $this->model->whereIn('id', $ids)->get();
        if ($models->count() != count($ids)) {
            return responseJson(404, 'not found');
        }
        $models->each(function ($model) {
            $model->delete();
        });
        return responseJson(200, 'deleted');
    }

    public function pdf($id)
    {

        set_time_limit(0);

        $model = $this->model->find($id);

        if (!$model) {
            return responseJson(404, 'not found');
        }
        $path = public_path($model->data_type_value[0]->value . "-" . rand(1111, 999) . '.pdf');

        $data = [
            'id' => $model->id,
            "data_type_value" => $model->data_type_value,
            "media" => isset($model->files) ? \App\Http\Resources\FileResource::collection($model->files) : null,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            "media_count" => count((array) $model->files),
        ];
        Pdf::loadView('pdf', $data)->save($path);
        $model->addMedia($path)->toMediaCollection('media');
        $model->refresh();
        return responseJson(200, 'done', new ArchiveFileResource($model));
    }

    public function toggleFavourite(ToggleFavouriteRequest $request)
    {
        if ($request->type == "user") {
            $model = $this->model->find($request->arch_archive_file_id);
            if (!$model) {
                return responseJson(404, 'not found');
            }
            $favourite = $model->favourites()->where('user_id', $request->user_id)->first();
            if ($favourite) {
                $favourite->delete();
                return responseJson(200, 'removed from favourites');
            }
            $model->favourites()->create([
                'user_id' => $request->user_id,
            ]);
            return responseJson(200, 'added to favourites');
        } else {
            $model = $this->model->find($request->arch_archive_file_id);
            if (!$model) {
                return responseJson(404, 'not found');
            }
            $favourite = $model->favourites()->where('admin_id', $request->admin_id)->first();
            if ($favourite) {
                $favourite->delete();
                return responseJson(200, 'removed from favourites');
            }
            $model->favourites()->create([
                'admin_id' => $request->admin_id,
            ]);
            return responseJson(200, 'added to favourites');
        }

    }

}
