<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostIdToCommentsTable extends Migration
{
    /**
     * Jalankan migrasi untuk menambahkan kolom post_id ke tabel comments.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('comments', function (Blueprint $table) {
        //     $table->unsignedBigInteger('post_id')->after('id'); // Menambahkan kolom post_id setelah kolom id
        //     $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // Menambahkan foreign key
        // });
    }

    /**
     * Membatalkan perubahan jika migrasi dibatalkan.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('comments', function (Blueprint $table) {
        //     $table->dropForeign(['post_id']); // Menghapus foreign key
        //     $table->dropColumn('post_id'); // Menghapus kolom post_id
        // });
    }
}
