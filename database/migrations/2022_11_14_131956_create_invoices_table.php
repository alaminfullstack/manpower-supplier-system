<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->dateTime('invoice_date')->nullable();
            $table->string('invoice_month')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('credit_days')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('po_number')->nullable();
            $table->string('project_number')->nullable();
            $table->string('subject')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->double('total')->default(0);
            $table->double('vat_total')->default(0);
            $table->double('grand_total')->default(0);
            $table->boolean('status')->default(0);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
