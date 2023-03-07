<?php

namespace App\Repositories;

use App\Models\LogModel;

class LogRepository
{
    public function __construct()
    {
        $this->log = new LogModel();
    }

    public function save()
    {
        
    }
}