<?php

namespace App\Observers;

use App\Models\CapaianPembelajaran;

class CapaianPembelajaranObserver
{
    public function creating(CapaianPembelajaran $model)
    {
        $model->is_approve = 0;
    }

    public function updating(CapaianPembelajaran $model): void
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
