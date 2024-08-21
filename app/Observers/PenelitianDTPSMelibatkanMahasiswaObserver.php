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
        //if is_approve is STATUS_REJECTED, and the user being updated is not the same as the user who rejected it, then set is_approve to STATUS_PENDING
        if ($model->is_approve == STATUS_REJECTED) {
            $model->is_approve = STATUS_PENDING;
        }
    }
}
