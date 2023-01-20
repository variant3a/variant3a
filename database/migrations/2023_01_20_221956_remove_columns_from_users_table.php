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
            $table->dropColumn('state');
            $table->dropColumn('job');
            $table->dropColumn('bio');
            $table->dropColumn('programming_lang');
            $table->dropColumn('frameworks');
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
            $table->string('state')->nullable()->after('profile_photo_path');
            $table->string('job')->nullable()->after('state');
            $table->text('bio')->nullable()->after('job');
            $table->string('programming_lang')->nullable()->after('bio');
            $table->string('frameworks')->nullable()->after('programming_lang');
        });
    }
};
