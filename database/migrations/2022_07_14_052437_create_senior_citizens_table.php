<?php

use App\Models\Constants;
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
            $table->timestamps();

            // name
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();

            // picture
            $table->string('picture');

            // peronsal information
            $table->date('date_of_birth');
            $table->unsignedInteger('age');
            $table->enum('sex', ['male', 'female']);
            $table->string('place_of_birth');
            $table->enum('civil_status', Constants::CIVIL_STATUSES);
            // $table->string('address'); // broken down specific attributes
            $table->enum('educational_attainment', array_keys(Constants::EDUCATIONAL_ATTAINMENTS));
            $table->string('occupation');
            $table->decimal('annual_income', 10, 2, true);
            $table->text('other_skills')->nullable();

            // address
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();
            $table->unsignedBigInteger('barangay');
            $table->foreign('barangay')->references('id')->on('barangays');

            // family composition
            $table->json('family_composition')->nullable();

            // membership to senior citizen association
            $table->string('name_of_association')->nullable();
            $table->string('address_of_association')->nullable();
            $table->date('date_of_membership')->nullable();
            $table->date('date_elected')->nullable();
            $table->string('term')->nullable();

            // delist details
            $table->boolean('is_delisted')->default(false);
            $table->text('delist_reason')->nullable();
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
