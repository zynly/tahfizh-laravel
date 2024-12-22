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
        Schema::create('history_murojaahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('murojaah_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('surat_id');
            $table->foreign('surat_id')->references('id')->on('surats');
            $table->mediumInteger('ayatke')->unsigned();
            $table->date('tgl_murojaah');
            $table->unsignedInteger('nilai');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_murojaahs');
    }
};
