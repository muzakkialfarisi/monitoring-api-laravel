<?php

namespace App\Console\Commands\wanda\be_apps\profile;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

use App\Services\LogService;
use App\Services\InitialService;


class get_profile extends Command
{
    protected $signature = 'wanda:apps_profile_get_profile';
    protected $description = '';

    public function __construct()
    {
        parent::__construct();

        $this->log_service = new LogService();
        $this->initial_service = new InitialService();

        $this->path = 'profile/';
    }

    public function handle()
    {
        $request_time = new self();
        
        try{
            $data = $this->initial_service->client->get(
                $this->initial_service->base_url[1] . $this->path, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->initial_service->token,
                ],
                'on_stats' => function (TransferStats $stats) use ($request_time)  {
                    $stats->getTransferTime();
                    $request_time->setTotaltime($stats->getTransferTime());
                }
            ]);
        }
        catch(ClientErrorResponseException $e){
            return false;
        }

        if($data){
            $response_headers = '{';
            foreach ($data->getHeaders() as $name => $values) {
                $response_headers .= '"' . $name . '":"' . implode(', ', $values) . '", ';
            }
            $response_headers .= '}';
        }

        dd($this->log_service->getAccumulatedTime([
            'key' => 1,
            'path' => $this->path,
            'application_feature' => 'profile',
        ]));

        $return = $this->log_service->save([
            'key' => 1,
            'path' => $this->path,
            'application_feature' => 'profile',
            'request_header' => $response_headers,
            'request_payload' => '',
            'status_code_factual' => $data->getStatusCode(),
            'status_code_actual' => 200,
            'status_code_validation' => true,
            'response_body_factual' => 1,
            'response_body_actual' => $this->initial_service->application_name[1],
            'response_body_validation' => true,
            'response_time' => $request_time->getTotaltime(),
            'response_time_accumulation' => 1,
            'response_time_validation' => true,
        ]);

        return true;
    }

    private function getTotaltime()
    {
        return $this->totaltime;
    }

    private function setTotaltime($time)
    {
        $this->totaltime = $time;
    }
}