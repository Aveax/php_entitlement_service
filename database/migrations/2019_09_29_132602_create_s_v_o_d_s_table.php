<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSVODSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_v_o_d_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->bigInteger('category')->nullable()->unsigned();
            $table->foreign('category')->references('id')->on('categories');
            $table->string('content');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('s_v_o_d_s')->insert([
            ['title' => 'First', 'category' => '1', 'content' => 'Content about sport'],
            ['title' => 'Second', 'category' => '2', 'content' => 'Content about technology'],
            ['title' => 'Third', 'category' => '3', 'content' => 'Content about business']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_v_o_d_s');
    }
}
