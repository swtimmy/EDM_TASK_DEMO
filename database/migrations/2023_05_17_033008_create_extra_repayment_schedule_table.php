<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraRepaymentScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_repayment_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId("loan_amortization_id")->constrained('loan_amortization')->onUpdate('cascade')->onDelete('cascade');;
            $table->integer("month_number");
            $table->decimal("starting_balance",19,4);
            $table->decimal("monthly_payment",19,4);
            $table->decimal("principal_component",19,4);
            $table->decimal("interest_component",19,4);
            $table->decimal("extra_repayment",19,4);
            $table->decimal("ending_balance",19,4);
            $table->decimal("remain_loan_balance",19,4);
            $table->integer("remain_loan_term");
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
        Schema::dropIfExists('extra_repayment_schedule');
    }
}
