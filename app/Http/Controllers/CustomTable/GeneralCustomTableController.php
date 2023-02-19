<?php

namespace App\Http\Controllers\CustomTable;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomTable\CustomTableRequest;
use App\Http\Resources\CustomTable\CustomTableResource;
use App\Models\GeneralCustomTable;
use App\Repositories\CustomTable\CustomTableInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralCustomTableController extends Controller
{

    public function __construct(private \App\Repositories\CustomTable\CustomTableInterface$modelInterface)
    {
        $this->modelInterface = $modelInterface;
    }

    public function find($id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson(404, __('message.data not found'));
        }
        return responseJson(200, 'success', new CustomTableResource($model));
    }


    public function all(Request $request)
    {
        $models = $this->modelInterface->all($request);
        return responseJson(200, 'success', CustomTableResource::collection($models['data']), $models['paginate'] ? getPaginates($models['data']) : null);
    }


    public function create(CustomTableRequest $request)
    {
        $model = $this->modelInterface->create($request->validated());
        $model->refresh();
        return responseJson(200, 'success', new CustomTableResource($model));
    }



    public function update(CustomTableRequest $request, $id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson( 404 , __('message.data not found'));
        }
        $this->modelInterface->update($request->validated(),$id);
        $model->refresh();
        return responseJson(200, 'success', new CustomTableResource($model));

    }
    public function logs($id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson(404, __('message.data not found'));
        }
        $logs = $this->modelInterface->logs($id);
        return responseJson(200, 'success', \App\Http\Resources\Log\LogResource::collection($logs));
    }


    public function delete($id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson(404, __('message.data not found'));
        }
        $this->model->delete($id);
        return responseJson(200, 'success');
    }

    public function bulkDelete(Request $request)
    {
        foreach ($request->ids as $id) {
            $this->modelInterface->delete($id);
        }
        return responseJson(200, __('Done'));


    }
}
