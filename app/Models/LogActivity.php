<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $fillable = [
        'user_id',
        'activity',
        'description',
    ];

    protected $table = 'log_activities';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
