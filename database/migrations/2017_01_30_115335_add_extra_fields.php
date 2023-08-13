<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users', function (Blueprint $table)
       {
           $table->string('username');
           $table->string('pass_code');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ('users', function(Blueprint $table)
        {
           $table->dropColumn('username');
            $table->dropColumn('pass_code');
        });
    }
}
