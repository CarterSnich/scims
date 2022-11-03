<?php

use App\Models\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\ArrayKey;

class CreatePhilhealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('philhealths', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('pin')->nullable();
            $table->enum('purpose', array_keys(Constants::PH_PURPOSE));
            $table->string('konsulta_provider')->nullable();

            /*
             | -------------------------------------
             |
             |  PERSONAL DETAILS
             |
             | -------------------------------------
             */

            // member
            $table->string('member_lastname');
            $table->string('member_firstname');
            $table->string('member_name_extension')->nullable();
            $table->string('member_middlename')->nullable();
            $table->boolean('member_no_middlename')->default(false);
            $table->boolean('member_no_mononym')->default(false);

            // mother's
            $table->string('mother_lastname');
            $table->string('mother_firstname');
            $table->string('mother_name_extension')->nullable();
            $table->string('mother_middlename')->nullable();
            $table->boolean('mother_no_middlename')->default(false);
            $table->boolean('mother_no_mononym')->default(false);

            // spouse's
            $table->string('spouse_lastname')->nullable();
            $table->string('spouse_firstname')->nullable();
            $table->string('spouse_name_extension')->nullable();
            $table->string('spouse_middlename')->nullable();
            $table->boolean('spouse_no_middlename')->default(false);
            $table->boolean('spouse_no_mononym')->default(false);

            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('philsys_id_number')->nullable();
            $table->enum('sex', ['male', 'female']);
            $table->enum('civil_status', array_keys(Constants::PH_CIVIL_STATUS));
            $table->enum('citizenship', array_keys(Constants::PH_CITIZENSHIP));
            $table->string('tin')->nullable();

            /*
             | -------------------------------------
             |
             |  ADDRESS and CONTACT DETAILS
             |
             | -------------------------------------
             */

            // permanent home address
            $table->string('permanent_unit_room_no_floor')->nullable();
            $table->string('permanent_building_name')->nullable();
            $table->string('permanent_lot_block_phase_house_no')->nullable();
            $table->string('permanent_street_name')->nullable();
            $table->string('permanent_subdivision')->nullable();
            $table->string('permanent_barangay')->nullable();
            $table->string('permanent_municipality_city')->nullable();
            $table->string('permanent_province_state_country')->nullable();
            $table->string('permanent_zip_code')->nullable();

            // mailing address
            $table->string('mailing_unit_room_no_floor')->nullable();
            $table->string('mailing_building_name')->nullable();
            $table->string('mailing_lot_block_phase_house_no')->nullable();
            $table->string('mailing_street_name')->nullable();
            $table->string('mailing_subdivision')->nullable();
            $table->string('mailing_barangay')->nullable();
            $table->string('mailing_municipality_city')->nullable();
            $table->string('mailing_province_state_country')->nullable();
            $table->string('mailing_zip_code')->nullable();

            /*
             | -------------------------------------
             |
             |  DECLARATION OF DEPENDENTS
             |
             | -------------------------------------
             */

            $table->json('dependents')->nullable();

            // MEMBER TYPE

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('philhealths');
    }
}
