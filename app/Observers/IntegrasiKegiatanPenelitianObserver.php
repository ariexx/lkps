<?php

namespace App\Observers;

use App\Models\IntegrasiKegiatanPenelitian;

class IntegrasiKegiatanPenelitianObserver
{
    public function creating(IntegrasiKegiatanPenelitian $model)
    {
        $model->is_approve = 0;
    }

    public function updating(IntegrasiKegiatanPenelitian $model): void
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
