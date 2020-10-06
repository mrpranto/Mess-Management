<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBazarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bazars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->date('date');
            $table->decimal('bazar_amount', 14,2);
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bazars');
    }
}
