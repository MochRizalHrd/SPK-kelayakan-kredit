<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembobotanNilai extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'bobot' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null'       => false,
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
        $this->forge->createTable('pembobotan_nilai');
    }

    public function down()
    {
        //
        $this->forge->dropTable('pembobotan_nilai');
    }
}
