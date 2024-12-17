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
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->string('book_id');
            $table->unsignedBigInteger('user_id');
            $table->date('issue_date');
            $table->date('return_date');
            $table->tinyInteger('is_returned')->default(0)->comment('0 for not returned, 1 for returned');
            $table->tinyInteger('is_extended')->default(0)->comment('0 for not extended, 1 for extended');
            $table->tinyInteger('is_lost')->default(0)->comment('0 for not lost, 1 for lost');
            $table->tinyInteger('is_damage')->default(0)->comment('0 for not damage, 1 for damage');
            $table->tinyInteger('is_fine')->default(0)->comment('0 for not fine, 1 for fine');
            $table->decimal('fine_amount', 8, 2)->default(0.00);
            $table->text('remarks')->nullable();
            $table->integer('book_issue_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_issues');
    }
};
