<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan</title>
    <style>
        /* Import font Poppins dengan fallback sans-serif untuk PDF generator */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #455a64;
        }
        
        /* Kustomisasi Judul */
        h3 {
            text-align: center;
            color: #1e88e5; /* Biru terang pastel */
            margin-bottom: 5px;
            font-size: 18px;
            font-weight: 700;
        }
        .periode {
            text-align: center;
            color: #78909c;
            margin-top: 0;
            margin-bottom: 20px;
        }

        /* Kustomisasi Tabel dengan Garis Biru Tua */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #1565c0; /* Garis tabel biru tua */
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background-color: #e3f2fd; /* Latar belakang header biru pastel */
            color: #1565c0;
            text-align: center;
            font-weight: 600;
        }

        /* Efek belang-belang agar baris data mudah dibaca di PDF */
        tr:nth-child(even) {
            background-color: #f4f9ff;
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        
        /* Latar Belakang Baris Total */
        .bg-kuning {
            background-color: #fffde7 !important; /* Kuning pastel lembut */
            color: #455a64;
        }
</style>

</head>
<body>
    <h3>Laporan Pendapatan</h3>
    <p class="periode">Periode: <?= esc($tanggal_awal) ?> s.d <?= esc($tanggal_akhir)?></p>
    
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">ID Transaksi</th>
                <th style="width: 20%;">Tanggal</th>
                <th style="width: 20%;">Username</th>
                <th style="width: 20%;">Total Harga</th>
                <th style="width: 20%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($laporan as $i => $row):
                $total += $row['total_harga'];
            ?>
                <tr>
                    <td class="text-center"><?= $i + 1 ?></td>
                    <td class="text-center fw-bold">#<?= esc($row['id']) ?></td>
                    <td class="text-center"><?= esc($row['created_at']) ?></td>
                    <td><?= esc($row['username']) ?></td>
                    <td class="text-end">Rp <?= number_format($row['total_harga'],0,',','.') ?></td>
                    <td class="text-center"><?= [
                            'Pending',
                            'Paid',
                            'Shipped',
                            'Completed',
                            'Cancelled'
                        ][$row['status']] ?? 'Tidak Diketahui' ?></td>
                </tr>
            <?php endforeach; ?>
            
            <tr class="bg-kuning">
                <td colspan="4" class="text-center fw-bold text-uppercase">Total Pendapatan</td>
                <td colspan="2" class="text-end fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>