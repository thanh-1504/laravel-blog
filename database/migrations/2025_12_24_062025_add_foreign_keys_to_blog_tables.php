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
    Schema::table('categories', function (Blueprint $table) {
        $table->unsignedBigInteger('parent')->change(); 
        $table->foreign('parent')->references('id')->on('parent_categories')->onDelete('cascade');
    });

    Schema::table('posts', function (Blueprint $table) {
        $table->unsignedBigInteger('category')->change();
        $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');

        $table->unsignedBigInteger('author_id')->change();
        $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('categories', function (Blueprint $table) {
        $table->dropForeign(['parent']);
    });

    Schema::table('posts', function (Blueprint $table) {
        $table->dropForeign(['category']);
        $table->dropForeign(['author_id']);
    });
}
};
