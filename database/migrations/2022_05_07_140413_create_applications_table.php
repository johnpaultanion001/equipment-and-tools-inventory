<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            //INTERN INFORMATION 
            $table->string('status')->nullable();
            $table->string('user_id')->nullable();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('school')->nullable();
            $table->string('course')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('application_id')->nullable();
            $table->string('student_advisor')->nullable();
            $table->string('advisor_email')->nullable();
            $table->string('required_hours')->nullable();
            $table->string('schedule')->nullable();
            $table->string('starting_date')->nullable();
            $table->string('ending_date')->nullable();
            $table->string('consent')->nullable();
            

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
        Schema::dropIfExists('applications');
    }
}
