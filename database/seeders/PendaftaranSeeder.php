<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pendaftaran; // Import model Pendaftaran
use Faker\Factory as Faker; // Import Faker

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        Pendaftaran::create([
            'user_id' => 2,
            'nama_lengkap' => $faker->name,
            'tempat_lahir' => $faker->city,
            'tanggal_lahir' => $faker->date('Y-m-d', '2015-01-01'),
            'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'anak_ke' => $faker->numberBetween(1, 5),
            'jumlah_saudara' => $faker->numberBetween(0, 10),
            'status_dalam_keluarga' => $faker->randomElement(['kandung', 'angkat']),
            'alamat' => $faker->address,
            'no_hp_siswa' => $faker->phoneNumber,
            'asal_sekolah' => 'TK ' . $faker->city,
            'alamat_sekolah' => $faker->address,
            'nama_ayah' => 'Bapak ' . $faker->lastName,
            'nama_ibu' => 'Ibu ' . $faker->lastName,
            'alamat_ayah' => $faker->address,
            'alamat_ibu' => $faker->address,
            'no_hp_ayah' => $faker->phoneNumber,
            'no_hp_ibu' => $faker->phoneNumber,
            'pekerjaan_ayah' => $faker->jobTitle,
            'pekerjaan_ibu' => $faker->jobTitle,
            'pendidikan_ayah' => $faker->randomElement(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']),
            'pendidikan_ibu' => $faker->randomElement(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']),
            'penghasilan_ayah' => $faker->randomElement(['< 1 Juta', '1-3 Juta', '3-5 Juta', '> 5 Juta']), // Contoh format penghasilan
            'penghasilan_ibu' => $faker->randomElement(['< 1 Juta', '1-3 Juta', '3-5 Juta', '> 5 Juta']),
            'pas_foto' => null,
            'akta' => null,
            'kk' => null,
            'ktp' => null,
            'ijazah_tk' => null,
            'status_pendaftaran' => 'proses',
            'keterangan' => null,
        ]);
    }
}
