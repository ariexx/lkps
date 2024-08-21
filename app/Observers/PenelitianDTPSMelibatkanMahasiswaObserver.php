<?php

namespace App\Observers;

use App\Models\PenelitianDTPSMelibatkanMahasiswa;

class PenelitianDTPSMelibatkanMahasiswaObserver
{
    public function creating(PenelitianDTPSMelibatkanMahasiswa $model)
    {
        $model->is_approve = 0;
    }

    public function updating(PenelitianDTPSMelibatkanMahasiswa $model): void
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
