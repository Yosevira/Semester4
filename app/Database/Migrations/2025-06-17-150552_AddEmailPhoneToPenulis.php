<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailPhoneToPenulis extends Migration
{
    public function up()
    {
        $this->forge->addColumn('penulis',[
             'phone' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
                'after'        => 'address',
             ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'unique'        => true, 
                'null'          => true, 
                'after'        => 'phone',
             ],   
     ]);
    }

    public function down()
    {
        $this->forge->dropColumn('penulis',['phone','email']);
    }
}