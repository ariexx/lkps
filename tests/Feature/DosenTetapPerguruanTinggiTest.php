<?php

use App\Models\DosenTetapPerguruanTinggi;
use App\Observers\DosenTetapPerguruanTinggiObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->observer = new DosenTetapPerguruanTinggiObserver();
});

it('sets is_approve to zero when creating', function () {
    $model = new DosenTetapPerguruanTinggi();
    $this->observer->creating($model);

    expect($model->is_approve)->toBe(0);
});

it('sets is_approve to pending if rejected and user changed when updating', function () {
    $model = DosenTetapPerguruanTinggi::factory()->create([
        'is_approve' => STATUS_REJECTED,
        'user_id' => 1,
    ]);
    $model->user_id = 2;

    $this->observer->updating($model);

    expect($model->is_approve)->toBe(STATUS_PENDING);
});

it('does not change is_approve if not rejected when updating', function () {
    $model = DosenTetapPerguruanTinggi::factory()->create([
        'is_approve' => 1,
        'user_id' => 1,
    ]);
    $model->user_id = 2;

    $this->observer->updating($model);

    expect($model->is_approve)->toBe(1);
});

it('does not change is_approve if user not changed when updating', function () {
    $model = DosenTetapPerguruanTinggi::factory()->create([
        'is_approve' => STATUS_REJECTED,
        'user_id' => 1,
    ]);

    $this->observer->updating($model);

    expect($model->is_approve)->toBe(STATUS_REJECTED);
});
