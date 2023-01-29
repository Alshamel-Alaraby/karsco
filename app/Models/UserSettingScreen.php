<?php

namespace App\Models;

use App\Traits\ConnTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettingScreen extends Model
{
    use HasFactory,ConnTrait;

    protected $guarded = [];
    protected $table = "user_setting_screens";

    public function screen()
    {
        return $this->belongsTo(Screen::class, 'screen_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
