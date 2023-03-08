<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogModel extends Model
{
    use softDeletes;

    protected $table = 'logs';
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = [
        'main_dealer_id',
        'application_name',
        'application_feature',
        'url',
        'request_header',
        'request_payload',
        'status_code_factual',
        'status_code_actual',
        'status_code_validation',
        'response_body_factual',
        'response_body_actual',
        'response_body_validation',
        'response_time',
        'response_time_accumulation',
        'response_time_validation',
    ];

    protected $hidden = ['deleted_at'];

}
 