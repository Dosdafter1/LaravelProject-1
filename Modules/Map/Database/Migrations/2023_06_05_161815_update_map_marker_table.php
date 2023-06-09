<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_marker', function (Blueprint $table) {
            $table->string('lat', 200)->change();
            $table->string('long', 200)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_marker', function (Blueprint $table) {
            $table->double('lat', 10, 5)->change();
            $table->double('long', 10, 5)->change();
        });
    }
};
