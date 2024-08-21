<?php

namespace App\Observers;

class MahasiswaAsingObserver
{
    public function creating($model)
    {
        $model->is_approve = 0;
    }

    public function updating($model): void
    {
        $originalIsApprove = $model->getOriginal('is_approve');

        if ($originalIsApprove == STATUS_PENDING && $model->is_approved == STATUS_REJECTED) {
            return;
        }

        if ($originalIsApprove == STATUS_REJECTED && $model->isDirty()) {
            $model->is_approved = STATUS_PENDING;
        }
    }
}
