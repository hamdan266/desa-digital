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
        Schema::create('social_assistance_recipients', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('social_assistance_id');
            $table->foreign('social_assistance_id')->references('id')->on('social_assistances');


            $table->uuid('head_of_family_id');
            $table->foreign('head_of_family_id')->references('id')->on('head_of_families');

            $table->decimal('amount', 10, 2); //jumlah bantuan sosial yang diterima
            $table->longText('reason'); //alasan penerima bantuan sosial (misalnya alasan membutuhkan bantuan sosial, kondisi ekonomi, dll)
            $table->enum('bank', ['bri', 'bni', 'bca', 'mandiri']); //bank penerima bantuan sosial
            $table->integer('account_number'); //nomor rekening penerima bantuan sosial
            $table->string('proof'); //bukti penerima bantuan sosial (misalnya foto penerimaan, bukti tf/cash atau bukti lainnya)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); //status penerima bantuan sosial

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_assistance_recipients');
    }
};
