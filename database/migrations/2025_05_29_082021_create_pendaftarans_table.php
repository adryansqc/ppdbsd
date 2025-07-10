<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->integer('anak_ke');
            $table->integer('jumlah_saudara');
            $table->enum('status_dalam_keluarga', ['kandung', 'angkat']);
            $table->text('alamat');
            $table->string('no_hp_siswa')->nullable();
            $table->string('asal_sekolah');
            $table->text('alamat_sekolah')->nullable();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->text('alamat_ayah')->nullable();
            $table->text('alamat_ibu')->nullable();
            $table->string('no_hp_ayah')->nullable();
            $table->string('no_hp_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('akta')->nullable();
            $table->string('kk')->nullable();
            $table->string('ktp')->nullable();
            $table->string('ijazah_tk')->nullable();
            $table->enum('status_pendaftaran', ['proses', 'diterima', 'ditolak'])->default('proses');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
