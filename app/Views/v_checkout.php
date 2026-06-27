<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Sedikit penyesuaian CSS agar Select2 cocok dengan tema Bootstrap */
    .select2-container .select2-selection--single {
        height: 38px !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.375rem !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
        color: #212529 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
</style>

<div class="row">
    <div class="col-lg-6">
        <?= form_open('buy', 'class="row g-3"') ?>
        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input([
            'type' => 'hidden',
            'name' => 'total_harga',
            'id' => 'total_harga',
            'value' => ''
        ]) ?>

        <div class="col-12">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" value="<?php echo session()->get('username'); ?>" readonly>
        </div>
        <div class="col-12">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Contoh: Perum Tembalang Jl. Mawar No.1" required>
        </div>
        <div class="col-12">
            <label for="kelurahan" class="form-label">Kelurahan / Kecamatan</label>
            <select id="kelurahan" name="kelurahan" style="width: 100%;" required></select>
        </div>
        <div class="col-12">
            <label for="layanan" class="form-label">Layanan Pengiriman</label>
            <select id="layanan" name="layanan" style="width: 100%;" required>
                <option value="">Pilih Kelurahan terlebih dahulu</option>
            </select>
        </div>
        <div class="col-12">
            <label for="ongkir" class="form-label">Ongkos Kirim</label>
            <input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($items)) :
                            foreach ($items as $index => $item) :
                        ?>
                                <tr>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo number_to_currency($item['price'], 'IDR') ?></td>
                                    <td><?php echo $item['qty'] ?></td>
                                    <td><?php echo number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <tr>
                            <td colspan="2"></td>
                            <td><strong>Subtotal</strong></td>
                            <td><?php echo number_to_currency($total, 'IDR') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td><strong>Total Bayar</strong></td>
                            <td><strong id="total_display" style="color: #0d6efd; font-size: 1.1rem;"><?php echo number_to_currency($total, 'IDR') ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-5 rounded-pill">Buat Pesanan</button>
        </div>
        <?= form_close() ?> </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        var ongkir = 0;
        // Simpan total belanjaan (tanpa ongkir) ke dalam variabel JavaScript
        var total_belanja = <?= isset($total) ? $total : 0 ?>; 
        
        // Inisialisasi awal
        hitungTotal();

        // 1. Inisialisasi Select2 untuk Kelurahan
        $('#kelurahan').select2({
            placeholder: 'Ketik min. 3 huruf nama kelurahan/kecamatan...',
            allowClear: true,
            ajax: {
                url: '<?= base_url('get-location') ?>',
                dataType: 'json',
                delay: 500, // Dipercepat sedikit dari 1500 agar lebih responsif
                data: function(params) {
                    return {
                        search: params.term // Parameter yang dikirim ke API
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id, // Value yang akan disimpan di form
                                text: item.subdistrict_name + ", " + item.district_name + ", " + item.city_name + ", " + item.province_name // Teks yang tampil di dropdown
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 3 // Harus ketik 3 huruf baru API dipanggil
        });

        // Inisialisasi Select2 dasar untuk Layanan agar tampilannya seragam
        $('#layanan').select2();

        // 2. Event saat Kelurahan dipilih
        $("#kelurahan").on('change', function() {
            var id_kelurahan = $(this).val();
            
            // Kosongkan dan reset layanan serta ongkir jika kelurahan berubah
            $("#layanan").empty().append('<option value="">Memuat layanan pengiriman...</option>');
            ongkir = 0;
            hitungTotal();

            if(id_kelurahan) {
                // Panggil API Ongkir
                $.ajax({
                    url: "<?= site_url('get-cost') ?>",
                    type: 'GET',
                    data: {
                        'destination': id_kelurahan,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $("#layanan").empty().append('<option value="">-- Pilih Layanan --</option>');
                        
                        if(data && data.length > 0) {
                            $.each(data, function(index, item) {
                                // Format teks option: "JNE REG (REG) : estimasi 2-3 hari"
                                var textOption = item.description + " (" + item.service + ") : estimasi " + item.etd + " hari";
                                
                                $("#layanan").append($('<option>', {
                                    value: item.cost, // Value-nya adalah harga ongkir
                                    text: textOption
                                }));
                            });
                        } else {
                            $("#layanan").append('<option value="">Tidak ada layanan pengiriman tersedia</option>');
                        }
                        
                        // Perbarui tampilan Select2 layanan
                        $('#layanan').trigger('change.select2');
                    },
                    error: function() {
                        $("#layanan").empty().append('<option value="">Gagal memuat layanan. Coba lagi.</option>');
                        $('#layanan').trigger('change.select2');
                    }
                });
            }
        });

        // 3. Event saat Layanan dipilih
        $("#layanan").on('change', function() {
            var selected_ongkir = parseInt($(this).val());
            
            if (!isNaN(selected_ongkir)) {
                ongkir = selected_ongkir;
            } else {
                ongkir = 0;
            }
            hitungTotal();
        });

        // 4. Fungsi untuk menghitung dan menampilkan total
        function hitungTotal() {
            var grand_total = total_belanja + ongkir;
            
            // Tampilkan ongkir di input (hanya angka)
            $("#ongkir").val(ongkir);
            
            // Format angka ke format Rupiah untuk tampilan HTML
            var formatted_total = "IDR " + grand_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            $("#total_display").html(formatted_total);
            
            // Simpan angka murni ke input hidden untuk di-submit ke database
            $("#total_harga").val(grand_total);
        }
    });
</script>
<?= $this->endSection() ?>