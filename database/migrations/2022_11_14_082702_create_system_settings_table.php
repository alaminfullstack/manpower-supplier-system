<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_title');
            $table->string('app_title_arabic')->nullable();
            $table->string('app_image')->nullable();
            $table->string('vat_number')->nullable();
            $table->integer('default_vat')->default(15);
            $table->string('favicon_image')->nullable();
            $table->string('invoice_image')->nullable();
            $table->string('default_image')->nullable();
            $table->string('customer_default_image')->nullable();
            $table->foreignId('default_currency')->nullable()->constrained('currencies')->onDelete('set null');
            $table->string('address')->default('qatar');
            $table->string('phone')->default('0890898922');
            $table->string('email')->default('example@gmail.com');
            $table->string('currency_symbol')->default('riyals');
            $table->string('currency_code')->default('riyal');
            $table->string('currency_position')->default('right');
            $table->string('date_format')->default('d-M-Y');
            $table->string('date_time_format')->default('d-M-Y h:i:s');
            $table->string('default_time_zone')->default('asia/dhaka');
            $table->integer('decimal_number_limit')->default(2);
            $table->integer('enabled_dark_mode')->default(0);
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
        Schema::dropIfExists('system_settings');
    }
}
