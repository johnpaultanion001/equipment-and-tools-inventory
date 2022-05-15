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

            //WORK AGREEMENT SECTION
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('supervisor_name')->nullable();
            $table->string('supervisor_email_address')->nullable();
            $table->string('supervisor_contact_number')->nullable();
            $table->longText('current_job_title')->nullable();
            $table->longText('give_job_titles')->nullable();

            //INTERNSHIP REQUIREMENTS CHECKLIST
            $table->string('checklist1')->nullable();
            $table->string('checklist2')->nullable();
            $table->string('checklist3')->nullable();
            $table->string('checklist4')->nullable();
            $table->string('checklist5')->nullable();
            $table->string('checklist6')->nullable();
            $table->string('checklist7')->nullable();
            $table->string('checklist8')->nullable();
            $table->string('checklist9')->nullable();
            $table->string('proof_of_attendance')->nullable();
            $table->string('advance_coc')->nullable();

            //FOR ADMIN
            $table->string('admin_attach_file')->nullable();
            
            //STEP 2
            $table->string('receive_status')->default('0');

            //STEP 3
            $table->string('answer_video')->nullable();
            

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
