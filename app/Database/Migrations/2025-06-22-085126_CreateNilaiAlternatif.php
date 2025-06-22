<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNilaiAlternatif extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_alternatif' => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'id_kriteria' => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'nilai' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['id_alternatif', 'id_kriteria']);
        $this->forge->addForeignKey('id_alternatif', 'data_konsumen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kriteria', 'data_kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nilai_alternatif');
    }

    public function down()
    {
        $this->forge->dropTable('nilai_alternatif');
    }
}
