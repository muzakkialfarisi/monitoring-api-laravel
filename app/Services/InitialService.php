<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class InitialService 
{
    public function __construct() 
    {
        $this->client = new Client();
        $this->main_dealer_id = explode(',', config('app.main_dealer_id'));
        $this->base_url = explode(',', config('app.main_dealer_base_url'));
        $this->token = config('app.token');
        $this->application_name = explode(',', config('app.main_dealer_apps_name'));
    }

    public function client()
    {
        return $this->client;
    }

    public function main_dealer_id()
    {
        return $this->main_dealer_id;
    }

    public function base_url()
    {
        return $this->base_url;
    }

    public function application_name()
    {
        return $this->application_name;
    }

    public function token()
    {
        return $this->token;
    }
}
