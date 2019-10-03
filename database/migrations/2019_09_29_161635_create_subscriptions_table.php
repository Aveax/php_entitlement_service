<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            //$table->string('categories');
            $table->timestamps();
        });

        // Insert some stuff
//        DB::table('subscriptions')->insert([
//            ['name' => 'Silver Plan', 'categories' => 'sport technology'],
//            ['name' => 'Gold Plan', 'categories' => 'sport technology business']
//        ]);
        DB::table('subscriptions')->insert([
            ['name' => 'Bronze Plan'],
            ['name' => 'Silver Plan'],
            ['name' => 'Gold Plan']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
