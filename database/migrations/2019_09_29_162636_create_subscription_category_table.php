<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_category', function (Blueprint $table) {
            $table->bigInteger('subscription_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        DB::table('subscription_category')->insert([
            ['subscription_id' => '1', 'category_id' => '1'],
            ['subscription_id' => '2', 'category_id' => '1'],
            ['subscription_id' => '2', 'category_id' => '2'],
            ['subscription_id' => '3', 'category_id' => '1'],
            ['subscription_id' => '3', 'category_id' => '2'],
            ['subscription_id' => '3', 'category_id' => '3']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_category');
    }
}
