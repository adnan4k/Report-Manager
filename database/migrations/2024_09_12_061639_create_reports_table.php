<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->constrained('businesses')->onDelete('cascade'); // Make business_id nullable
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
