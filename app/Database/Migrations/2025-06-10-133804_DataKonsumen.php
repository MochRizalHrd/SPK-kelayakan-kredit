<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataKonsumen extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kelayakan_usaha' => [
                'type'       => 'ENUM',
                'constraint' => ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk'],
            ],
            'riwayat_kredit' => [
                'type'       => 'ENUM',
                'constraint' => ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk'],
            ],
            'potensi_pendapatan' => [
                'type'       => 'ENUM',
                'constraint' => ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk'],
            ],
            'jaminan' => [
                'type'       => 'ENUM',
                'constraint' => ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk'],
            ],
            'analisis_pasar' => [
                'type'       => 'ENUM',
                'constraint' => ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk'],
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('data_konsumen');
    }

    public function down()
    {
        //
        $this->forge->dropTable('data_konsumen');
    }
}
