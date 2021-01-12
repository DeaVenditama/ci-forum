<?php
namespace App\Database\Seeds;

class ThreadSeeder extends \CodeIgniter\Database\Seeder{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0;$i<1000;$i++)
        {
            $data = [
                'judul' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'isi' => $faker->paragraph($nbSentences = 6, $variableNbSentences = true),
                'id_kategori' => rand(1,4),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 5
            ];
            echo "Inserting ".($i+1)." Dummy Data\n";
            $this->db->table('thread')->insert($data);
        }
    }
}