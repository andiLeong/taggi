<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug');
            $table->unsignedInteger('count')->default(0);
            $table->timestamps();
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
            $table->unsignedInteger('taggable_id');
            $table->string('taggable_type');
            $table->timestamps();

            $table->unique(['tag_id','taggable_id','taggable_type']);
        });


        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
        Schema::dropIfExists('taggables');

        Schema::dropIfExists('tags');
        Schema::dropIfExists('topics');
    }
}
