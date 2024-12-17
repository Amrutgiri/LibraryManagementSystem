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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('max_day_limit')->nullable(7);
            $table->bigInteger('max_book_limit')->nullable(2);
            $table->bigInteger('send_after_mail')->nullable();
            $table->bigInteger('send_before_mail')->nullable();
            $table->string('form_email')->nullable();
            $table->double('fine_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
