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
        //if is_approve is STATUS_REJECTED, and the user being updated is not the same as the user who rejected it, then set is_approve to STATUS_PENDING
        if ($model->is_approved == STATUS_REJECTED) {
            $model->is_approved = STATUS_PENDING;
        }
    }
}
