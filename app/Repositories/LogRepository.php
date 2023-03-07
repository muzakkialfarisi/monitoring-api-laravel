<?php

namespace App\Repositories;

use App\Models\LogModel;

class LogRepository
{
    private Int
        $id = 0,
        $status_code_factual = 0,
        $status_code_actual = 0,
        $status_code_validation = 0,
        $response_body_validation = 0,
        $response_time_validation = 0,
        $take = 100,
        $skip = 0;

    private float
        $response_time,
        $response_time_accumulation;
    
    private string 
        $application_name,
        $application_feature,
        $url,
        $request_header,
        $request_payload,
        $response_body_factual,
        $response_body_actual,
        $search;

    public function __construct()
    {
        $this->LogModel = new LogModel();
    }

    public function set_id(Int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function set_application_name(string $application_name): self
    {
        $this->application_name = $application_name;
        return $this;
    }

    public function set_application_feature(string $application_feature): self
    {
        $this->application_feature = $application_feature;
        return $this;
    }

    public function set_url(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function set_request_header(string $request_header): self
    {
        $this->request_header = $request_header;
        return $this;
    }

    public function set_request_payload(string $request_payload): self
    {
        $this->request_payload = $request_payload;
        return $this;
    }

    public function set_status_code_factual(string $status_code_factual): self
    {
        $this->status_code_factual = $status_code_factual;
        return $this;
    }

    public function set_status_code_actual(string $status_code_actual): self
    {
        $this->status_code_actual = $status_code_actual;
        return $this;
    }

    public function set_status_code_validation(string $status_code_validation): self
    {
        $this->status_code_validation = $status_code_validation;
        return $this;
    }

    public function set_response_body_factual(string $response_body_factual): self
    {
        $this->response_body_factual = $response_body_factual;
        return $this;
    }

    public function set_response_body_actual(string $response_body_actual): self
    {
        $this->response_body_actual = $response_body_actual;
        return $this;
    }

    public function set_response_body_validation(string $response_body_validation): self
    {
        $this->response_body_validation = $response_body_validation;
        return $this;
    }

    public function set_response_time(string $response_time): self
    {
        $this->response_time = $response_time;
        return $this;
    }

    public function set_response_time_accumulation(string $response_time_accumulation): self
    {
        $this->response_time_accumulation = $response_time_accumulation;
        return $this;
    }

    public function set_response_time_validation(string $response_time_validation): self
    {
        $this->response_time_validation = $response_time_validation;
        return $this;
    }

    public function getList(): Object
    {
        $data = $this->log->whereNull("deleted_at");

        if (!empty($this->search)) {
            $query = $query->where(function($qry) {
                $qry->where("application_name", "LIKE", "%".$this->search."%")
                    ->orwhere("application_feature", "LIKE", "%".$this->search."%")
                    ->orWhere("url", "LIKE", "%".$this->search."%")
                    ->orWhere("request_header", "LIKE", "%".$this->search."%")
                    ->orWhere("request_payload", "LIKE", "%".$this->search."%")
                    ->orWhere("status_code_factual", "LIKE", "%".$this->search."%")
                    ->orWhere("status_code_actual", "LIKE", "%".$this->search."%")
                    ->orWhere("status_code_validation", "LIKE", "%".$this->search."%")
                    ->orWhere("response_body_factual", "LIKE", "%".$this->search."%")
                    ->orWhere("response_body_actual", "LIKE", "%".$this->search."%")
                    ->orWhere("response_body_validation", "LIKE", "%".$this->search."%")
                    ->orWhere("response_time", "LIKE", "%".$this->search."%")
                    ->orWhere("response_time_accumulation", "LIKE", "%".$this->search."%")
                    ->orWhere("response_time_validation", "LIKE", "%".$this->search."%");
            });
        }

        return (object) [
            "total" => $query->count(),
            "rows" => $query->take($this->take)->skip($this->skip)->get()
        ];
    }

    public function save(): bool
    {
        $data = [
            'application_name' => (!empty($this->application_name)) ? $this->application_name : null,
            'application_feature' => (!empty($this->application_feature)) ? $this->application_feature : null,
            'url' => (!empty($this->url)) ? $this->url : null,
            'request_header' => (!empty($this->request_header)) ? $this->request_header : null,
            'request_payload' => (!empty($this->request_payload)) ? $this->request_payload : null,
            'status_code_factual' => (!empty($this->status_code_factual)) ? $this->status_code_factual : null,
            'status_code_actual' => (!empty($this->status_code_actual)) ? $this->status_code_actual : null,
            'status_code_validation' => (!empty($this->status_code_validation)) ? $this->status_code_validation : null,
            'response_body_factual' => (!empty($this->response_body_factual)) ? $this->response_body_factual : null,
            'response_body_actual' => (!empty($this->response_body_actual)) ? $this->response_body_actual : null,
            'response_body_validation' => (!empty($this->response_body_validation)) ? $this->response_body_validation : null,
            'response_time' => (!empty($this->response_time)) ? $this->response_time : null,
            'response_time_accumulation' => (!empty($this->response_time_accumulation)) ? $this->response_time_accumulation : null,
            'response_time_validation' => (!empty($this->response_time_validation)) ? $this->response_time_validation : null,
        ];

        return (bool) GasStation::create($data);
    }
}