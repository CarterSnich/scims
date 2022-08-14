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
            $table->enum('gender', ['male', 'female']);
            $table->unsignedInteger('age');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('picture');

            // contact information
            $table->string('phone_number', 11)->nullable();
            $table->string('email')->nullable();

            // location details
            $table->unsignedBigInteger('barangay')->nullable();
            $table->foreign('barangay')->references('id')->on('barangays')->onDelete('SET NULL');
            $table->string('province');
            $table->unsignedInteger('years_of_stay');

            // other information
            $table->string('religion');
            $table->enum('marital_status', ['unmarried', 'married', 'divorced', 'widowed']);
            $table->string('educational_attainment');
            $table->enum('status', ['active', 'deceased']);

            // emergency details
            $table->string('emergency_contact_person');
            $table->string('emergency_contact_number', 11);
            $table->string('emergency_contact_address');

            // vaccination details
            $table->date('first_dose_date')->nullable();
            $table->date('second_dose_date')->nullable();
            $table->date('booster_dose_date')->nullable();

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
