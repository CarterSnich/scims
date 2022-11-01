<?php

use App\Models\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePensionIntakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pension_intakes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("lastname");
            $table->string("firstname");
            $table->string("middlename")->nullable();
            $table->string("nhts_pr_hh_no");
            $table->enum("sex", ['male', 'female']);
            $table->enum("civil_status", Constants::CIVIL_STATUSES);
            $table->date("date_of_birth");
            $table->string("place_of_birth");
            $table->string("house_no");
            $table->string("street");
            $table->unsignedBigInteger("barangay");
            $table->foreign('barangay')->references('id')->on('barangays');
            $table->string("citizenship");
            $table->string("landline");
            $table->string("email");
            $table->string("mobile_no");
            $table->enum("affiliation", array_keys(Constants::AFFILIATIONS))->nullable();
            $table->string("affiliation_others")->nullable();
            $table->string("osca_id");
            $table->string("issued_on");
            $table->string("issued_at");
            $table->enum("living_arrangement", array_keys(Constants::LIVING_ARRANGEMENTS));
            $table->boolean("pensioner")->default(false);
            $table->enum("pensioner_source", array_keys(Constants::PENSIONER_SOURCES_2))->nullable();
            $table->decimal("pensioner_amount")->nullable();
            $table->boolean("regular_support_from_family")->default(false);
            $table->enum("type_of_support", ['cash', 'kind'])->nullable();
            $table->decimal("support_cash_amount")->nullable();
            $table->string("support_kind_specify")->nullable();
            $table->enum("meals_per_day", [3, 2, 1]);
            $table->boolean("is_disabled")->default(false);
            $table->string("specify_disability")->nullable();
            $table->boolean("is_immobile")->default(false);
            $table->enum("immobile_state", ['bedridden', 'dependent'])->nullable();;
            $table->string("pre_existing_illnesses")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pension_intakes');
    }
}
