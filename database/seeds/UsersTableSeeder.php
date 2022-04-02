<?php

use App\Models\User;
use App\Models\Clinic;
use App\Models\Client;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Announcement;
use Illuminate\Database\Seeder;



class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $accounts = [
            [
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'isApproved' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'clinic1@clinic1.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'isApproved' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'clinic2@clinic2.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'isApproved' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email'          => 'client1@client1.com',
                'password'       => '$2y$10$vUIzDlvfpu2yOATsPYcPaOTY/zgbgwViLIWSfZxSlmRBFV.g/fmOW',
                'isApproved' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            
        ];

        $clinics = [
            [
                'user_id'                   => '2',
                'name'                      => 'Clinic 1',
                'contact_number'            => '09123456789',
                'address'                   => 'Ground Floor Victory Park & Shop ML Quezon and, P. Oliveros Street, Antipolo, 1870 Rizal',
                'lat'                       => 14.587449381156755,
                'lng'                       => 121.175578287383,
                'business_permit'           => 'business_permit1.png',  
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
                'isApproved' => 1,
            ],
            [
                'user_id'                   => '3',
                'name'                      => 'Clinic 2',
                'contact_number'            => '09123456789',
                'address'                   => 'Ortigas Ave, Pasig, Metro Manila',
                'lat'                       => 14.590684405803234,
                'lng'                       => 121.06905456425052,
                'business_permit'           => 'business_permit2.png',  
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
                'isApproved' => 1,
            ],
        ];

        $clients = [
            [
                'user_id'                   => '4',
                'name'                      => 'Client 1',
                'address'                   => 'Ground Floor Victory Park & Shop ML Quezon and, P. Oliveros Street, Antipolo, 1870 Rizal',
                'contact_number'            => '09123456789',
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
        ];

        $services = [
            [
                'clinic_id'                   => '1',
                'name'               => 'Service 1 Clinic 1',
              
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '1',
                'name'               => 'Service 2 Clinic 1',
              
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '1',
                'name'               => 'Service 3 Clinic 1',
              
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '2',
                'name'               => 'Service 1 Clinic 2',
              
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '2',
                'name'               => 'Service 2 Clinic 2',
              
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '2',
                'name'               => 'Service 3 Clinic 2',
              
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
           
        ];
        $doctors = [
            [
                'clinic_id'                   => '1',
                'name'               => 'Doctor 1 Clinic 1',
                'contact_number'            => '09123456789',
                'medical_license'           => 'medical_license1.jpg',
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '1',
                'name'               => 'Doctor 2 Clinic 1',
                'contact_number'            => '09123456789',
                'medical_license'           => 'medical_license2.jpg',
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '1',
                'name'               => 'Doctor 3 Clinic 1',
                'contact_number'            => '09123456789',
                'medical_license'           => 'medical_license3.jpg',
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '2',
                'name'               => 'Doctor 1 Clinic 2',
                'contact_number'            => '09123456789',
                'medical_license'           => 'medical_license4.jpg',
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '2',
                'name'               => 'Doctor 2 Clinic 2',
                'contact_number'            => '09123456789',
                'medical_license'           => 'medical_license5.jpg',
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
            [
                'clinic_id'                   => '2',
                'name'               => 'Doctor 3 Clinic 2',
                'contact_number'            => '09123456789',
                'medical_license'           => 'medical_license6.jpg',
                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ],
           
        ];

        $appoinments = [
            [
                'user_id'       => '4',
                'clinic_id'     => '1',
                'service_id'    => '3',
                'doctor_id'     => '3',
                'date'          => '2022-03-05',
                'time'          => '16:58',

                'created_at'                => '2021-09-27 18:59:31',
                'updated_at'                => '2021-09-27 19:07:34',
            ] 
        ];

        $announcements = [
            [
                'title'             => 'Test Announcement 1',
                'description'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
                'for'               => 'ALL',
                'image'             => 'announcement1.png',
                'link_website'      => 'https://www.facebook.com/',

                'created_at'        => '2021-09-27 18:59:31',
                'updated_at'        => '2021-09-27 19:07:34',
            ] ,
            [
                'title'             => 'Test Announcement 2',
                'description'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
                'for'               => 'ALL',
                'image'             => null,
                'link_website'      => 'https://www.facebook.com/',

                'created_at'        => '2021-09-27 18:59:31',
                'updated_at'        => '2021-09-27 19:07:34',
            ] 
        ];

        
        Appointment::insert($appoinments);
        User::insert($accounts);
        Clinic::insert($clinics);
        Client::insert($clients);
        Service::insert($services);
        Doctor::insert($doctors);
        Announcement::insert($announcements);
        
    }
}
