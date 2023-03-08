<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\LogModel;
use App\Services\InitialService;

class LogRepository
{
    private Int
        $id = 0,
        $key = 0,
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
        $path,
        $application_feature,
        $request_header,
        $request_payload,
        $response_body_factual,
        $response_body_actual,
        $search;

    public function __construct()
    {
        $this->log_model = new LogModel();
        $this->initial_service = new InitialService();
    }

    public function set_key(Int $key): self
    {
        $this->key = $key;
        return $this;
    }

    public function set_id(Int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function set_path(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function set_application_feature(string $application_feature): self
    {
        $this->application_feature = $application_feature;
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

    public function set_status_code_factual(int $status_code_factual): self
    {
        $this->status_code_factual = $status_code_factual;
        return $this;
    }

    public function set_status_code_actual(int $status_code_actual): self
    {
        $this->status_code_actual = $status_code_actual;
        return $this;
    }

    public function set_status_code_validation(bool $status_code_validation): self
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

    public function set_response_body_validation(bool $response_body_validation): self
    {
        $this->response_body_validation = $response_body_validation;
        return $this;
    }

    public function set_response_time(float $response_time): self
    {
        $this->response_time = $response_time;
        return $this;
    }

    public function set_response_time_accumulation(float $response_time_accumulation): self
    {
        $this->response_time_accumulation = $response_time_accumulation;
        return $this;
    }

    public function set_response_time_validation(bool $response_time_validation): self
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
        return (bool) $this->log_model->create([
            'main_dealer_id' => $this->initial_service->main_dealer_id[$this->key],
            'application_name' => $this->initial_service->application_name[$this->key],
            'url' => $this->initial_service->base_url[$this->key] . $this->path,
            'application_feature' => $this->application_feature,
            'request_header' => $this->request_header,
            'request_payload' => $this->request_payload,
            'status_code_factual' => $this->status_code_factual,
            'status_code_actual' => $this->status_code_actual,
            'status_code_validation' => $this->status_code_validation,
            'response_body_factual' => $this->response_body_factual,
            'response_body_actual' => $this->response_body_actual,
            'response_body_validation' => $this->response_body_validation,
            'response_time' => $this->response_time,
            'response_time_accumulation' => $this->response_time_accumulation,
            'response_time_validation' => $this->response_time_validation,
        ]);
    }

    public function getAccumulatedTime()
    {
        $date = Carbon::now()->subDays(1);
        return (Object) $this->log_model->whereNull('deleted_at')
            ->where('main_dealer_id', $this->initial_service->main_dealer_id[$this->key])
            ->where('application_name', $this->initial_service->application_name[$this->key])
            ->where('application_feature', $this->application_feature)
            ->where('url', $this->initial_service->base_url[$this->key] . $this->path)
            ->whereDate('created_at', '>=', $date)
            ->get();

        
    }
}