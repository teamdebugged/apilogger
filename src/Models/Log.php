<?php

namespace debugged\ApiLogger\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'method',
        'url',
        'ip',
        'user_agent',
        'request_data',
        'response_data',
        'status_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array',
        'status_code' => 'integer',
    ];
}
