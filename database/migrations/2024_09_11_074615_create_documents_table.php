<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->json('tax')->nullable(); // Change to JSON to store multiple documents
            $table->json('pension')->nullable(); // Change to JSON to store multiple documents
            $table->json('income_statement')->nullable(); // Change to JSON to store multiple documents
            $table->json('balance_sheet')->nullable(); // Change to JSON to store multiple documents
            $table->json('payroll')->nullable(); // Change to JSON to store multiple documents
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
