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
        Schema::create('tavars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brend');
            $table->string('img');
            $table->integer('user_id');
            $table->integer('cate_id');
            $table->integer('active');
            $table->unsignedBigInteger('narx1');
            $table->unsignedBigInteger('narx2');
            $table->unsignedBigInteger('soni');
            $table->unsignedBigInteger('foyda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tavars');
    }
};
