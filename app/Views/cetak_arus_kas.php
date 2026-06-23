<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Arus Kas</title>
    <style>
        /* Import font Poppins dengan fallback sans-serif untuk PDF generator */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        body { 
            font-family: 'Poppins', Helvetica, Arial, sans-serif; 
            font-size: 12px; 
            color: #455a64; 
        }
        
        /* Kustomisasi Judul Laporan */
        .judul { 
            text-align: center; 
            margin-bottom: 25px; 
        }
        .judul h2 { 
            color: #1e88e5; /* Biru terang pastel */
            margin-bottom: 5px; 
            font-weight: 700; 
        }
        .judul h3 { 
            color: #1565c0; /* Biru tua pastel */
            margin-top: 0; 
            font-weight: 600; 
        }
        .judul p { 
            color: #78909c; 
            font-size: 11px; 
        }
        
        /* Kustomisasi Tabel */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
        }
        th, td { 
            border: 1px solid #bbdefb; /* Garis tabel biru pastel */
            padding: 10px 8px; 
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
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        
        /* Pewarnaan Angka (Sesuai dengan tema web) */
        .text-success { color: #43a047; font-weight: bold; } /* Hijau */
        .text-danger { color: #e53935; font-weight: bold; } /* Merah */
        
        /* Latar Belakang Total Akumulasi */
        .bg-kuning { 
            background-color: #fffde7 !important; /* Kuning pastel */
            font-weight: bold; 
            color: #455a64;
        }
    </style>
</head>
<body>

    <div class="judul">
        <h2>LAPORAN ARUS KAS (CASH FLOW)</h2>
        <h3>WARUNG ANTIK</h3>
        <p>Tanggal Cetak: <?= date('d M Y') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 50%;">Keterangan</th>
                <th style="width: 25%;">Kas Masuk (IDR)</th>
                <th style="width: 25%;">Kas Keluar (IDR)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $total_masuk = $total_penjualan;
                $total_keluar = 0;
            ?>
            <tr>
                <td>Penjualan & Pelunasan Piutang</td>
                <td class="text-end text-success"><?= number_format($total_penjualan, 0, ',', '.') ?></td>
                <td class="text-center">-</td>
            </tr>

            <?php foreach($arus_kas as $kas): ?>
                <tr>
                    <td><?= esc($kas['keterangan']) ?> (<?= esc($kas['tanggal']) ?>)</td>
                    <?php if($kas['tipe'] == 'Masuk'): ?>
                        <td class="text-end text-success"><?= number_format($kas['nominal'], 0, ',', '.') ?></td>
                        <td class="text-center">-</td>
                        <?php $total_masuk += $kas['nominal']; ?>
                    <?php else: ?>
                        <td class="text-center">-</td>
                        <td class="text-end text-danger"><?= number_format($kas['nominal'], 0, ',', '.') ?></td>
                        <?php $total_keluar += $kas['nominal']; ?>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

            <?php $saldo_akhir = $total_masuk - $total_keluar; ?>
            
            <tr class="bg-kuning">
                <td class="text-center">SALDO AKHIR KAS</td>
                <td colspan="2" class="text-center <?= ($saldo_akhir >= 0) ? 'text-success' : 'text-danger' ?>">
                    IDR <?= number_format($saldo_akhir, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>