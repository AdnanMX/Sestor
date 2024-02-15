<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class LogM extends Model
{
    use HasFactory;
    protected $table = "log";
    protected $fillable = ["id", "id_user", "activity"];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->LogOnly(['id_user', 'activity']);
    }

}
