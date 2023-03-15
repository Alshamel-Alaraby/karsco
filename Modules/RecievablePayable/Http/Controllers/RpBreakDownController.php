<?php

namespace Modules\RecievablePayable\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\RecievablePayable\Entities\RpBreakDown;
use Modules\RecievablePayable\Http\Requests\CreateBreakDownRequest;
use Modules\RecievablePayable\Transformers\BreakDownResource;

class RpBreakDownController extends Controller
{
    public function __construct(private RpBreakDown $model)
    {
        $this->model = $model;
    }

    public function show($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return responseJson(404, 'not found');
        }

        return responseJson(200, 'success', new BreakDownResource($model));
    }

    public function index(Request $request)
    {
        $models = $this->model->filter($request)->orderBy($request->order ? $request->order : 'updated_at', $request->sort ? $request->sort : 'DESC');

        if ($request->per_page) {
            $models = ['data' => $models->paginate($request->per_page), 'paginate' => true];
        } else {
            $models = ['data' => $models->get(), 'paginate' => false];
        }

        return responseJson(200, 'success', BreakDownResource::collection($models['data']), $models['paginate'] ? getPaginates($models['data']) : null);
    }

    public function store(CreateBreakDownRequest $request)
    {
        foreach ($request->validated()['break_downs'] as $break_downs ):
            $model = $this->model->create(array_merge($break_downs,['document_id'=>1]));
        endforeach;
        $model->refresh();

        return responseJson(200, 'success');
    }


}
