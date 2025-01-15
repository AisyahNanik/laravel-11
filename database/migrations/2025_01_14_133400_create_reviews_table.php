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
        // Hapus tabel jika sudah ada
        Schema::dropIfExists('reviews');

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Menambahkan kolom post_id setelah kolom id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // Menambahkan foreign key
            $table->string('content');
            $table->unsignedBigInteger('user_id'); // Menambahkan kolom user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id'); //Menghapus kolom product_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id'); //Menghapus kolom user_id
        });

        Schema::dropIfExists('reviews');
    }
};
