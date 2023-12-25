<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManPowerSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('man_power_supplies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('serial_no')->default(1);
            $table->dateTime('supply_date')->default(now());
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('people_id')->nullable()->constrained('people')->onDelete('set null');
            $table->string('iqama_id')->nullable();
            $table->string('designation')->nullable();
            $table->double('total_hours')->default(0);
            $table->double('rate_hour')->default(0);
            $table->double('total_amount')->default(0);
            $table->integer('vat')->default(0);
            $table->double('vat_amount')->default(0);
            $table->double('grand_amount')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('man_power_supplies');
    }
}
