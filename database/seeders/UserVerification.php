<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserVerification extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $verifications = [
            [
                'user_id' => 2,
                'nama_lengkap' => 'Ahmad Rizki Pratama',
                'nama_ortu' => 'Budi Pratama',
                'bukti_pembayaran' => 'bukti_pembayaran_ahmad.jpg',
                'no_wa' => '085279301178',
                'status' => 'pending',
                'keterangan' => null,
            ],
        ];
        foreach ($verifications as $verification) {
            \App\Models\UserVerification::create($verification);
        }
    }
}
