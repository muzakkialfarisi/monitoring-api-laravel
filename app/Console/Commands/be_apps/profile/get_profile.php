<?php

namespace App\Console\Commands\be_apps\profile;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class get_profile extends Command
{
    protected $signature = 'be_apps:profile_get_profile';
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
                        'allow_redirects' => false,
                        'headers' => [
                            'Authorization' => 'Bearer ' . $main_dealer_apps_token[$i],
                        ],
                        'on_stats' => function (TransferStats $stats) use ($request_time)  {
                            $stats->getTransferTime();
                            $request_time->setTotaltime($stats->getTransferTime());
                        }
                    ]);
    
                $this->info($main_dealer_base_url[$i]);
                $this->info($path);
                $this->info($response->getStatusCode());
                $this->info($response->getBody());
                $this->info($request_time->getTotaltime());
            }
            catch(Exception $e) {
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
