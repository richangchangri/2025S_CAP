<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'          => 'Brown',
            'email'         => 'brown@gmail.com',
            'password'      => password_hash('1234567890', PASSWORD_DEFAULT),
            'department_id' => 1, // Ensure this department exists
            'role'          => 'Admin', // Ensure this role exists
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Insert data into users table
        $this->db->table('Users')->insert($data);
    }
}