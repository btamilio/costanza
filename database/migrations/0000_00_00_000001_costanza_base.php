<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
  
        Schema::create('poems', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer('user_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('topic', 255)->nullable();
            $table->longText('prompt')->nullable();
            $table->longText('response')->nullable();
            $table->longText('lineation')->nullable();
            $table->longText('authors_note')->nullable();
           // $table->boolean('is_public')->default(1);
            $table->boolean('flag_prompt')->default(0);
            $table->boolean('flag_content')->default(0);
            $table->boolean('flag_response')->default(0);
            $table->timestamps();
            $table->timestamp('generated_at')->nullable();
            $table->softDeletes('deleted_at');
        });


        // meter, foot, style, theme, seed
        Schema::create('features_types', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name', 255)->nullable();
            $table->string('label', 255)->nullable();
            $table->string('prompt_label', 255)->nullable();
            $table->integer('sort_order')->nullable();
            $table->integer('hidden')->default(0);
            $table->softDeletes('deleted_at');
        });


        Schema::create('features', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('feature_type_id')->constrained('features_types')->onDelete('cascade');
            $table->string('name', 255)->nullable();
            $table->string('label', 255)->nullable();
            $table->string('prompt_label', 255)->nullable();
            $table->integer('sort_order')->nullable();
            $table->integer('hidden')->default(0);
            $table->softDeletes('deleted_at');
        });


        Schema::create('poem_feature', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('poem_id')->constrained()->onDelete('cascade');
            $table->foreignId('feature_id')->constrained()->onDelete('cascade');
            $table->softDeletes('deleted_at');
        });


    }

    public function down(): void
    {        
        Schema::dropIfExists('poems');
        Schema::dropIfExists('poem_feature');
        Schema::dropIfExists('features');
        Schema::dropIfExists('features_types');
        Schema::dropIfExists('poem_feature'); 
    }
};
