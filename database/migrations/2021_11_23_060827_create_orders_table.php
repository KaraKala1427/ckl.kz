<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product');
            $table->string('iin', 12);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('patronymic_name')->nullable();
            $table->string('policy_result')->nullable();
            $table->string('premium_sum')->nullable();
            $table->string('agr_isn')->nullable();
            $table->enum('status', [Order::STATUS_ACCEPTED, Order::STATUS_ERROR, Order::STATUS_PENDING, Order::STATUS_REJECTED, Order::STATUS_CALCULATED, Order::STATUS_IN_PROCESS])->default(Order::STATUS_CALCULATED);
            $table->string('order_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}


