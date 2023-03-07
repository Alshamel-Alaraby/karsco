<?php

namespace Modules\RecievablePayable\Repositories;

use App\Models\UserSettingScreen;
use Illuminate\Support\Facades\DB;
use Modules\RealEstate\Entities\PropertyType;
use Modules\RecievablePayable\Entities\RpDocumentPlan;
use Modules\RecievablePayable\Entities\RpInstallmentPaymentPlanDetail;
use Modules\RecievablePayable\Entities\RpInstallmentPaymentType;
use Modules\RecievablePayable\Entities\RpInstallmentStatus;
use Modules\RecievablePayable\Entities\RpMainContactGroup;
use Modules\RecievablePayable\Entities\RpOpeningBalance;
use Modules\RecievablePayable\Entities\RpSubContactGroup;
use Modules\Stock\Entities\OpenningBalance;

class RpOpeningBalanceRepository implements RpOpeningBalanceInterface
{

    private $model;
    private $setting;

    public function __construct(RpOpeningBalance $model, UserSettingScreen $setting)
    {
        $this->model = $model;
        $this->setting = $setting;
    }

    public function all($request)
    {
        $models = $this->model->where(function ($q) use ($request) {
            $this->model->scopeFilter($q , $request);
        })->orderBy($request->order ? $request->order : 'updated_at', $request->sort ? $request->sort : 'DESC');

        if ($request->group){
            $models->groupBy('date')->selectRaw('sum(local_credit) as total_local_credit,sum(local_debit) as total_local_debit,date,COUNT(id) as count')->orderBy('date','desc');
        }
        if ($request->per_page) {
            return ['data' => $models->paginate($request->per_page), 'paginate' => true];
        } else {
            return ['data' => $models->get(), 'paginate' => false];
        }
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($request)
    {

       return DB::transaction(function () use ($request) {
            $data = [];
            foreach ($request['opening_balances'] as $opening_balances):
                $model = $this->model->create($opening_balances);
                $data[] = $model;
            endforeach;
            return $data;
        });
    }

    public function update($request, $date)
    {

        DB::transaction(function () use ($date, $request) {
            $model_dates= $this->model->where('date',$date)->get();
            foreach ($model_dates as $model_date):
                $model_date->delete();
            endforeach;
            foreach ($request['opening_balances'] as $opening_balances):
                $model = $this->model->create($opening_balances);
            endforeach;
        });

    }

    public function delete($id)
    {
        $model = $this->find($id);
        $model->delete();
    }


    public function setting($request)
    {

        DB::transaction(function () use ($request) {

            $model = $this->setting->where('user_id', $request['user_id'])->where('screen_id', $request['screen_id'])->first();

            $request['data_json'] = json_encode($request['data_json']);

            if (!$model) {
                $this->setting->create($request->all());
            } else {
                $model->update($request->all());
            }

        });
    }

    public function getSetting($user_id, $screen_id)
    {
        return $this->setting->where('user_id', $user_id)->where('screen_id', $screen_id)->first();
    }

    public function logs($id)
    {
        return $this->model->find($id)->activities()->orderBy('created_at', 'DESC')->get();
    }
    private function forget($id)
    {
        $keys = [
            "RpDocumentPlan",
            "RpDocumentPlan_" . $id,
        ];
        foreach ($keys as $key) {
            cacheForget($key);
        }

    }

}
