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

            /* PERSONAL DETAILS */

            // member
            $table->string('member_lastname');
            $table->string('member_firstname');
            $table->string('member_name_extension')->nullable();
            $table->string('member_middlename')->nullable();
            $table->boolean('member_no_middlename')->default(false);
            $table->boolean('member_no_mononym')->default(false);

            // mother's
            $table->string('mother_lastname')->nullable();
            $table->string('mother_firstname')->nullable();
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

            /* ADDRESS and CONTACT DETAILS */

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
            $table->boolean('same_as_above')->default(false);
            $table->string('mailing_unit_room_no_floor')->nullable();
            $table->string('mailing_building_name')->nullable();
            $table->string('mailing_lot_block_phase_house_no')->nullable();
            $table->string('mailing_street_name')->nullable();
            $table->string('mailing_subdivision')->nullable();
            $table->string('mailing_barangay')->nullable();
            $table->string('mailing_municipality_city')->nullable();
            $table->string('mailing_province_state_country')->nullable();
            $table->string('mailing_zip_code')->nullable();

            // contact
            $table->string('home_phone_no')->nullable();
            $table->string('mobile_no');
            $table->string('business_direct_line')->nullable();
            $table->string('email')->nullable();


            /* DECLARATION OF DEPENDENTS */
            $table->json('dependents')->nullable();

            /* MEMBER TYPE */

            // direct contributor
            $table->boolean("employed_private")->default(false);
            $table->boolean("kasambahay")->default(false);
            $table->boolean("family_driver")->default(false);
            $table->boolean("employed_government")->default(false);
            $table->boolean("migrant_worker")->default(false);
            $table->boolean("professional_practitioner")->default(false);
            $table->enum("migrant_worker_based", ['land', 'sea'])->nullable();
            $table->boolean("self_earning")->default(false);
            $table->boolean("lifetime")->default(false);
            $table->boolean("individual")->default(false);
            $table->boolean("dual_citizenship")->default(false);
            $table->boolean("sole_proprietor")->default(false);
            $table->boolean("foreign_national")->default(false);
            $table->boolean("group_enrollment")->default(false);
            $table->string("pra_ssrv_no")->nullable();
            $table->string("group_enrollment_scheme")->nullable();
            $table->string("acr_icard_no")->nullable();

            // indirect Contributor
            $table->boolean("listahanan")->default(false);
            $table->boolean("lgu_sponsored")->default(false);
            $table->boolean("four_ps_mcct")->default(false);
            $table->boolean("nga_sponsored")->default(false);
            $table->boolean("senior_citizen")->default(false);
            $table->boolean("private_sponsored")->default(false);
            $table->boolean("pamana")->default(false);
            $table->boolean("kia_kipo")->default(false);
            $table->boolean("person_with_disability")->default(false);
            $table->string("pwd_id_no")->nullable();
            $table->boolean("bangsamoro_normalization")->default(false);

            // income
            $table->string("profession")->nullable();
            $table->string("monthly_income")->nullable();
            $table->string("proof_of_income")->nullable();

            // for philhealth use only
            $table->boolean("pos_financially_incapable")->default(false);
            $table->boolean("financially_incapable")->default(false);

            /* UPDATE/AMENDENT */

            // change/correct name
            $table->boolean("change_correction_of_name")->default(false);
            $table->string("update_name_from")->nullable();
            $table->string("update_name_to")->nullable();

            // correction of date of birth
            $table->boolean("correction_of_date_of_birth")->default(false);
            $table->string("update_date_of_birth_from")->nullable();
            $table->string("update_date_of_birth_to")->nullable();

            // correction of Sex
            $table->boolean("correction_of_sex")->default(false);
            $table->string("update_sex_from")->nullable();
            $table->string("update_sex_to")->nullable();

            // change of civil status
            $table->boolean("change_of_civil_status")->default(false);
            $table->string("update_civil_status_from")->nullable();
            $table->string("update_civil_status_to")->nullable();

            // change of personal info
            $table->boolean("update_personal_info")->default(false);
            $table->string("update_personal_info_from")->nullable();
            $table->string("update_personal_info_to")->nullable();
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
