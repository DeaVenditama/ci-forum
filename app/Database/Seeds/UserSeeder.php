<?php
namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0;$i<500;$i++)
        {
            $data = [
                'username' => $faker->username,
                'password' => $faker->password,
                'salt' => $faker->password,
                'nama' => $faker->name,
                'email' => $faker->email,
                'tanggal_lahir' => $faker->date($format='Y-m-d', $max='now'),
                'alamat' => $faker->address,
                'telp' => $faker->phoneNumber,
                'avatar' => 'avatar',
                'role' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 5,
                'updated_at' => null,
                'updated_by' => null,
            ];
            echo "Inserting ".($i+1)." Dummy Data\n";
            $this->db->table('user')->insert($data);
        }
    }
}