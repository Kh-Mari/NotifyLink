<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('slug', 64)->unique();
            $table->string('logo_filename', 256)->nullable();
            $table->string('background_filename', 256)->nullable();
            $table->string('button_color', 7)->default('#3b82f6');
            $table->string('button_style', 20)->default('rounded');
            $table->string('background_color', 7)->default('#ffffff');
            $table->string('text_color', 7)->default('#333333');
            $table->string('logo_shape', 20)->default('circle');
            $table->string('logo_size', 20)->default('medium');
            $table->string('background_style', 20)->default('cover');
            $table->boolean('use_background_image')->default(false);
            $table->integer('visit_count')->default(0);
            
            // Container styling options - ALL from Python version
            $table->string('container_background', 7)->default('#ffffff');
            $table->string('container_border_color', 7)->default('#e5e7eb');
            $table->integer('container_border_width')->default(1);
            $table->integer('container_border_radius')->default(20);
            $table->boolean('container_shadow')->default(true);
            $table->boolean('container_blur')->default(true);
            $table->integer('container_opacity')->default(95);
            $table->boolean('use_container_styling')->default(true);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('links');
    }
};