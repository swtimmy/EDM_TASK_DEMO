<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanAmortizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_amortization', function (Blueprint $table) {
            $table->id();
            $table->string("loan_name");
            $table->decimal("loan_amount",19,4);
            $table->integer("loan_term");
            $table->decimal("interest_rate",8,4);
            $table->decimal("monthly_fixed_extra_payment",19,4);
            $table->timestamps();
            $table->unique(['loan_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_amortization');
    }
}
