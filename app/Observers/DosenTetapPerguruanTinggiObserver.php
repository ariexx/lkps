<?php

namespace App\Observers;

use App\Models\DosenTetapPerguruanTinggi;

class DosenTetapPerguruanTinggiObserver
{

    public function creating(DosenTetapPerguruanTinggi $model)
    {
        $model->is_approve = 0;
    }

    public function updating(DosenTetapPerguruanTinggi $model): void
    {
        $originalIsApprove = $model->getOriginal('is_approve');

        if ($originalIsApprove == STATUS_PENDING && $model->is_approve == STATUS_REJECTED) {
            return;
        }

        if ($originalIsApprove == STATUS_REJECTED && $model->isDirty()) {
            $model->is_approve = STATUS_PENDING;
        }
    }
}
