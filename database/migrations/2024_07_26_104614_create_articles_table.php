<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Menambahkan foreign key dengan onDelete cascade
            $table->string('title');
            $table->string('slug')->nullable()->default('default-slug'); // Menambahkan default value dan mengizinkan NULL
            $table->longText('desc');
            $table->string('img')->nullable(); // Mengizinkan nilai NULL untuk gambar
            $table->string('status');
            $table->integer('views')->default(0); // Menambahkan nilai default
            $table->date('publish_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
}
