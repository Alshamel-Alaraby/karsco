<?php

namespace App\Models;

use App\Traits\ConnTrait;
use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class RoleScreenHotfield extends Model
{
    use HasFactory, SoftDeletes, LogTrait,ConnTrait;

    protected $table = 'role_screen_hotfields';

    protected $guarded = ["id"];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        $user = auth()->user()->id ?? "system";

        return LogOptions::defaults()
            ->logAll()
            ->useLogName('RoleScreens Hot Field')
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by ($user)");
    }

}
