<?php

namespace App\Http\Controllers\GeneralCustomer;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralCustomer\CreateGeneralCustomerRequest;
use App\Http\Requests\GeneralCustomer\EditGeneralCustomerRequest;
use App\Http\Resources\GeneralCustomer\GeneralCustomerResource;
use App\Http\Resources\ScreenSetting\ScreenSettingResource;
use App\Repositories\GeneralCustomer\GeneralCustomerRepositoryInterface;
use App\Traits\BulkDeleteTrait;
use App\Traits\CanDeleteTrait;
use Illuminate\Http\Request;

class GeneralCustomerController extends Controller
{
    use BulkDeleteTrait, CanDeleteTrait;

    protected $repository;
    protected $resource = GeneralCustomerResource::class;

    public function __construct(GeneralCustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return "sss";
        // if (count($_GET) == 0) {
        //     $models = cacheGet('GeneralCustomer');

        //     if (!$models) {
        //         $models = $this->repository->all($request);
        //         cachePut('GeneralCustomer', $models);
        //     }
        // } else {

        //     $models = $this->repository->all($request);
        // }
        $models = $this->repository->all($request);

        return responseJson(200, 'success', ($this->resource)::collection($models['data']), $models['paginate'] ? getPaginates($models['data']) : null);
    }

    public function show($id)
    {

        // $model = cacheGet('GeneralCustomer_' . $id);

        // if (!$model) {
        //     $model = $this->repository->find($id);
        //     if (!$model) {
        //         return responseJson(404, __('message.data not found'));
        //     } else {
        //         cachePut('GeneralCustomer_' . $id, $model);
        //     }
        // }
        $model = $this->repository->find($id);
        if (!$model) {
            return responseJson(404, __('message.data not found'));
        }

        return responseJson(200, __('Done'), new $this->resource($model));

    }

    public function store(CreateGeneralCustomerRequest $request)
    {

        return responseJson(200, __('Done'), $this->repository->create($request->validated()));

    }

    public function update(EditGeneralCustomerRequest $request, $id)
    {

        $model = $this->repository->find($id);
        if (!$model) {
            return responseJson(404, __('message.data not found'));
        }
        $model = $this->repository->update($request->validated(), $id);

        return responseJson(200, __('Done'));

    }

    public function logs($id)
    {
        $model = $this->repository->find($id);
        if (!$model) {
            return responseJson(404, __('message.data not found'));
        }

        $logs = $this->repository->logs($id);
        return responseJson(200, 'success', \App\Http\Resources\Log\LogResource::collection($logs));

    }

    public function screenSetting(Request $request)
    {

        return responseJson(200, __('Done'), $this->repository->setting($request->all()));

    }

    public function getScreenSetting($user_id, $screen_id)
    {

        $screenSetting = $this->repository->getSetting($user_id, $screen_id);
        if (!$screenSetting) {
            return responseJson(404, __('message.data not found'));
        }
        return responseJson(200, __('Done'), new ScreenSettingResource($screenSetting));

    }

}
