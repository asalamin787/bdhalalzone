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
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('chargeable_id');
            $table->string('chargeable_type');
            $table->string('uniqid');
            $table->string('url')->nullable();
            $table->enum('status', [
                'Paid',
                'Pending',
                'Cancelled',
                'Failed'
            ])->default('Pending');
            $table->string('method');
            $table->bigInteger('amount');
            $table->text('payment_details')->nullable();
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
        Schema::dropIfExists('charges');
    }
};
