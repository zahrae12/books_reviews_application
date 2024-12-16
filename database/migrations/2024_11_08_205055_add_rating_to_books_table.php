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
        // Adding the rating column with an integer type
        $table->integer('rating')->nullable(); // rating is nullable, adjust based on your needs
    });
}

public function down()
{
    Schema::table('books', function (Blueprint $table) {
        // Remove the rating column in case of rollback
        $table->dropColumn('rating');
    });
}

};
