<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            /**
             * Ini membuat relasi self-referential di mana parent_id merujuk ke id di tabel yang sama (comments).
             * self-referential adalah cara untuk membuat hubungan di mana satu item bisa merujuk kepada item lain yang sama, seperti komentar yang memiliki balasan. Ini membantu kita mengorganisasi data dengan cara yang terstruktur dan mudah dimengerti.
             */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
