<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Daftar Piutang Pelanggan</title>
    <style>
        /* Import font Poppins dengan fallback sans-serif untuk PDF generator */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        body { 
            font-family: 'Poppins', Helvetica, Arial, sans-serif; 
            font-size: 12px; 
            color: #455a64; 
        }
        
        /* Kustomisasi Judul Laporan */
        .judul { text-align: center; margin-bottom: 25px; }
        .judul h2 { margin-bottom: 5px; color: #1e88e5; font-weight: 700; } /* Biru pastel tegas */
        .judul h3 { margin-top: 0; color: #1565c0; font-weight: 600; }     /* Biru tua pastel */
        .judul p { color: #78909c; font-size: 11px; margin-top: 5px; }
        
        /* Kustomisasi Tabel dengan Garis Biru Tua */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #1565c0; padding: 10px 8px; } /* Garis biru tua */
        th { background-color: #e3f2fd; text-align: center; color: #1565c0; font-weight: 600; } /* Latar header biru pastel */
        
        /* Efek belang-belang untuk baris tabel */
        tr:nth-child(even) { background-color: #f4f9ff; }
        
        /* Utility Classes */
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        
        /* Pewarnaan Angka (Merah/Hijau) */
        .text-danger { color: #e53935 !important; } /* Merah */
        .text-success { color: #43a047 !important; } /* Hijau */
        
        /* Baris Total Akumulasi */
        .bg-kuning { background-color: #fffde7 !important; font-weight: bold; color: #455a64; } /* Kuning pastel */
    </style>
</head>
<body>

    <div class="judul">
        <h2>LAPORAN DAFTAR PIUTANG PELANGGAN</h2>
        <h3>TEMAN MINUM ANTIK</h3>
        <p>Tanggal Cetak: <?= date('d M Y') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Pelanggan</th>
                <th>Invoice</th>
                <th>Total Tagihan (IDR)</th>
                <th>Sudah Dibayar (IDR)</th>
                <th>Sisa Piutang (IDR)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($piutang)): ?>
                <tr>
                    <td colspan="7" class="text-center">Belum ada data transaksi pelanggan.</td>
                </tr>
            <?php else: ?>
                <?php 
                    $no = 1; 
                    $total_tagihan_all = 0;
                    $total_dibayar_all = 0;
                    $total_piutang_all = 0;
                ?>
                <?php foreach($piutang as $row): ?>
                    <?php 
                        $status_text = ($row['sisa_piutang'] > 0) ? 'Belum Lunas' : 'Lunas';
                        $status_color = ($row['sisa_piutang'] > 0) ? 'text-danger' : 'text-success';
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= esc($row['pelanggan']) ?></td>
                        <td class="fw-bold">#INV-<?= esc($row['invoice']) ?></td>
                        <td class="text-end"><?= number_format($row['total_tagihan'], 0, ',', '.') ?></td>
                        <td class="text-end text-success fw-bold"><?= number_format($row['sudah_dibayar'], 0, ',', '.') ?></td>
                        <td class="text-end <?= $status_color ?> fw-bold"><?= number_format($row['sisa_piutang'], 0, ',', '.') ?></td>
                        <td class="text-center <?= $status_color ?> fw-bold"><?= $status_text ?></td>
                    </tr>
                    <?php 
                        $total_tagihan_all += $row['total_tagihan'];
                        $total_dibayar_all += $row['sudah_dibayar'];
                        if($row['sisa_piutang'] > 0) {
                            $total_piutang_all += $row['sisa_piutang'];
                        }
                    ?>
                <?php endforeach; ?>
                
                <tr class="bg-kuning">
                    <td colspan="3" class="text-center">TOTAL AKUMULASI KESELURUHAN</td>
                    <td class="text-end"><?= number_format($total_tagihan_all, 0, ',', '.') ?></td>
                    <td class="text-end text-success fw-bold"><?= number_format($total_dibayar_all, 0, ',', '.') ?></td>
                    <td class="text-end text-danger fw-bold"><?= number_format($total_piutang_all, 0, ',', '.') ?></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>