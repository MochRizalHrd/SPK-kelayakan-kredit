<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaToData extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('data_konsumen', [
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'aktif',
                'after'      => 'id' // opsional, letak kolom
            ]
        ]);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('data_konsumen', 'nama');
    }
}
