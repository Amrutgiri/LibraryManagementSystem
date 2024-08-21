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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('total_pages', 8, 2)->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->string('language')->nullable();
            $table->string('department')->nullable();
            $table->string('rack')->nullable();
            $table->string('classification_no')->nullable();
            $table->string('auther')->nullable();
            $table->string('publication')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('isbn')->nullable();
            $table->string('genre')->nullable();
            $table->string('notes')->nullable();
            $table->integer('number_of_copy');
            $table->string('status')->default(0)->comment('0 for available, 1 for not available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
