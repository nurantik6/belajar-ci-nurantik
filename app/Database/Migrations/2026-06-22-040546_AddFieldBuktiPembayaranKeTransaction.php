<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class AddFieldBuktiPembayaranKeTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'bukti_pembayaran' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
            'null' => true,
            'after' => 'status'
            // Opsional: untuk menentukan posisi field
            ]
        ];
        // Tambahkan kolom ke tabel yang dituju
        $this->forge->addColumn('transaction', $fields);
    }

    public function down()
    {
        // Hapus kolom jika migrasi dibatalkan (rollback)
        $this->forge->dropColumn('transaction', ['bukti_pembayaran']);
    }
}
