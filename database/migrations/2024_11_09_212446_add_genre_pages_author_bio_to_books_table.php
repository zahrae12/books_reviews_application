<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('genre')->nullable();        // Adding genre as a string
            $table->integer('pages')->nullable();       // Adding pages as an integer
            $table->text('author_bio')->nullable();     // Adding author_bio as a text field
        });
    }
    
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['genre', 'pages', 'author_bio']);
        });
    }
    
};
