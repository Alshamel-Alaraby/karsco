<?php

namespace Modules\Archiving\Repositories;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Exception\NotFoundException;
use Modules\Archiving\Entities\ArchDocumentStatus;
use Modules\Archiving\Entities\DocType;

class DocTypeRepository implements DocTypeInterface
{
    private $model;
    public function __construct(DocType $model)
    {
        $this->model = $model;
    }

    public function all($request)
    {
        $models = $this->model->filter($request)->where(function ($q) use ($request) {
            // return parent which not have children and children for parents
            if ($request->select) {
                $q->whereNull('parent_id')->orWhereHas('children');
            }
        })
            ->orderBy($request->order ? $request->order : 'updated_at', $request->sort ? $request->sort : 'DESC');
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
            cacheForget("ArchDoctype");
            return $this->model->create($request->all());
        });
    }

    public function update($request, $id)
    {
        DB::transaction(function () use ($id, $request) {
            $this->model->where("id", $id)->update($request->all());
            $this->forget($id);
        });
    }

    public function delete($id)
    {
        $model = $this->find($id);
        $this->forget($id);
        $model->delete();
    }

    public function logs($id)
    {
        return $this->model->find($id)->activities()->orderBy('created_at', 'DESC')->get();
    }

    public function tree()
    {
        return $this->model->whereNull('parent_id')->with('children')->get();
    }

    public function nodesLevelTwo($request)
    {
        // level two
        $parents = $this->model->whereNull('parent_id')->pluck('id')->toArray();
        $models = $this->model->whereIn('parent_id', $parents);
        if ($request->per_page) {
            return ['data' => $models->paginate($request->per_page), 'paginate' => true];
        } else {
            return ['data' => $models->get(), 'paginate' => false];
        }

    }

    private function forget($id)
    {
        $keys = [
            "ArchDoctype",
            "ArchDoctype_" . $id,
        ];
        foreach ($keys as $key) {
            cacheForget($key);
        }
    }
    //
    public function addStatusToDocumentType($request)
    {
        $docType = $this->model->find($request->doc_type_id);
        if (!$docType) {
            throw new NotFoundException();
        }
        $docType->statuses()->attach($request->status_id);
    }

    public function removeStatusFromDocumentType($doc_type_id, $status_id)
    {
        $screen = $this->model->find($doc_type_id);
        if (!$screen) {
            throw new NotFoundException();
        }
        $screen->statuses()->detach($status_id);
    }

    public function getDocTypeStatuses($docTypeId)
    {
        $docType = $this->model->find($docTypeId);
        return $docType->statuses;
    }

    public function documentStatusExist($status_id, $doc_type_id)
    {
        return ArchDocumentStatus::where("status_id", $status_id)->where("document_id", $doc_type_id)
            ->count() > 0;
    }

}
