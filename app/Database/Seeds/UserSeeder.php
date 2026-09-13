<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'   => 'talal37',
            'email'      => 'talal@t.com',
            'password'   => password_hash('123123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

    
        $this->db->table('users')->insert($data);
    }
}