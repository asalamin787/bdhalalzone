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
        Schema::create('retailers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('unique_id')->unique()->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('division')->nullable();
            $table->string('zilla')->nullable();
            $table->string('upzilla')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('address')->nullable();
            $table->decimal('percentage_cost',8,2)->nullable()->default(0);
            $table->decimal('total_own',8,2)->nullable();
            $table->decimal('total_withdraw',8,2)->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retailers');
    }
};
