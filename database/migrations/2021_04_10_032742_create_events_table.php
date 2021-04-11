<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title", 200)->nullable();
            $table->text("description")->nullable();
            $table->string('image')->nullable();
            $table->string("address", 100)->nullable();
            $table->string("city")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->enum("category", ["tour", "sport", "concert", "religious"])->default("tour");
            $table->boolean('featured')->default(false);
            $table->foreignId('user_id')
                ->constrained("users")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
