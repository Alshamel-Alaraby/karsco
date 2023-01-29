<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Archiving\Entities\ArchiveFile;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

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
        set_time_limit(0);

        $model = ArchiveFile::find(2);
        if (!$model) {
            return responseJson(404, 'not found');
        }
        $path = public_path ('/pdf/'.rand (1111111111,9999999999).'.pdf');

        $data = [
            'id' => $model->id,
            "data_type_value" => $model->data_type_value,
            "media" =>  isset($model->files) ? collect($model->files)->values () : null,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            "media_count"=>count((array) $model->files)
        ];
        PDF::loadView('pdf', $data, [], [
            'format' => 'A4'
        ])->save($path);


    }
}
