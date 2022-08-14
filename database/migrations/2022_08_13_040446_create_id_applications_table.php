<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_applications', function (Blueprint $table) {
            $table->id();

            // purpose
            $table->enum('purpose', ['new_registration', 'lost_id', 'replacement', 'transferee']);

            // application details
            $table->date('date_applied');
            $table->string('osca_id');
            $table->date('date_issued');

            // applicant
            $table->unsignedBigInteger('citizen')->nullable();
            $table->foreign('citizen')->references('id')->on('senior_citizens')->onDelete('SET NULL');

            // for replacement
            $table->json('replacement_reasons')->nullable();
            $table->string('replacement_reason_others')->nullable();

            // for lost id
            $table->date('date_of_loss')->nullable();
            $table->string('lost_location')->nullable();

            // for transferee
            $table->string('transfer_from')->nullable();
            $table->string('transfer_to')->nullable();
            $table->string('transfer_reason')->nullable();

            // ---------------------------
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
        Schema::dropIfExists('id_applications');
    }
}
