<?php

namespace App\Http\Services;

use App\Http\DTO\LogActivityDTO;
use App\Models\LogActivity;

class LogActivityService
{
    public function __construct(public LogActivity $logActivity)
    {
    }

    public function log(array $data): void
    {
        $data['user_id'] = user()->id;
        $data["activity"] = $data[0];
        $data["description"] = $data[1];

        $this->logActivity->create($data);
    }
}
