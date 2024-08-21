<?php

namespace App\Observers;

class EWMP
{
    public function creating(\App\Models\EWMP $model)
    {
        $model->is_approve = 0;
    }

    public function updating(\App\Models\EWMP $model): void
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
