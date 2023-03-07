<?php

namespace App\Console\Commands\wanda\be_apps\profile;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class get_profile extends Command
{
    protected $signature = 'wahana:apps_profile_get_profile';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $main_dealer_id = explode(',', config('app.main_dealer_id'));
        $main_dealer_base_url = explode(',', config('app.main_dealer_base_url'));
        $main_dealer_apps_token = explode(',', config('app.main_dealer_apps_token'));

        $path = 'profile/';

        $client = new Client();
        $request_time = new self();

        for($i = 0; $i < count($main_dealer_id); $i++){
            try{
                $client = new Client();
                $request_time = new self();
                $response = $client->get(
                        $main_dealer_base_url[$i] . $path, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $main_dealer_apps_token[$i],
                        ],
                        'on_stats' => function (TransferStats $stats) use ($request_time)  {
                            $stats->getTransferTime();
                            $request_time->setTotaltime($stats->getTransferTime());
                        }
                    ]);
    
                if($response){
                    $response_headers = '{';
                    foreach ($response->getHeaders() as $name => $values) {
                        $response_headers .= '"' . $name . '":"' . implode(', ', $values) . '", ';
                    }
                    $response_headers .= '}';
    
                    $this->info('base URL = ' . $main_dealer_base_url[$i]);
                    $this->info('');
                    $this->info('path = ' . $path);
                    $this->info('');
                    $this->info('status code = ' . $response->getStatusCode());
                    $this->info('');
                    $this->info('response header = ' . $response_headers);
                    $this->info('');
                    $this->info('response body = ' . $response->getBody());
                    $this->info('');
                    $this->info('response time = ' . $request_time->getTotaltime());
                }
            }
            catch(ClientErrorResponseException $exception) {
                $this->info('error');
            }
        }
    }

    private function getTotaltime(){
        return $this->totaltime;
    }

    private function setTotaltime($time){
        $this->totaltime = $time;
    }
}
