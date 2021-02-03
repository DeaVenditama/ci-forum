<?php
namespace App\Database\Seeds;

class RatingSeeder extends \CodeIgniter\Database\Seeder{
    public function run()
    {
        for($i=0;$i<10000;$i++)
        {
            $data = [
                'id_thread' => rand(1,1000),
                'id_user' => rand(4,503),
                'star' => rand(1,5),
            ];
            echo "Inserting ".($i+1)." Dummy Data\n";
            $this->db->table('rating')->insert($data);
        }
    }
}