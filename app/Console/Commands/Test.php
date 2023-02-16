<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $model = \Modules\Archiving\Entities\DocType::create([
        //     "name" => "test",
        //     "name_e" => "test",
        //     "parent_id" => 2,
        //     "is_active" => 1]);

        // $model = \Modules\Archiving\Entities\DocType::find($model->parent_id);
        // // doc type field
        // $doc_type_fields = \Modules\Archiving\Entities\DocTypeField::where("doc_type_id", $model->id)->get();
        // // dd($doc_type_fields);
        // foreach ($doc_type_fields as $doc_type_field) {
        //     \Modules\Archiving\Entities\DocTypeField::create([
        //         "doc_type_id" => $model->id,
        //         "doc_field_id" => $doc_type_field->doc_field_id,
        //         "is_required" => $doc_type_field->is_required,
        //         "field_order" => $doc_type_field->field_order,
        //     ]
        //     );
        // }

        // $ids = \Modules\Archiving\Entities\DocTypeDepartment::where("arch_doc_type_id", $model->id)->pluck("arch_department_id")->toArray();

        // foreach ($ids as $id) {
        //     \Modules\Archiving\Entities\DocTypeDepartment::create([
        //         "arch_doc_type_id" => $model->id,
        //         "arch_department_id" => $id,
        //     ]);
        // }

        // $ids = $model->statuses()->pluck("status_id")->toArray();
        // $model->statuses()->attach($ids);

    }
}
