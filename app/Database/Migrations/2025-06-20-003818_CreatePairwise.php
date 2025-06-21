<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePairwise extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kriteria1_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'kriteria2_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nilai' => [
                'type' => 'FLOAT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kriteria1_id', 'data_kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kriteria2_id', 'data_kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pairwise');
    }

    public function down()
    {
        $this->forge->dropTable('pairwise');
    }
}
