<script>

    var totalHarga = 0;
    var quantity = 0;
    var listItem = {!! json_encode($transactions->items) !!};

    // Menampilkan data transaksi sebelumnya saat ingin melakukan edit
    $(document).ready(function() {
        updateTable();
    });

    function tambahItem() {
    updateTotalHarga(parseInt($('#id_products').find(':selected').data('harga_produk')))
    var item = listItem.find((el) => el.id_products === $('#id_products').find(':selected').data('id'));
    if (item) {
        item.quantity += 1;
    } else {
        listItem.push({
            id_products: $('#id_products').find(':selected').data('id'),
            nama_produk: $('#id_products').find(':selected').data('nama_produk'),
            harga_produk: $('#id_products').find(':selected').data('harga_produk'),
            quantity: 1
        });
    }
    updateQuantity(1);
    updateTable(); // Memanggil fungsi updateTable() setelah penambahan item
    hitungUangKembali(); 
}

function deleteItem(index) {
    var item = listItem[index];
    if (item.quantity > 1) {
        item.quantity -= 1;
    } else {
        listItem.splice(index, 1);
    }
    updateTotalHarga(-item.harga_produk);
    updateQuantity(-1);
    updateTable(); // Memanggil fungsi updateTable() setelah penghapusan item
    hitungUangKembali(); 
}

function updateTable() {
    var html = '';
    totalHarga = 0;
    quantity = 0;
    listItem.forEach((item, index) => {
        var harga_produk = formatRupiah(item.harga_produk.toString());
        var subtotal = item.quantity * item.harga_produk;
        totalHarga += subtotal;
        quantity += item.quantity;
        var quantityFormatted = formatRupiah(item.quantity.toString());
        var subtotalFormatted = formatRupiah(subtotal.toString());
        html += `
        <tr>
            <td>${index + 1}</td>
            <td>${item.nama_produk}</td>
            <td>${quantityFormatted}</td>
            <td>${harga_produk}</td>
            <td>${subtotalFormatted}</td>
            <td>
                <input type="hidden" name="id_products[]" value="${item.id_products}">    
                <input type="hidden" name="quantity[]" value="${item.quantity}"> 
                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(${index})">
                <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        `;
    });
    $('.transaksiItem').html(html); // Memperbarui isi dari <tbody class="transaksiItem">
    $('.totalHarga').html(formatRupiah(totalHarga.toString()));
    $('.quantity').html(formatRupiah(quantity.toString()));
}


    function updateTotalHarga(nom) {
        totalHarga += nom;
        $('[name=total_harga]').val(totalHarga)
        $('.totalHarga').html(formatRupiah(totalHarga.toString()))
    }

    function updateQuantity(nom) {
        quantity += nom;
        $('.quantity').html(formatRupiah(quantity.toString()))
    }

    function hitungUangKembali() {
        var uangBayar = parseFloat($('input[name="uang_bayar"]').val());
        var totalHarga = parseFloat($('[name="total_harga"]').val());
        var uangKembali = uangBayar - totalHarga;

        //         if (isNaN(uangBayar) || uangBayar <= 0) {
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