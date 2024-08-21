<?php

namespace App\Observers;

class KerjasamaPenelitianObserver
{
    public function creating($model)
    {
        $model->is_approved = 0;
    }

    public function updating($model): void
    {
        $originalIsApprove = $model->getOriginal('is_approved');

        if ($originalIsApprove == STATUS_PENDING && $model->is_approved == STATUS_REJECTED) {
            return;
        }

        if ($originalIsApprove == STATUS_REJECTED && $model->isDirty()) {
            $model->is_approved = STATUS_PENDING;
        }
    }
}
