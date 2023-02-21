<?php

namespace App\Console\Commands\be_apps;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Log;

class profile extends Command
{
    protected $signature = 'be_apps:profile';
    protected $description = 'Command description';

    private $totaltime = 0;

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

        try {
            $reqtime= new self();
            $client = new Client();
            $guzzleResponse = $client->get(
                    'https://app.wanda.mokitadev.xituz.com/api/profile', [
                    'headers' => [
                        'Authorization' =>  $token,
                        'Content-Type' => 'application/json',
                        'X-First' => 'Foo'
                    ],
                    // 'on_stats' => function (TransferStats $stats) use ($reqtime)  {
                    //     $stats->getTransferTime();
                    //     $reqtime->setTotaltime($stats->getTransferTime());
                    // }
                ]);
            if ($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody(), true);
            }

            // $this->info($reqtime->getTotaltime());
            dd($response);
        } catch (RequestException $e) {
            $this->info('error 1');
        } catch(Exception $e){
            $this->info('error 2');
        }
    }

    // public function handle2()
    // {
    //     $token = "Bearer 5de2d595b921a0f2dbd4a9a28c1aa5393fb67f1d644b425ca1defe95a8ff64fb8";

    //     try {
    //         $reqtime= new self();
    //         $client = new Client();
    //         $guzzleResponse = $client->get(
    //                 'https://app.wanda.mokitadev.xituz.com/api/ahass/find-network/ridingtest', [
    //                 'headers' => [
    //                     'authorization' =>  $token,
    //                     'content-type' => 'application/json'
    //                 ],
    //                 'on_stats' => function (TransferStats $stats) use ($reqtime)  {
    //                     $stats->getTransferTime();
    //                     $reqtime->setTotaltime($stats->getTransferTime());
    //                 }
    //             ]);
    //         if ($guzzleResponse->getStatusCode() == 200) {
    //             $response = json_decode($guzzleResponse->getBody(), true);
    //         }
            
    //         $this->info($guzzleResponse->getStatusCode());
    //     } catch (RequestException $e) {
    //         $this->info('error 1');
    //     } catch(Exception $e){
    //         $this->info('error 2');
    //     }
    // }

    // public function handle()
    // {
    //     $token = "Bearer 5de2d595b9210f2dbd4a9a28c1aa5393fb67f1d644b425ca1defe95a8ff64fb8";

    //     try {
    //         $reqtime= new self();
    //         $client = new Client();
    //         $request = $client->post(
    //             'https://app.wanda.mokitadev.xituz.com/api/ahass/find-network/ridingtest',
    //             [
    //                 'headers' => [
    //                     'authorization' =>  $token,
    //                 ],
    //                 'json' => [
    //                     'variant_id' => 694,
    //                     'limit' => 1
    //                 ]
    //             ],
    //         );

    //         if ($request->getStatusCode()) {
    //             $response = json_decode($request->getBody(), true);
    //         }
            
    //         dd($response);

    //     } catch (RequestException $e) {
    //         $this->info('error 1');
    //     } catch(Exception $e){
    //         $this->info('error 2');
    //     }
    // }
}
