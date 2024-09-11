<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->constrained()->onDelete('cascade'); // Make business_id nullable
            $table->string('report_type')->nullable();
            $table->boolean('tax_status')->default(false);
            $table->boolean('payroll_status')->default(false);
            $table->boolean('statement_status')->default(false);
            $table->string('report_center');

            $table->dateTime('tax_due_date')->nullable();
            $table->dateTime('payroll_due_date')->nullable();
            $table->dateTime('statement_due_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
