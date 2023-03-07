<?php

namespace App\Services;

use App\Repositories\LogRepository;

class LogService 
{
    public function __construct() 
    {
        $this->LogRepository = new LogRepository();
    }

    public function hola() 
    {
        return true;
    }

    public function save(array $param): array 
    {
        $save = $this->gasStation
            ->set_id($param["id"])
            ->set_application_name($param["application_name"])
            ->set_application_feature($param["application_feature"])
            ->set_url($param["url"])
            ->set_request_header($param["request_header"])
            ->set_request_payload($param["request_payload"])
            ->set_status_code_factual($param["status_code_factual"])
            ->set_status_code_actual($param["status_code_actual"])
            ->set_status_code_validation($param["status_code_validation"])
            ->set_response_body_factual($param["response_body_factual"])
            ->set_response_body_actual($param["response_body_actual"])
            ->set_response_body_validation($param["response_body_validation"])
            ->set_response_time($param["response_time"])
            ->set_response_time_accumulation($param["response_time_accumulation"])
            ->set_response_time_validation($param["response_time_validation"])
            ->save();

        if (!$save)
            return $this->errorMessage("Failed To Saved.");

        return [
            "status" => 1,
            "msg" => "Data Successfuly Saved."
        ];
    }
}
