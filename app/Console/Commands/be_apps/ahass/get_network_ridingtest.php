<?php

namespace App\Console\Commands\be_apps\ahass;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class get_network_ridingtest extends Command
{
    protected $signature = 'be_apps:ahass_get_network_ridingtest';
    protected $description = 'Command description';

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
            $request = $client->post(
                'https://app.wanda.mokitadev.xituz.com/api/ahass/find-network/ridingtest',
                [
                    'headers' => [
                        'authorization' =>  $token,
                    ],
                    'json' => [
                        'variant_id' => 694,
                        'limit' => 1
                    ]
                ],
            );

            if ($request->getStatusCode()) {
                $response = json_decode($request->getBody(), true);
            }
            
            dd($response);

        } catch (RequestException $e) {
            $this->info('error 1');
        } catch(Exception $e){
            $this->info('error 2');
        }
    }
}
