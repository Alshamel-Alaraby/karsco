<?php

namespace App\Http\Controllers\GeneralCustomer;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralCustomer\CreateGeneralCustomerRequest;
use App\Http\Requests\GeneralCustomer\EditGeneralCustomerRequest;
use App\Http\Resources\GeneralCustomer\GeneralCustomerResource;
use App\Repositories\GeneralCustomer\GeneralCustomerRepository;
use App\Repositories\GeneralCustomer\GeneralCustomerRepositoryInterface;
use App\Repositories\WorkflowHotfield\WorkflowHotfieldRepositoryInterface;
use App\Http\Resources\WorkflowHotfield\WorkflowHotfieldResource;
use App\Http\Requests\WorkflowHotfield\StoreWorkflowHotfieldRequest;
use App\Http\Requests\WorkflowHotfield\UpdateWorkflowHotfieldRequest;
use App\Http\Resources\ScreenSetting\ScreenSettingResource;
use App\Traits\BulkDeleteTrait;
use App\Traits\CanDeleteTrait;
use Mockery\Exception;
use Illuminate\Http\Request;

class GeneralCustomerController extends Controller
{
    use BulkDeleteTrait,CanDeleteTrait;

    protected $repository;
    protected $resource = GeneralCustomerResource::class;


    public function __construct(GeneralCustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        if (count($_GET) == 0) {
            $models = cacheGet('GeneralCustomer');

            if (!$models) {
                $models = $this->repository->all($request);
                cachePut('GeneralCustomer', $models);
            }
        } else {

            $models = $this->repository->all($request);
        }

        return responseJson(200, 'success', ($this->resource)::collection($models['data']), $models['paginate'] ? getPaginates($models['data']) : null);
    }


    public function show($id)
    {
        try{
            $model = cacheGet('GeneralCustomer_' . $id);

            if (!$model) {
                $model = $this->repository->find($id);
                if (!$model) {
                    return responseJson( 404 , __('message.data not found'));
                } else {
                    cachePut('GeneralCustomer_' . $id, $model);
                }
            }
            return responseJson(200 , __('Done'), new $this->resource($model));
        } catch (Exception $exception) {
            return responseJson( $exception->getCode() , $exception->getMessage());
        }
    }


    public function store(CreateGeneralCustomerRequest $request)
    {
        try {
            return responseJson(200 , __('Done') , $this->repository->create($request->validated()));
        } catch (Exception $exception) {
            return responseJson( $exception->getCode() , $exception->getMessage());
        }
    }


    public function update(EditGeneralCustomerRequest $request , $id)
    {
        try {
            $model = $this->repository->find($id);
            if (!$model) {
                return responseJson( 404 , __('message.data not found'));
            }
            $model = $this->repository->update($request->validated(), $id);

            return  responseJson(200 , __('Done'));
        } catch (Exception $exception) {
            return responseJson( $exception->getCode() , $exception->getMessage());
        }

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
        try {
            return responseJson(200 , __('Done') , $this->repository->setting($request->all()));
        } catch (Exception $exception) {
            return  responseJson( $exception->getCode() , $exception->getMessage());
        }
    }

    public function getScreenSetting($user_id , $screen_id)
    {
        try{
            $screenSetting = $this->repository->getSetting($user_id , $screen_id);
            if (!$screenSetting) {
                return responseJson( 404 , __('message.data not found'));
            }
            return responseJson( 200 , __('Done'), new ScreenSettingResource( $screenSetting ));
        } catch (Exception $exception) {
            return  responseJson( $exception->getCode() , $exception->getMessage());
        }
    }


}
