# Forecasting Information System - CodeIginiter

### Abstrak
Kopi robusta merupakan salah satu jenis kopi yang paling laris di pasaran, selain karena rasa dan aroma yang kuat, kopi robusta juga termasuk jenis kopi paling murah jika dibandingkan dengan jenis kopi lain. Kedai Maksih merupakan usaha milik keluarga yang terletak di Kabupaten Lumajang, usaha ini sudah dimulai dari tahun 2014 dengan konsep kafetaria dan coffe shop. Kedai Maksih saat ini memiliki kerjasama dengan 5 coffee shop yang berada di Lumajang maupun luar Lumajang, kerjasama ini sudah dilakukan selama 3 tahun terakhir. Permasalahan yang muncul di Kedai Maksih adalah kurangnya perhatian pada persediaan kopi yang akan dijual, sehingga Kedai Maksih sering mengalami kelebihan stok yang mengakibatkan kerugian. Metode yang digunakan dalam penelitian ini adalah Double Exponential Smoothing, metode tersebut digunakan untuk menghitung peramalan penjualan kopi robusta. Tujuan dari penelitian ini yaitu terbangunnya sebuah Sistem Informasi Peramalan Penjualan Kopi Robusta menggunakan Metode Double Exponential Smoothing pada Kedai Maksih Kabupaten Lumajang Berbasis Web. Penelitian menghasilkan sebuah aplikasi sistem informasi peramalan penjualan kopi robusta menggunakan metode Double Exponential Smoothing yang dapat digunakan untuk meramalkan jumlah penjualan kopi robusta yang akan dijual pada periode mendatang.

### Screenshoot

4.4.1. Halaman Login
Pada halaman login admin  jika form yang disediakan tidak diisi maka akan diuji kelengkapan form dengan form validation. Jika form tidak diisi dan melakukan login maka akan tetap pada tampilan login seperti terlampir pada gambar 4.1 di bawah ini.
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/4.1.PNG)
Gambar 4.1 Halaman Login
(Sumber : Data Primer diolah, 2017)

Jika verifikasi username dan Password gagal maka tampil pop-up notifikasi bahwa gagal melakukan proses login dan dipersilahkan mengisi form login kembali  seperti pada tampilan 4.2
![alt text](https://github.com/syhbt/forecasting-codeigniter/blob/master/Screenshots/4.2.PNG)
Gambar 4.2 Pop-up Notifikasi Gagal Login
(Sumber : Data Primer diolah, 2018)

Jika verifikasi username dan Password berhasil dan berhasil login maka dibawa menuju halaman Beranda seperti pada tampilan 4.3.
![alt text](https://github.com/syhbt/forecasting-codeigniter/blob/master/Screenshots/4.3.PNG)
Gambar 4.3 Halaman Beranda
(Sumber : Data Primer diolah, 2018)

4.4.2. Halaman Transaksi
Pada halaman input data transaksi, tahapan yang harus dilakukan yaitu mengisikan nilai alfa, nilai periode yang akan diramalkan dahulu seperti pada gambar 4.4.
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/4.4.PNG)
Gambar 4.4 Halaman Transaksi
(Sumber : Data Primer diolah, 2018)

Menu selanjutnya setelah berhasil mengisikan nilai alfa dan nilai perode peramalan dengan benar maka admin berhak memasukkan data penjualan dengan menekan tombol tambah data pada menu transaksi dan akan muncul pop up seperti pada gambar 4.5
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/4.5.PNG)
Gambar 4.5 Tambah Data
(Sumber : Data Primer diolah, 2018)

Setelah list data sudah terisi dan muncul pada form transaksi, tahapan selanjutnya yaitu klik hitung pada form properti peramalan dan akan muncul hasil peramalan dan forecast error seperti pada gambar 4.6 dan gambar 4.7
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/bab3.2.PNG)
Gambar 4.6 Hasil Peramalan
(Sumber : Data Primer diolah, 2018)
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/bab3.2.PNG)
Gambar 4.7 Forecast Error
(Sumber : Data Primer diolah, 2018)

Aktifitas selanjutnya setelah muncul hasil peramalan dan forecast error maka terdapat tombol simpan peramalan pada form hasil peramalan, pada saat tombol simpan di klik akan muncul pop up form simpan hasil peramalan dan forecast error berdasarkan tanggal dan nama file seperti pada gambar 4.8
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/4.6.1.PNG)
Gambar 4.8 Pop-up Simpan Peramalan
(Sumber : Data Primer diolah, 2018)

4.4.3. Halaman Laporan Hasil Peramalan
Setelah hasil peramalan berdasarkan tanggal dan nama file tersimpan maka hasil laporan akan tampil pada menu laporan seperti pada gamabar 4.9
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/4.9.PNG)
Gambar 4.9 Laporan Hasil Peramalan
(Sumber : Data Primer diolah, 2018)

Pada menu laporan hasil peramalan terdapay aksi cetak dan hapus, jika admin ingin mencetak hasil laporan maka akan tampil hasil laporan seperti pada gambar 4.10
![alt text](https://raw.githubusercontent.com/syhbt/forecasting-codeigniter/master/Screenshots/4.10.PNG)
Gambar 4.10 Cetak Laporan
(Sumber : Data Primer diolah, 2018)
