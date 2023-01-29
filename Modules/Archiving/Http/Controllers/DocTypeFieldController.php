<?php

namespace Modules\Archiving\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Archiving\Entities\DocTypeField;
use Modules\Archiving\Http\Requests\DocTypeFieldRequest;
use Modules\Archiving\Repositories\DocTypeFieldInterface;
use Modules\Archiving\Transformers\DocTypeFieldResource;

class DocTypeFieldController extends Controller
{
    public function __construct(private DocTypeFieldInterface $modelInterface)
    {
        $this->modelInterface = $modelInterface;
    }

    public function all(Request $request)
    {
        if (count($_GET) == 0) {
            $models = cacheGet('archDocTypeField');
            if (!$models) {
                $models = $this->modelInterface->all($request);
                cachePut('archDocTypeField', $models);
            }
        } else {
            $models = $this->modelInterface->all($request);
        }

        return responseJson(200, 'success', DocTypeFieldResource::collection($models['data']), $models['paginate'] ? getPaginates($models['data']) : null);
    }

    public function create(DocTypeFieldRequest $request)
    {
        $model = $this->modelInterface->create($request);
        return responseJson(200, 'success', new DocTypeFieldResource($model));
    }

    public function delete($id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson(404, 'data not found');
        }

        if ($model->hasChildren()) {
            return responseJson(400, __("this item has children and can't be deleted remove it's children first"));
        }

        $this->modelInterface->delete($id);

        return responseJson(200, 'success');
    }

    public function bulkDelete(Request $request)
    {
        foreach ($request->ids as $id) {
            $model = $this->modelInterface->find($id);
            if (!$model) {
                return responseJson(404, 'data not found');
            }
            if ($model->hasChildren()) {
                return responseJson(400, __("this item has children and can't be deleted remove it's children first"));
            }
            $this->modelInterface->delete($id);
        }
        return responseJson(200, __('Done'));
    }

    public function bulkInsert(Request $request)
    {
        DocTypeField::query()->insert($request->all());
        return responseJson(200, __('Done'));
    }

    public function bulkUpdate(Request $request)
    {
        foreach ($request->all() as $item) {
            DocTypeField::query ()->where ('doc_type_id',$item['doc_type_id'])->forceDelete ();
        }
        DocTypeField::query()->insert($request->all());
        return responseJson(200, __('Done'));
    }

    public function update(DocTypeFieldRequest $request, $id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson(404, 'data not found');
        }
        $this->modelInterface->update($request, $id);
        $model->refresh();
        return responseJson(200, 'success', new DocTypeFieldResource($model));
    }

    public function logs($id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson(404, 'not found');
        }

        $logs = $model->activities()->orderBy('created_at', 'DESC')->get();
        return responseJson(200, 'success', \App\Http\Resources\Log\LogResource::collection($logs));
    }
}
