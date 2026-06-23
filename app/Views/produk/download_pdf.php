<style>
    /* Import font Poppins dengan fallback sans-serif untuk PDF generator */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
        font-family: 'Poppins', Helvetica, Arial, sans-serif;
        color: #455a64;
    }

    h1 {
        color: #1e88e5;
        text-align: center;
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 24px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #bbdefb; /* Garis tabel biru pastel */
        padding: 10px;
    }

    th {
        background-color: #e3f2fd; /* Latar belakang header biru pastel */
        color: #1565c0;
        font-weight: 600;
    }

    /* Efek belang-belang agar baris data mudah dibaca */
    tr:nth-child(even) {
        background-color: #f4f9ff;
    }

    img {
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .footer {
        margin-top: 15px;
        font-size: 11px;
        color: #78909c;
        text-align: right;
        font-style: italic;
    }

    .empty-img {
        font-size: 10px;
        color: #90a4ae;
    }
</style>

<h1>DATA PRODUK</h1>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $index => $produk) : ?>
        <?php
            $path = FCPATH . 'img/' . $produk['foto'];
            $base64 = '';
            
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        ?>
            <tr>
                <td align="center"><?= $index + 1 ?></td>
                <td><?= $produk['nama'] ?></td>
                <td align="right">Rp <?= number_format($produk['harga'], 2, ",", ".") ?></td>
                <td align="center"><?= $produk['jumlah'] ?></td>
                <td align="center">
                    <?php if ($base64) : ?>
                        <img src="<?= $base64 ?>" width="50">
                    <?php else : ?>
                        <span class="empty-img">Tidak ada gambar</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="footer">Downloaded on <?= date("Y-m-d H:i:s") ?></div>