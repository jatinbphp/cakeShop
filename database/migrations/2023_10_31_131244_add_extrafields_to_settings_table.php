<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtrafieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->longText('logo_content')->nullable()->after('p_bank');
            $table->longText('contact_content')->nullable()->after('logo_content');
            $table->string('contact_number')->nullable()->after('contact_content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('logo_content');
            $table->dropColumn('contact_content');
            $table->dropColumn('contact_number');
        });
    }
}
