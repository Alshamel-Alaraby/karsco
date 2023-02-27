<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\CreateDocumentRequest;
use App\Http\Requests\Document\CreateFromAdminDocumentRequest;
use App\Http\Requests\Document\EditDocumentRequest;
use App\Http\Resources\Document\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentController extends Controller
{
    public function __construct(private \App\Repositories\Document\DocumentInterface$modelInterface)
    {
        $this->modelInterface = $modelInterface;
    }

    public function find($id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson(404, __('message.data not found'));
        }
        return responseJson(200, 'success', new DocumentResource($model));
    }


    public function all(Request $request)
    {
        $models = $this->modelInterface->all($request);
        return responseJson(200, 'success', DocumentResource::collection($models['data']), $models['paginate'] ? getPaginates($models['data']) : null);
    }




    public function create(CreateDocumentRequest $request)
    {
        $model = $this->modelInterface->create($request->validated());
        return responseJson(200, 'success');
    }



    public function update(EditDocumentRequest $request, $id)
    {
        $model = $this->modelInterface->find($id);
        if (!$model) {
            return responseJson( 404 , __('message.data not found'));
        }
        $this->modelInterface->update($request->validated(),$id);
        $model->refresh();
        return responseJson(200, 'success', new DocumentResource($model));

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
        $is_admin = $this->modelInterface->findWhereIsAdmin($id);
        if ($is_admin){
            return responseJson(404, 'No Delete Because is_admin = 1');

        }
        $this->modelInterface->delete($id);
        return responseJson(200, 'success');
    }

    public function bulkDelete(Request $request)
    {
        foreach ($request->ids as $id) {
            $is_admin = $this->modelInterface->findWhereIsAdmin($id);
            if (!$is_admin):
                $this->modelInterface->delete($id);
            endif;

        }
        return responseJson(200, __('Done'));


    }

    public function createFromAdmin(CreateFromAdminDocumentRequest $request)
    {
         return $this->modelInterface->createFromAdmin($request->validated());
        return responseJson(200, 'success');
    }
}
