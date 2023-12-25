<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('restrict');
            $table->foreignId('people_id')->constrained('people')->onDelete('restrict');
            $table->bigInteger('serial_number')->default(1);
            $table->string('iqama_id')->nullable();
            $table->string('designation')->nullable();
            $table->double('total_hours')->default(0);
            $table->double('rate_hour')->default(0);
            $table->double('total_price')->default(0);
            $table->integer('vat')->default(15);
            $table->double('vat_amount')->default(0);
            $table->double('grand_price')->default(0);
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
        Schema::dropIfExists('invoice_details');
    }
}
