<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('customer');
            $table->enum('status', ['Válászra vár', 'Nincs kiszállítva', 'Úton a raktárból', 'Úton az ügyfélhez', 'Úton az üzletbe', 'Kiszállítva'])->default('Válaszra vár');
            $table->boolean('verified')->default(false);
            $table->integer('base_price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
