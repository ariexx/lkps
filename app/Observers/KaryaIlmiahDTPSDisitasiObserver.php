<?php

namespace App\Observers;

use App\Models\KaryaIlmiahDTPSDisitasi;

class KaryaIlmiahDTPSDisitasiObserver
{
    public function updating(KaryaIlmiahDTPSDisitasi $model): void
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
