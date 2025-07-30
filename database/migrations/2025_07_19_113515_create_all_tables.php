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
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jurusan', 50);
            $table->string('kode_jurusan', 10)->unique();
            $table->timestamps();
        });

        // 3. Tabel Kelas
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas', 50);
            $table->foreignId('id_jurusan')->constrained('jurusan')->onDelete('cascade');
            $table->year('angkatan');
            $table->timestamps();
        });


        // 4. Tabel Siswa
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('nis', 20)->primary();
            $table->string('nama', 100);
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->nullOnDelete();
            $table->text('alamat')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 20)->nullable();
            $table->string('name', 100);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'siswa'])->default('siswa');
            $table->timestamps();
            $table->foreign('nis')
                ->references('nis')->on('siswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // 5. Tabel SPP
        Schema::create('spp', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 20);
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->year('tahun');
            $table->decimal('nominal', 10, 2);
            $table->enum('bulan', [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ]);
            $table->enum('status', ['belum_dibayar', 'lunas'])->default('belum_dibayar');
            $table->date('jatuh_tempo')->nullable();
            $table->timestamps();
        });

        // 7. Tabel Pembayaran
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_spp')->constrained('spp')->onDelete('cascade');
            $table->date('tgl_bayar');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->enum('metode_pembayaran', ['cash', 'transfer'])->default('cash');
            $table->text('keterangan')->nullable();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('spp');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('jurusan');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
