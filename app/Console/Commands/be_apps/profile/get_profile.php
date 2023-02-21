<?php

namespace App\Console\Commands\be_apps\profile;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class get_profile extends Command
{
    protected $signature = 'be_apps:profile_get_profile';
    protected $description = 'Command description';

    public function getTotaltime(){
        return $this->totaltime;
    }

    public function setTotaltime($time){
        $this->totaltime = $time;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $token = "Bearer 5de2d595b9210f2dbd4a9a28c1aa5393fb67f1d644b425ca1defe95a8ff64fb8";

        $reqtime= new self();
        $client = new Client();
        $guzzleResponse = $client->get(
                'https://app.wanda.mokitadev.xituz.com/api/profile', [
                'headers' => [
                    'Authorization' =>  $token,
                ],
                'on_stats' => function (TransferStats $stats) use ($reqtime)  {
                    $stats->getTransferTime();
                    $reqtime->setTotaltime($stats->getTransferTime());
                }
            ]);
        if ($guzzleResponse->getStatusCode() == 200) {
            $response = json_decode($guzzleResponse->getBody(), true);
        }

        $this->info($reqtime->getTotaltime());
        dd($response);
    }
}
