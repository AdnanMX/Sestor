<div id="dateTime" style="color: white;"></div>
<script>
    // Fungsi untuk memperbarui tanggal dan waktu
    function updateDateTime() {
        var sekarang = new Date();
        var tanggal = sekarang.getDate();
        var bulan = sekarang.getMonth() + 1; // Bulan diindeks dari 0, jadi kita tambahkan 1
        var tahun = sekarang.getFullYear();
        var jam = sekarang.getHours();
        var menit = sekarang.getMinutes();
        var detik = sekarang.getSeconds();

        // Tambahkan angka nol di depan jika diperlukan
        bulan = bulan < 10 ? '0' + bulan : bulan;
        tanggal = tanggal < 10 ? '0' + tanggal : tanggal;
        jam = jam < 10 ? '0' + jam : jam;
        menit = menit < 10 ? '0' + menit : menit;
        detik = detik < 10 ? '0' + detik : detik;

        // Format tanggal dan waktu
        var dateTimeString = tanggal + ' ' + getNamaBulan(bulan) + ' ' + tahun + ' ' + jam + ':' + menit + ':' + detik;

        // Perbarui konten elemen dateTime
        document.getElementById('dateTime').innerText = dateTimeString;

        // Panggil fungsi ini lagi setelah 1 detik untuk pembaruan real-time
        setTimeout(updateDateTime, 1000);
    }

    // Fungsi untuk mendapatkan nama bulan dari nomor bulan
    function getNamaBulan(bulan) {
        var namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        return namaBulan[bulan - 1];
    }

    // Panggil fungsi untuk menampilkan tanggal dan waktu saat ini
    updateDateTime();
</script>
