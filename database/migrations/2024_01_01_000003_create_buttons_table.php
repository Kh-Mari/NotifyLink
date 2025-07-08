<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buttons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained()->onDelete('cascade');
            $table->string('label', 64);
            $table->string('url', 512)->nullable();
            $table->string('file_filename', 256)->nullable();
            $table->string('icon_class', 64)->nullable();
            $table->integer('order')->default(0);
            $table->integer('click_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_promotion')->default(false);
            $table->string('promotion_color', 7)->default('#ef4444');
            $table->string('discount_label', 32)->nullable();
            $table->timestamps();
            
            $table->index(['link_id', 'order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('buttons');
    }
};