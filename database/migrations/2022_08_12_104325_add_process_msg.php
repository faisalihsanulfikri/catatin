<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcessMsg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wealth', function (Blueprint $table) {
            $table->tinyInteger('is_process')->nullable()->default(0)->after("user_id");
            $table->text('process_msg')->nullable()->after("is_process");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wealth', function (Blueprint $table) {
            $table->dropColumn('is_process');
            $table->dropColumn('process_msg');
        });
    }
}
