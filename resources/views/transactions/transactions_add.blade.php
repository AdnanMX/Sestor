<script>

    var totalHarga = 0;
    var quantity = 0;
    var listItem = [];

    function tambahItem() {
        var hargaProduk = parseInt($('#id_products').find(':selected').data('harga_produk'));
        updateTotalHarga(hargaProduk);
        var item = listItem.find((el) => el.id_products === $('#id_products').find(':selected').data('id'));
        if (item) {
            item.quantity += 1;
            item.subtotal += hargaProduk;
        } else {
            var item = {
                id_products: $('#id_products').find(':selected').data('id'),
                nama_produk: $('#id_products').find(':selected').data('nama_produk'),
                harga_produk: hargaProduk,
                quantity: 1,
                subtotal: hargaProduk
            }
            listItem.push(item)
        }
        updateQuantity(1);
        updateTable();
        hitungUangKembali();
    }

    function updateTable() {
        var html = '';
        listItem.forEach((el, index) => {
            var hargaProduk = formatRupiah(el.harga_produk.toString());
            var quantity = formatRupiah(el.quantity.toString());
            var subtotal = formatRupiah(el.subtotal.toString());
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${el.nama_produk}</td>
                    <td>${quantity}</td>
                    <td>${hargaProduk}</td>
                    <td>${subtotal}</td>
                    <td>
                        <input type="hidden" name="id_products[]" value="${el.id_products}">    
                        <input type="hidden" name="quantity[]" value="${el.quantity}"> 
                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(${index})">
                <i class="fas fa-trash-alt"></i>
                </button>
                    </td>
                </tr>
                `
        })
        $('.transaksiItem').html(html);
        $('.totalHarga').html(formatRupiah(totalHarga.toString()));
        $('.quantity').html(formatRupiah(quantity.toString()));
    }

    function deleteItem(index) {
        var item = listItem[index];
        if (item.quantity > 1) {
            listItem[index].quantity -= 1;
            listItem[index].subtotal -= item.harga_produk;
            updateTotalHarga(-item.harga_produk);
            updateQuantity(-1);
        } else {
            listItem.splice(index, 1);
            updateTotalHarga(-item.subtotal);
            updateQuantity(-item.quantity);
        }
        updateTable();
        hitungUangKembali();
    }

    function updateTotalHarga(nom) {
        totalHarga += nom;
        $('[name=total_harga]').val(totalHarga);
        $('.totalHarga').html(formatRupiah(totalHarga.toString()));
    }

    function updateQuantity(nom) {
        quantity += nom;
        $('.quantity').html(formatRupiah(quantity.toString()));
    }

    function hitungUangKembali() {
        var uangBayar = parseFloat($('input[name="uang_bayar"]').val());
        var totalHarga = parseFloat($('[name="total_harga"]').val());
        var uangKembali = uangBayar - totalHarga;

        // if (isNaN(uangBayar) || uangBayar <= 0) {
        //     $('input[name="uang_bayar"]').addClass('is-invalid');
        //     return; // Keluar dari fungsi karena tidak perlu melanjutkan perhitungan
        // }
        // Pastikan uang kembali tidak bernilai negatif
        if (uangKembali < 0) {
            uangKembali = 0;
        }

        $('input[name="uang_kembali"]').val(uangKembali);

        // Tambahkan logika untuk mengubah warna input uang bayar
        // if (uangBayar < totalHarga) {
        //     $('input[name="uang_bayar"]').addClass('is-invalid'); // tambahkan kelas 'is-invalid'
        //     $('input[name="uang_bayar"]').removeClass('is-valid'); // hapus kelas 'is-valid'
        // } else {
        //     $('input[name="uang_bayar"]').removeClass('is-invalid'); // hapus kelas 'is-invalid'
        //     $('input[name="uang_bayar"]').addClass('is-valid'); // tambahkan kelas 'is-valid'
        // }
    }

    // Panggil fungsi hitungUangKembali() setiap kali nilai uang bayar berubah
    $('input[name="uang_bayar"]').on('input', hitungUangKembali);


    function confirmDelete(index) {
        if (confirm('Konfirmasi Hapus?')) {
            deleteItem(index);
        }
    }
    function confirmDeleteAll() {
    if (confirm('Konfirmasi Hapus Semua Item?')) {
        listItem = []; // Kosongkan array listItem
        totalHarga = 0; // Set totalHarga menjadi 0
        quantity = 0; // Set quantity menjadi 0
        updateTable(); // Perbarui tabel
        hitungUangKembali(); // Hitung ulang uang kembali
    }
    }

</script>