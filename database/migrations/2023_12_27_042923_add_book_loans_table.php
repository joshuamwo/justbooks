<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
		* Run the migrations.
		*/
	public function up(): void
	{
		Schema::create('book_loans', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users');
			$table->foreignId('book_id')->constrained('books');
			$table->date('loan_date');
			$table->date('due_date');
			$table->date('return_date')->nullable();
			$table->boolean('extended')->default(false);
			$table->date('extension_date')->nullable();
			$table->integer('penalty_amount')->default(0);
			$table->string('penalty_status')->default('unpaid');
			$table->string('status')->default('pending');
			$table->foreignId('added_by')->constrained('users');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
		* Reverse the migrations.
		*/
	public function down(): void
	{
		Schema::dropIfExists('book_loans');
	}
};
