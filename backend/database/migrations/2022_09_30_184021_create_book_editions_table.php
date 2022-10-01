<?php

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_editions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Book::class);
            $table->string('name');
            $table->integer('year');
            $table->float('price');
            $table->string('image');
            $table->integer('quantity');
            $table->foreignIdFor(Publisher::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_editions');
    }
};
