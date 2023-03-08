<?php

namespace App\Services;

use App\Repositories\LogRepository;

class LogService 
{
    public function __construct() 
    {
        $this->log_repository = new LogRepository();
    }

    public function save(array $param): bool 
    {
        $data = $this->log_repository
            // ->set_id($param["id"] ?? null)
            ->set_key($param["key"])
            ->set_path($param["path"])
            ->set_application_feature($param["application_feature"])
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

        if (!$data)
            return false;

        return true;
    }

    public function getAccumulatedTime(array $param)
    {
        $data = $this->log_repository
            ->set_key($param["key"])
            ->set_path($param["path"])
            ->set_application_feature($param["application_feature"])
            ->getAccumulatedTime();

        return $data;
    }
}
