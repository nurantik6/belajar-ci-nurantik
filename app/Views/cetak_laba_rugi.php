<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Laba Rugi</title>
    <style>
        /* Import font Poppins dengan fallback sans-serif untuk PDF generator */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        body { 
            font-family: 'Poppins', Helvetica, Arial, sans-serif; 
            font-size: 13px; 
            color: #455a64; 
        }
        
        /* Kustomisasi Judul Laporan */
        .judul { text-align: center; margin-bottom: 20px; }
        .judul h2 { margin: 2px 0; color: #1e88e5; font-weight: 700; } /* Biru terang pastel */
        .judul h3 { margin: 2px 0; color: #1565c0; font-weight: 600; } /* Biru tua pastel */
        .judul p { margin: 2px 0; color: #78909c; }
        
        /* Kustomisasi Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #1565c0; padding: 10px; } /* Garis biru tua seperti di web */
        th { background-color: #e3f2fd; text-align: center; color: #1565c0; font-weight: 600; }
        
        /* Utility Classes */
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        
        /* Latar Belakang Baris */
        .bg-light { background-color: #f0f8ff; } /* Biru pastel sangat muda */
        .bg-kuning { background-color: #fffde7; color: #455a64; } /* Kuning pastel */
        
        /* Pewarnaan Angka Nominal */
        .text-danger { color: #e53935; font-weight: bold; } /* Merah */
        .text-success { color: #43a047; font-weight: bold; } /* Hijau */
        
        /* Kustomisasi Indentasi / Sub-item */
        .indent { padding-left: 20px; color: #78909c; }
    </style>
</head>
<body>

    <div class="judul">
        <h2>LAPORAN LABA RUGI</h2>
        <h3>TEMAN MINUM ANTIK</h3>
        <p>Periode: <?= ($tanggal_awal && $tanggal_akhir) ? date('d M Y', strtotime($tanggal_awal)) . ' s/d ' . date('d M Y', strtotime($tanggal_akhir)) : 'Semua Waktu' ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 60%;">Keterangan</th>
                <th style="width: 40%;">Nilai (IDR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Pendapatan</strong><br><span class="indent">Penjualan</span></td>
                <td class="text-end text-success align-middle"><?= number_format($penjualan, 0, ',', '.') ?></td>
            </tr>
            
            <tr>
                <td><strong>Harga Pokok Penjualan (HPP)</strong><br><span class="indent">Pembelian Barang</span></td>
                <td class="text-end text-danger align-middle">( <?= number_format($hpp, 0, ',', '.') ?> )</td>
            </tr>

            <tr class="bg-light fw-bold">
                <td>Laba Kotor</td>
                <td class="text-end <?= ($laba_kotor >= 0) ? 'text-success' : 'text-danger' ?>"><?= number_format($laba_kotor, 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td><strong>Beban</strong><br><span class="indent">Ongkir, Iklan, Operasional, dll</span></td>
                <td class="text-end text-danger align-middle">( <?= number_format($beban, 0, ',', '.') ?> )</td>
            </tr>

            <tr class="bg-kuning fw-bold" style="font-size: 14px;">
                <td style="text-transform: uppercase;">Laba Bersih</td>
                <td class="text-end <?= ($laba_bersih >= 0) ? 'text-success' : 'text-danger' ?>"><?= number_format($laba_bersih, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 30px; font-size: 11px; color: #78909c;">
        <strong>*Catatan:</strong> Dokumen ini digenerate secara otomatis oleh sistem pada <?= date('d M Y H:i:s') ?>.
    </div>

</body>
</html>