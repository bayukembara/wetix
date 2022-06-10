<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTableArrangeMovieToStudios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('arrange_movie', function(Blueprint $table){
        //     $table->renameIndex('arrange_movie_movie_id_foreign', 'studios_movie_id_foreign');
        //     $table->renameIndex('arrange_movie_theater_id_foreign', 'studios_theater_id_foreign');
        // });

        DB::unprepared('ALTER TABLE `arrange_movie` DROP FOREIGN KEY `arrange_movie_movie_id_foreign`; ALTER TABLE `arrange_movie` ADD CONSTRAINT `studios_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;');
        DB::unprepared('ALTER TABLE `arrange_movie` DROP FOREIGN KEY `arrange_movie_theater_id_foreign`; ALTER TABLE `arrange_movie` ADD CONSTRAINT `studios_theater_id_foreign` FOREIGN KEY (`theater_id`) REFERENCES `theaters`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;');

        DB::statement('ALTER TABLE `arrange_movie` DROP INDEX `arrange_movie_movie_id_foreign`, ADD INDEX `studios_movie_id_foreign` (`movie_id`) USING BTREE');
        DB::statement('ALTER TABLE `arrange_movie` DROP INDEX `arrange_movie_theater_id_foreign`, ADD INDEX `studios_theater_id_foreign` (`theater_id`) USING BTREE');

        Schema::rename('arrange_movie', 'studios');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('ALTER TABLE `studios` DROP FOREIGN KEY `studios_movie_id_foreign`; ALTER TABLE `studios` ADD CONSTRAINT `arrange_movie_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;');
        DB::unprepared('ALTER TABLE `studios` DROP FOREIGN KEY `studios_theater_id_foreign`; ALTER TABLE `studios` ADD CONSTRAINT `arrange_movie_theater_id_foreign` FOREIGN KEY (`theater_id`) REFERENCES `theaters`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;');

        DB::statement('ALTER TABLE `studios` DROP INDEX `studios_movie_id_foreign`, ADD INDEX `arrange_movie_movie_id_foreign` (`movie_id`) USING BTREE');
        DB::statement('ALTER TABLE `studios` DROP INDEX `studios_theater_id_foreign`, ADD INDEX `arrange_movie_theater_id_foreign` (`theater_id`) USING BTREE');

        Schema::rename('studios', 'arrange_movie');
    }
}
