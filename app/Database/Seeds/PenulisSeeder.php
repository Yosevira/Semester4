<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenulisSeeder extends Seeder
{
    public function run()
    {
      //  $data = [
      //      [
      //          'name' => 'Tomy Syarifudin',
      //          'address'   => 'Jl Gus Dur no 150 Jombang',
      //          'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //          'name' => 'Agus Setiawan',
        //         'address'   => 'Jl Merdeka no 150 Jombang',
        //        'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //    ],
        //    [
        //        'name' => 'Kang Dedi',
        //        'address'   => 'Jl Pattimura no 150 Jombang',
        //        'created_at' => Time::now(),
        //        'updated_at' => Time::now()
        //    ],
        //];

        //simple queries
        //$this->db->query('INSERT INTO penulis(name, address, created_at, updated_at)VALUES( :name, :address, : created, :created_at, updated_at:)', $data)
        
        //Using Query Builder

        $faker = \Faker\Factory::create('id_ID');
        //for ($i = 0; $i < 100; $i++) {

          //  $data = [
          //      'name' => $faker->name,
          //      'address' => $faker->address,
          //      'phone' => $faker->phoneNumber,
          //      'email' => $faker->unique()->safeEmail,
          //      'created_at' => Time::createFromTimestamp($faker->unixTime()),
          //      'updated_at' => Time::now()
          //  ];
        //$this->db->table('penulis')->insert($data);

        $penulisTanpaEmailPhone = $this->db->table('penulis')
                                            ->where('email IS NULL')
                                            ->where('phone IS NULL')
                                            ->get()
                                            ->getResultArray();

        foreach($penulisTanpaEmailPhone as $penulis) {
            $updateData = []; //cek apakah sudah ada email/phone

            if (empty($penulis['email'])) {
                //generate email berdasarkan nama penulis
                $emailPrefix = str_replace(' ','.', strtolower($penulis['name']));
                $updateData['email'] = $faker->unique()->userName. '@gmail.com';
            }
            if (empty($penulis['phone'])) {
                //mengatur format nomor telpon diawali 08
                $updateData['phone'] = '08' . $faker->numerify('##########');
            }

            //menambahkan update_at
            if (!empty($updateData)) {
                $updateData['updated_at'] = Time::now()->toDateTimeString();

                //operasi update
                $this->db->table('penulis')
                    ->where('id', $penulis['id'])
                    ->update($updateData);

                echo "Update Penulis ID : " . $penulis['id'] . "\n";
            }
        }
        
    }     
}         