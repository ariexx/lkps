<?php

namespace App\Observers;

use App\Models\DosenIndustriPraktisi;

class DosenIndustriPraktisiObserver
{
    public function creating(DosenIndustriPraktisi $model)
    {
        $model->is_approve = 0;
    }

    public function updating(DosenIndustriPraktisi $model): void
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
