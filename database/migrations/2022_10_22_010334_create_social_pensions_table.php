<?php

use App\Models\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialPensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_pensions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // picture
            $table->string('picture');

            // basic information
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('citizenship');
            $table->unsignedInteger('age');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->enum('sex', ['male', 'female']);
            $table->enum('civil_status', Constants::CIVIL_STATUSES);
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();
            $table->unsignedBigInteger('barangay');
            $table->foreign('barangay')->references('id')->on('barangays');
            $table->unsignedInteger('no_of_years_stay');
            $table->enum('living_arrangement', array_keys(Constants::LIVING_ARRANGEMENTS));

            // economic status
            $table->boolean('pensioner')->default(false);
            $table->decimal('pensioner_amount')->nullable();
            $table->enum('pensioner_source', array_keys(Constants::PENSIONER_SOURCES))->nullable()->default(null);
            $table->boolean('permanent_source_of_income')->default(false);
            $table->string('source_of_income')->nullable();
            $table->boolean('regular_support_from_family')->default(false);
            $table->enum('type_of_support', ['cash', 'kind'])->nullable()->default(null);
            $table->decimal('support_cash_amount')->nullable();
            $table->string('support_kind_specify')->nullable();
            $table->string('how_often')->nullable();

            // health condition
            $table->boolean('has_existing_illness')->default(false);
            $table->string('specify_illness')->nullable();
            $table->boolean('hospitalized_in_last_six_months')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_pensions');
    }
}
