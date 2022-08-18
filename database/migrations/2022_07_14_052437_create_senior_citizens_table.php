<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeniorCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senior_citizens', function (Blueprint $table) {
            $table->id();

            // personal information
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();

            // location details
            $table->unsignedBigInteger('barangay')->nullable();
            $table->foreign('barangay')->references('id')->on('barangays')->onDelete('SET NULL');
            $table->string('province');

            // other details
            $table->enum('gender', ['male', 'female']);
            $table->date('birthdate');
            $table->unsignedInteger('age');
            $table->enum('marital_status', ['unmarried', 'married', 'divorced', 'widowed']);

            // picture
            $table->string('picture');

            // delist details
            $table->boolean('is_delisted')->default(false);
            $table->text('delist_reason')->nullable();

            // ---------------------
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
        Schema::dropIfExists('senior_citizens');
    }
}
