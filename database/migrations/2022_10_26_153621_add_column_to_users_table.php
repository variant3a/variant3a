<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('state')->nullable();
            $table->string('job')->nullable();
            $table->text('bio')->nullable();
            $table->string('programming_lang')->nullable();
            $table->string('frameworks')->nullable();
            $table->timestamp('last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('state');
            $table->dropColumn('job');
            $table->dropColumn('bio');
            $table->dropColumn('programming_lang');
            $table->dropColumn('frameworks');
            $table->dropColumn('last_login');
        });
    }
};
