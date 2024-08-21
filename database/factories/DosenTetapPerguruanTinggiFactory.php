<?php

namespace Database\Factories;

use DosenTetapPerguruanTinggi;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosenTetapPerguruanTinggiFactory extends Factory
{
    protected $model = \App\Models\DosenTetapPerguruanTinggi::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'nidn' => $this->faker->randomNumber(9),
            'pendidikan_magister' => $this->faker->word,
            'pendidikan_doktor' => $this->faker->word,
            'bidang_keahlian' => $this->faker->word,
            'kesesuaian' => $this->faker->boolean(),
            'jabatan_akademik' => $this->faker->word,
            'sertifikat_pendidik' => $this->faker->word,
            'sertifikat_kompetensi' => $this->faker->word,
            'mata_kuliah_ps_diakreditasi' => $this->faker->word,
            'kesesuaian_bidang_keahlian' => $this->faker->word,
            'mata_kuliah_ps_lain' => $this->faker->word,
            //create a user_id
            'user_id' => \App\Models\User::factory(),
            'is_approve' => $this->faker->randomNumber(1),
        ];
    }
}
