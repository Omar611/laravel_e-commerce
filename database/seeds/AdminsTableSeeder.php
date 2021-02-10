<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => '1',
                'name' => 'admin',
                'type' => 'admin',
                'mobile' => '+201112034436',
                'email' => 'admin@test.com',
                'password' => '$2y$12$.80Kj7LpliYMjS3otkK1puZum9KcJ6LWELwIHqSAAxy/K9i4hURLy',
                'image' => '',
                'status' => 1,
            ],
            [
                'id' => '2',
                'name' => 'TestUser777777',
                'type' => 'subadmin',
                'mobile' => '+201112034437',
                'email' => 'TestUser777777@gmail.com',
                'password' => '$2y$12$.80Kj7LpliYMjS3otkK1puZum9KcJ6LWELwIHqSAAxy/K9i4hURLy',
                'image' => '',
                'status' => 1,
            ],
        ];

        foreach ($adminRecords as $key => $record) {
            Admin::create($record);
        }
    }
}
