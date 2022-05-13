<?php

use App\Models\User;
use App\Models\Application;
use App\Models\RegisterEmail;
use Illuminate\Database\Seeder;



class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $accounts = [
            [
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'user@user.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        $applications = [
            [
                'status'                    => 'PENDING',
                'user_id'                   => '2',
                'image'                     => '1_Test Name.png',
                'name'                      => 'Test Name',
                'school'                    => 'Test',
                'course'                    => 'Test',
                'contact_number'            => '09125099407',
                'birth_date'                => '2000-02-21',
                'address'                   => 'Test',
                'application_id'            => 'Test',
                'student_advisor'           => 'Test',
                'advisor_email'             => 'test@test.test',
                'required_hours'            => '400',
                'schedule'                  => 'Test',
                'starting_date'             => '2022-01-10',
                'ending_date'               => '2022-05-10',
                'consent'                   => '1',

                'company_name'                  => 'test',
                'company_address'               => 'test',
                'supervisor_name'               => 'test',
                'supervisor_email_address'      => 'test@test.test',
                'supervisor_contact_number'     => '09125099407',
                'current_job_title'             => 'test',
                'give_job_titles'               => 'test',


                'checklist1'                   => '1',
                'checklist2'                   => '1',
                'checklist3'                   => '1',
                'checklist4'                   => '1',
                'checklist5'                   => '1',
                'checklist6'                   => '1',
                'checklist7'                   => '1',
                'checklist8'                   => '1',
                'checklist9'                   => '1',
                'proof_of_attendance'          => '1_Test Name.pdf',
                'advance_coc'                  => 'YES',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        $emails = [
            [
                'email'          => 'user1@user1.com',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'user2@user2.com',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        RegisterEmail::insert($emails);
        User::insert($accounts);
        Application::insert($applications);
    
        
    }
}
