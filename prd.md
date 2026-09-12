# PRD — Sistem Informasi Manajemen Sarana dan Prasarana Fakultas

## 1. Informasi Dokumen

**Nama Produk:** Sistem Informasi Manajemen Sarana dan Prasarana Fakultas  
**Nama Singkat:** SIM Sarpras  
**Platform:** Web  
**Target Pengguna:** Admin, Dosen, Mahasiswa  
**Metode Pengembangan:** Rapid Application Development (RAD)  
**Teknologi:** Laravel, MySQL, Blade, Bootstrap 5, JavaScript, Custom CSS  
**Status Dokumen:** Final untuk tahap awal pengembangan

---

# 2. Latar Belakang

Pengelolaan sarana dan prasarana pada tingkat fakultas membutuhkan pencatatan yang terstruktur agar informasi mengenai aset, ruangan, jadwal, peminjaman, kondisi aset, kerusakan, pemeliharaan, dan perpindahan aset dapat dikelola dengan baik.

Pada lingkungan fakultas telah terdapat sistem yang berfokus pada pengelolaan laboratorium. Namun, kebutuhan pengelolaan sarana dan prasarana fakultas tidak hanya berkaitan dengan laboratorium, tetapi juga mencakup ruangan umum, aset fakultas, peminjaman aset, pelaporan kerusakan, pemeliharaan, lokasi aset, serta pelaporan.

Oleh karena itu, dikembangkan sebuah Sistem Informasi Manajemen Sarana dan Prasarana Fakultas berbasis web yang mengintegrasikan pengelolaan sarana dan prasarana umum serta sarana dan prasarana laboratorium dalam satu sistem.

Sistem ini tidak dimaksudkan untuk menggantikan seluruh fungsi sistem laboratorium yang sudah ada, tetapi mengintegrasikan kebutuhan laboratorium yang relevan ke dalam sistem pengelolaan sarana dan prasarana fakultas.

---

# 3. Rumusan Masalah

Permasalahan yang ingin diselesaikan melalui sistem ini adalah:

1. Bagaimana menyediakan informasi aset fakultas secara terpusat?
2. Bagaimana mempermudah pencarian dan pemantauan aset?
3. Bagaimana mempermudah proses peminjaman aset dan ruangan?
4. Bagaimana membantu Admin melakukan persetujuan peminjaman?
5. Bagaimana mencatat kondisi dan kerusakan aset?
6. Bagaimana menyediakan bukti foto pada laporan kerusakan?
7. Bagaimana mencatat pemeliharaan aset?
8. Bagaimana mencatat perpindahan aset antar ruangan?
9. Bagaimana menyediakan informasi jadwal penggunaan ruangan?
10. Bagaimana menyediakan laporan dan data yang dapat diekspor?
11. Bagaimana mengintegrasikan kebutuhan sarana prasarana laboratorium dengan sarana prasarana fakultas dalam satu sistem?

---

# 4. Tujuan Sistem

Tujuan utama sistem adalah:

1. Membuat sistem manajemen sarana dan prasarana fakultas berbasis web.
2. Mengelola data gedung, lantai, ruangan, kategori aset, dan aset.
3. Mempermudah pencarian dan penyaringan data sarana dan prasarana.
4. Mengelola proses peminjaman aset.
5. Mengelola proses peminjaman ruangan.
6. Mengelola jadwal ruangan.
7. Mengelola pengembalian aset.
8. Mencatat kerusakan aset.
9. Menyediakan upload foto sebagai bukti kerusakan.
10. Mengelola proses pemeliharaan aset.
11. Mencatat perpindahan aset.
12. Menyediakan notifikasi kepada pengguna.
13. Menyediakan laporan yang dapat diekspor ke PDF dan Excel.
14. Mengintegrasikan kebutuhan laboratorium ke dalam sistem fakultas.

---

# 5. Sasaran Sistem

Sistem ditujukan untuk:

- Fakultas
- Admin/pengelola sarana dan prasarana
- Dosen
- Mahasiswa
- Pengelola laboratorium yang menggunakan fitur terkait sarana dan prasarana

---

# 6. Ruang Lingkup Sistem

Sistem mencakup:

- Manajemen pengguna
- Manajemen gedung
- Manajemen lantai
- Manajemen ruangan
- Manajemen kategori aset
- Manajemen aset
- Jadwal ruangan
- Peminjaman aset
- Peminjaman ruangan
- Persetujuan peminjaman
- Pengembalian aset
- Riwayat peminjaman
- Laporan kerusakan
- Upload foto kerusakan
- Pemeliharaan aset
- Perpindahan aset
- Notifikasi
- Pencarian
- Filter
- Dashboard
- Laporan
- Export PDF
- Export Excel
- Integrasi sarana dan prasarana laboratorium

---

# 7. Fitur yang Tidak Termasuk Dalam MVP

Fitur berikut tidak menjadi bagian dari versi utama sistem:

- Presensi
- SSH Server
- Pendaftaran Aslab
- Surat Bebas
- Sistem akademik
- Sistem nilai
- Pembayaran
- Keuangan fakultas secara umum
- Fitur besar lain yang tidak berhubungan langsung dengan sarana dan prasarana

Fitur tambahan hanya boleh ditambahkan apabila diperlukan dan mendapat persetujuan pengguna.

---

# 8. Pengguna Sistem

Sistem memiliki tiga role utama:

## 8.1 Admin

Admin merupakan pengelola utama sistem.

Hak akses Admin:

- Login
- Logout
- Dashboard
- Kelola pengguna
- Kelola gedung
- Kelola lantai
- Kelola ruangan
- Kelola kategori aset
- Kelola aset
- Kelola jadwal ruangan
- Melihat peminjaman
- Menyetujui peminjaman
- Menolak peminjaman
- Mengonfirmasi pengembalian
- Melihat riwayat
- Memverifikasi laporan kerusakan
- Mengelola pemeliharaan
- Mengelola perpindahan aset
- Melihat laporan
- Export PDF
- Export Excel
- Mengelola notifikasi
- Search dan filter

---

## 8.2 Dosen

Dosen merupakan pengguna umum yang dapat menggunakan fasilitas fakultas.

Hak akses:

- Login
- Logout
- Dashboard
- Melihat profil
- Melihat aset
- Search aset
- Filter aset
- Melihat ruangan
- Search ruangan
- Filter ruangan
- Melihat jadwal ruangan
- Mengajukan peminjaman aset
- Mengajukan peminjaman ruangan
- Melihat status pengajuan
- Melihat riwayat peminjaman
- Melaporkan kerusakan
- Upload foto kerusakan
- Melihat notifikasi

---

## 8.3 Mahasiswa

Mahasiswa memiliki fungsi yang hampir sama dengan Dosen, dengan hak akses sesuai kebutuhan sistem.

Hak akses:

- Login
- Logout
- Dashboard
- Melihat profil
- Melihat aset
- Search aset
- Filter aset
- Melihat ruangan
- Search ruangan
- Filter ruangan
- Melihat jadwal ruangan
- Mengajukan peminjaman aset
- Mengajukan peminjaman ruangan
- Melihat status pengajuan
- Melihat riwayat peminjaman
- Melaporkan kerusakan
- Upload foto kerusakan
- Melihat notifikasi

---

# 9. Konsep Utama Sistem

Sistem dibangun dengan konsep bahwa seluruh sarana dan prasarana fakultas berada dalam satu basis data.

Struktur utama:

Gedung
→ Lantai
→ Ruangan
→ Aset

Sedangkan aktivitas pengguna:

User
→ Peminjaman
→ Persetujuan Admin
→ Penggunaan
→ Pengembalian
→ Riwayat

Untuk kerusakan:

User
→ Laporan Kerusakan
→ Verifikasi Admin
→ Pemeliharaan
→ Selesai

Untuk perpindahan aset:

Aset
→ Ruangan Asal
→ Ruangan Tujuan
→ Riwayat Perpindahan

---

# 10. Struktur Fakultas

Data fisik fakultas tidak boleh hard-code di dalam source code.

Sistem harus memungkinkan Admin mengelola:

- Gedung
- Lantai
- Ruangan
- Jenis ruangan
- Kapasitas ruangan
- Status ruangan
- Apakah ruangan dapat dipinjam atau tidak

Contoh struktur awal fakultas dapat terdiri dari:

- Gedung A
- Gedung B
- Gedung C
- Gedung D
- Gedung E
- Gedung F

Data tersebut hanya menjadi data awal/dummy dan harus dapat diedit melalui sistem.

---

# 11. Struktur Ruangan

Setiap ruangan memiliki:

- Gedung
- Lantai
- Kode ruangan
- Nama ruangan
- Jenis ruangan
- Kapasitas
- Status
- Dapat dipinjam atau tidak

Jenis ruangan dapat berupa:

- Laboratorium
- Ruang kelas
- Ruang dosen
- Ruang administrasi
- Ruang sidang
- Ruang lainnya

Jenis dapat dikembangkan sesuai kebutuhan.

---

# 12. Aturan Peminjaman Ruangan

Tidak semua ruangan dapat dipinjam.

Setiap ruangan memiliki atribut:

`dapat_dipinjam`

Nilainya:

- Ya
- Tidak

Untuk ruangan yang tidak dapat dipinjam, sistem tidak boleh menyediakan opsi pengajuan peminjaman.

Sistem juga harus memeriksa konflik jadwal.

Contoh:

Ruangan A digunakan:

08:00–10:00

Maka pengguna tidak boleh mengajukan:

08:30–09:30

karena terjadi konflik jadwal.

---

# 13. Jadwal Ruangan

Sistem menyediakan jadwal ruangan.

Jadwal digunakan untuk mengetahui:

- Ruangan yang sedang digunakan
- Waktu penggunaan
- Kegiatan
- Keterangan

Jadwal dapat dikelola oleh Admin.

Jadwal harus terhubung dengan ruangan.

---

# 14. Data Aset

Aset merupakan sarana yang dimiliki fakultas.

Contoh aset:

- Kursi
- Meja
- AC
- Papan tulis
- TV
- Spidol
- Penghapus spidol
- Meja dosen
- Colokan listrik
- Jam
- Kabel HDMI

Daftar aset dapat ditambah atau diubah melalui Admin.

---

# 15. Kategori Aset

Aset dapat dikelompokkan berdasarkan kategori.

Contoh:

- Furnitur
- Elektronik
- Perlengkapan

Kategori harus dikelola melalui database sehingga Admin dapat menambah kategori baru.

---

# 16. Jenis Aset

Aset dibagi menjadi dua jenis utama:

## 16.1 Aset Individual

Aset memiliki identitas unit secara individual.

Contoh:

- Laptop
- Proyektor
- TV
- AC

Masing-masing unit dapat memiliki kode aset yang berbeda.

## 16.2 Aset Berdasarkan Jumlah

Aset dicatat berdasarkan jumlah.

Contoh:

- Kursi
- Meja
- Spidol
- Penghapus
- Kabel HDMI

Field `jumlah` digunakan untuk menyimpan kuantitas.

---

# 17. Kondisi Aset

Aset memiliki informasi kondisi.

Contoh:

- Baik
- Rusak Ringan
- Rusak Berat

Status kondisi dapat digunakan dalam filter dan laporan.

---

# 18. Status Aset

Aset dapat memiliki status operasional.

Contoh:

- Tersedia
- Dipinjam
- Dalam Perbaikan
- Tidak Digunakan

Status dapat berubah berdasarkan aktivitas.

Contoh:

Aset tersedia
→ Dipinjam
→ Dikembalikan
→ Tersedia

Jika rusak:

Aset tersedia
→ Dilaporkan Rusak
→ Dalam Perbaikan
→ Selesai
→ Tersedia

---

# 19. Lokasi Aset

Setiap aset memiliki lokasi ruangan.

Relasi:

Aset
→ Ruangan
→ Lantai
→ Gedung

Contoh:

AC
→ Ruang 301
→ Lantai 3
→ Gedung D

Lokasi aset harus diambil dari database.

---

# 20. Perpindahan Aset

Apabila aset secara fisik dipindahkan, Admin harus memperbarui lokasi aset di sistem.

Contoh:

TV berada di Ruang 101.

Kemudian dipindahkan ke Ruang 203.

Admin melakukan:

Ruangan Asal:
Ruang 101

Ruangan Tujuan:
Ruang 203

Tanggal:
Tanggal perpindahan

Alasan:
Pemindahan fasilitas

Sistem kemudian:

1. Mengubah lokasi aset menjadi Ruang 203.
2. Menyimpan riwayat perpindahan.
3. Mencatat Admin yang melakukan perubahan.

---

# 21. Peminjaman Aset

Alur peminjaman:

User
→ Mencari aset
→ Memilih aset
→ Mengisi tanggal
→ Mengisi tujuan
→ Mengirim pengajuan
→ Admin melakukan review
→ Disetujui/Ditolak

Apabila disetujui:

Pengajuan
→ Aktif
→ Aset digunakan
→ User mengembalikan fisik aset
→ Admin melakukan konfirmasi
→ Selesai

---

# 22. Persetujuan Peminjaman

Seluruh peminjaman aset dan ruangan oleh Dosen/Mahasiswa harus melalui persetujuan Admin.

Status peminjaman:

- Menunggu
- Disetujui
- Ditolak
- Sedang Dipinjam
- Selesai
- Dibatalkan

Status dapat disesuaikan selama implementasi apabila diperlukan.

---

# 23. Pengembalian Aset

Pengembalian dilakukan secara fisik.

User tidak perlu mengajukan permintaan pengembalian melalui sistem.

Alurnya:

User mengembalikan aset secara fisik
→ Admin menerima aset
→ Admin memeriksa kondisi
→ Admin mencatat pengembalian
→ Status menjadi selesai

Admin dapat mencatat kondisi ketika aset dikembalikan.

Contoh:

Kondisi sebelum:
Baik

Kondisi sesudah:
Rusak Ringan

Informasi tersebut dapat digunakan sebagai bahan evaluasi.

---

# 24. Riwayat Peminjaman

Sistem menyimpan riwayat:

- Siapa yang meminjam
- Aset/ruangan yang dipinjam
- Tanggal pengajuan
- Tanggal penggunaan
- Status
- Tujuan
- Admin yang menyetujui
- Waktu pengembalian
- Kondisi saat pengembalian

Riwayat dapat digunakan sebagai bahan laporan.

---

# 25. Laporan Kerusakan

Dosen dan Mahasiswa dapat membuat laporan kerusakan.

Form laporan:

- Aset
- Deskripsi kerusakan
- Foto
- Tanggal laporan

Contoh:

Aset:
AC Gedung D

Kerusakan:
AC tidak menyala

Foto:
Upload foto kondisi AC

---

# 26. Upload Foto Kerusakan

Foto kerusakan harus dapat diunggah melalui sistem.

Sistem harus melakukan validasi:

- Jenis file
- Ukuran file
- Format file

Format yang dapat digunakan misalnya:

- JPG
- JPEG
- PNG
- WebP

Foto harus disimpan menggunakan mekanisme storage Laravel.

Foto dapat ditampilkan pada detail laporan.

---

# 27. Status Laporan Kerusakan

Status laporan:

- Dilaporkan
- Diverifikasi
- Dalam Perbaikan
- Selesai
- Ditolak

Alur:

User membuat laporan
→ Dilaporkan
→ Admin memeriksa
→ Diverifikasi
→ Pemeliharaan
→ Selesai

Apabila laporan tidak valid:

→ Ditolak

---

# 28. Pemeliharaan Aset

Pemeliharaan digunakan untuk mencatat proses perbaikan aset.

Data pemeliharaan:

- Aset
- Laporan kerusakan
- Tanggal mulai
- Tanggal selesai
- Deskripsi
- Status
- Biaya
- Keterangan

Status:

- Direncanakan
- Berlangsung
- Selesai

---

# 29. Dashboard Admin

Dashboard Admin menampilkan informasi ringkas.

Contoh:

- Total aset
- Total ruangan
- Total aset rusak
- Total peminjaman aktif
- Total pengajuan menunggu
- Total laporan kerusakan
- Total aset dalam perbaikan

Tambahan:

- Grafik kondisi aset
- Laporan kerusakan terbaru
- Pengajuan terbaru
- Aktivitas terbaru

Dashboard harus tetap sederhana dan tidak terlalu ramai.

---

# 30. Dashboard Dosen/Mahasiswa

Dashboard pengguna menampilkan:

- Peminjaman saya
- Pengajuan menunggu
- Peminjaman aktif
- Riwayat peminjaman
- Jadwal ruangan
- Notifikasi

Quick action dapat berupa:

- Pinjam Aset
- Pinjam Ruangan
- Laporkan Kerusakan

---

# 31. Search

Search merupakan fitur inti.

Search harus terhubung dengan database.

## Search Aset

Pengguna dapat mencari berdasarkan:

- Nama aset
- Kode aset
- Kategori
- Gedung
- Ruangan

## Search Ruangan

Pengguna dapat mencari:

- Nama ruangan
- Kode ruangan
- Gedung
- Lantai

## Search Peminjaman

Admin dapat mencari:

- Nama peminjam
- Aset
- Ruangan
- Status

---

# 32. Filter

Filter harus dapat digunakan bersama search.

Contoh filter aset:

- Kategori
- Gedung
- Lantai
- Ruangan
- Kondisi
- Status
- Dapat dipinjam

Contoh filter ruangan:

- Gedung
- Lantai
- Jenis ruangan
- Dapat dipinjam
- Status

Contoh filter peminjaman:

- Status
- Jenis
- Tanggal
- Peminjam

Contoh filter kerusakan:

- Aset
- Status
- Gedung
- Tanggal

Filter dan search dapat digunakan secara bersamaan.

---

# 33. Export Data

Sistem menyediakan export:

- PDF
- Excel

Export dapat digunakan untuk:

- Data aset
- Data ruangan
- Data peminjaman
- Riwayat
- Data kerusakan
- Data pemeliharaan
- Laporan lain yang relevan

Export harus mengikuti filter yang sedang digunakan.

Contoh:

Jika Admin memilih:

Gedung D
+
Kondisi Rusak

maka data hasil export hanya berisi aset sesuai filter tersebut.

---

# 34. Notifikasi

Sistem menyediakan notifikasi kepada user.

Contoh notifikasi:

"Pengajuan peminjaman Anda telah disetujui."

"Pengajuan peminjaman Anda ditolak."

"Laporan kerusakan Anda sedang diverifikasi."

"Laporan kerusakan Anda telah selesai diproses."

Notifikasi memiliki status:

- Belum Dibaca
- Sudah Dibaca

---

# 35. Integrasi Laboratorium

Laboratorium merupakan bagian dari sistem sarana dan prasarana fakultas.

Lab tidak dibuat sebagai sistem terpisah.

Fitur laboratorium yang relevan:

- Data ruang lab
- Inventaris lab
- Jadwal lab
- Peminjaman ruangan lab
- Peminjaman aset lab
- Riwayat peminjaman
- Status aset
- Laporan kerusakan
- Pemeliharaan

---

# 36. Fitur Laboratorium yang Tidak Diintegrasikan

Fitur yang tidak diperlukan dalam sistem ini:

- Presensi
- SSH Server
- Pendaftaran Aslab
- Surat Bebas
- Fitur lain yang tidak berkaitan langsung dengan manajemen sarana dan prasarana

Tujuan integrasi adalah mengambil kebutuhan sarana prasarana laboratorium, bukan menyalin keseluruhan sistem laboratorium.

---

# 37. Desain UI/UX

Tema:

**Modern Academic / Professional**

Karakteristik:

- Modern
- Bersih
- Minimal
- Profesional
- Tidak terlalu ramai
- Cocok untuk lingkungan fakultas

Warna utama:

- Hijau sebagai primary color
- Putih
- Light gray
- Dark gray

Warna status:

- Hijau untuk berhasil
- Kuning untuk peringatan
- Merah untuk error/rusak
- Biru untuk informasi

Font:

**Poppins**

---

# 38. Layout

Struktur utama:

Sidebar
→ Navigasi

Topbar
→ Profil
→ Notifikasi

Content
→ Dashboard
→ Table
→ Form
→ Detail
→ Modal

Layout utama menggunakan:

- Sidebar
- Topbar
- Main content

Sidebar dapat menyesuaikan role.

---

# 39. Prinsip UI

UI harus:

- Responsive
- Mudah dipahami
- Memiliki hierarchy yang jelas
- Tidak terlalu banyak warna
- Tidak terlalu banyak animasi
- Tidak terlalu padat
- Mudah digunakan pada laptop dan tablet
- Tetap dapat digunakan pada mobile

Bootstrap 5 dapat digunakan sebagai dasar, tetapi desain tidak boleh terlihat seperti Bootstrap default.

Gunakan custom CSS untuk memberikan identitas visual.

---

# 40. Responsive Design

Sistem harus berjalan pada:

- Desktop
- Laptop
- Tablet
- Mobile

Table pada mobile dapat menggunakan horizontal scrolling atau metode responsive lain.

Sidebar dapat berubah menjadi menu mobile.

Form harus tetap mudah digunakan pada layar kecil.

---

# 41. Arsitektur Sistem

Aplikasi menggunakan arsitektur Laravel MVC.

Model:

Mewakili data dan hubungan database.

View:

Menggunakan Blade.

Controller:

Mengatur proses request dan business logic.

Database:

Menggunakan MySQL.

Frontend:

- Blade
- Bootstrap 5
- JavaScript
- Custom CSS

---

# 42. Authentication

Sistem harus memiliki:

- Login
- Logout
- Password hashing
- Session
- Validasi login

Sistem dapat menggunakan Laravel starter kit yang kompatibel dengan versi Laravel yang digunakan.

Akses harus dibatasi berdasarkan role.

---

# 43. Authorization

Role:

- Admin
- Dosen
- Mahasiswa

Contoh:

Admin dapat membuka:

`/admin/aset`

Sedangkan Mahasiswa tidak boleh mengakses halaman tersebut hanya dengan mengetik URL.

Authorization harus menggunakan:

- Middleware
- Policy
- Gate

sesuai kebutuhan implementasi.

---

# 44. Keamanan

Sistem harus menerapkan:

- CSRF protection
- Password hashing
- Validation
- Mass assignment protection
- Authorization
- Secure file upload
- Route protection
- Input sanitization sesuai kebutuhan
- Database constraints
- Session security

Upload foto harus dibatasi jenis dan ukuran file.

---

# 45. Database

Database menggunakan MySQL.

Tabel utama:

1. users
2. gedung
3. lantai
4. ruangan
5. kategori_aset
6. aset
7. jadwal_ruangan
8. peminjaman
9. peminjaman_detail
10. pengembalian
11. laporan_kerusakan
12. pemeliharaan
13. perpindahan_aset
14. notifikasi

---

# 46. Struktur Database

## users

Field:

- id
- nama
- email
- password
- role
- no_hp
- status
- timestamps

## gedung

Field:

- id
- kode
- nama
- keterangan
- timestamps

## lantai

Field:

- id
- gedung_id
- nomor_lantai
- keterangan
- timestamps

## ruangan

Field:

- id
- lantai_id
- kode_ruangan
- nama_ruangan
- jenis
- kapasitas
- dapat_dipinjam
- status
- timestamps

## kategori_aset

Field:

- id
- nama_kategori
- keterangan
- timestamps

## aset

Field:

- id
- kategori_id
- ruangan_id
- kode_aset
- nama_aset
- tipe_aset
- jumlah
- kondisi
- dapat_dipinjam
- status
- foto
- keterangan
- timestamps

## jadwal_ruangan

Field:

- id
- ruangan_id
- tanggal
- jam_mulai
- jam_selesai
- kegiatan
- keterangan
- timestamps

## peminjaman

Field:

- id
- user_id
- jenis
- tanggal_pengajuan
- tanggal_mulai
- tanggal_selesai
- tujuan
- status
- disetujui_oleh
- catatan
- timestamps

## peminjaman_detail

Field:

- id
- peminjaman_id
- aset_id
- jumlah
- keterangan
- timestamps

Catatan:

Karena sistem juga mendukung peminjaman ruangan, struktur final database dapat disesuaikan pada tahap implementasi agar relasi peminjaman ruangan tetap normal dan konsisten.

## pengembalian

Field:

- id
- peminjaman_id
- tanggal_kembali
- diterima_oleh
- kondisi_saat_kembali
- catatan
- timestamps

## laporan_kerusakan

Field:

- id
- user_id
- aset_id
- deskripsi
- foto
- tanggal_laporan
- status
- catatan_admin
- timestamps

## pemeliharaan

Field:

- id
- aset_id
- laporan_kerusakan_id
- tanggal_mulai
- tanggal_selesai
- deskripsi
- status
- biaya
- keterangan
- timestamps

## perpindahan_aset

Field:

- id
- aset_id
- ruangan_asal_id
- ruangan_tujuan_id
- tanggal
- user_id
- alasan
- keterangan
- timestamps

## notifikasi

Field:

- id
- user_id
- judul
- pesan
- tipe
- dibaca
- timestamps

---

# 47. Relasi Database

Relasi utama:

gedung 1:N lantai

lantai 1:N ruangan

ruangan 1:N aset

kategori_aset 1:N aset

ruangan 1:N jadwal_ruangan

users 1:N peminjaman

peminjaman 1:N peminjaman_detail

aset 1:N peminjaman_detail

peminjaman 1:N pengembalian

users 1:N laporan_kerusakan

aset 1:N laporan_kerusakan

aset 1:N pemeliharaan

laporan_kerusakan 1:N pemeliharaan

aset 1:N perpindahan_aset

users 1:N perpindahan_aset

users 1:N notifikasi

Relasi tambahan dapat ditambahkan apabila diperlukan untuk menjaga integritas database.

---

# 48. Seeder dan Dummy Data

Sistem harus memiliki seeder untuk data awal.

Seeder dapat membuat:

- Admin
- Dosen
- Mahasiswa
- Gedung
- Lantai
- Ruangan
- Kategori aset
- Aset
- Jadwal
- Contoh peminjaman
- Contoh kerusakan
- Contoh notifikasi

Data awal hanya merupakan dummy data.

Semua data harus dapat diedit melalui Admin.

Jangan hard-code data fakultas di dalam Blade atau Controller.

---

# 49. Tahapan Pengembangan

Pengembangan dilakukan menggunakan RAD.

## Phase 1 — Environment dan Project

- Cek PHP
- Cek Composer
- Cek Node.js
- Cek npm
- Cek MySQL
- Cek Git
- Buat project Laravel
- Konfigurasi environment
- Konfigurasi database
- Authentication
- Role
- Base layout
- UI foundation

## Phase 2 — Database

- Migration
- Model
- Relationship
- Seeder
- Database testing

## Phase 3 — Master Data

- Gedung
- Lantai
- Ruangan
- Kategori aset
- Aset

## Phase 4 — Jadwal dan Peminjaman

- Jadwal ruangan
- Peminjaman aset
- Peminjaman ruangan
- Approval
- Status

## Phase 5 — Pengembalian

- Pengembalian
- Kondisi aset
- Riwayat

## Phase 6 — Kerusakan dan Pemeliharaan

- Laporan kerusakan
- Upload foto
- Verifikasi
- Pemeliharaan
- Status perbaikan

## Phase 7 — Perpindahan

- Perpindahan aset
- Update lokasi
- Riwayat perpindahan

## Phase 8 — Pelaporan

- Dashboard
- Notifikasi
- Search
- Filter
- Export PDF
- Export Excel

## Phase 9 — Testing

- Functional testing
- Authorization testing
- Validation testing
- Upload testing
- Export testing
- Responsive testing
- Bug fixing
- UI refinement

---

# 50. Standar Implementasi untuk Antigravity

Antigravity harus:

1. Memeriksa environment terlebih dahulu.
2. Tidak mengasumsikan software sudah terinstal.
3. Membuat project Laravel dari awal apabila project belum ada.
4. Memastikan Laravel kompatibel dengan environment.
5. Menggunakan MySQL.
6. Menggunakan Laravel MVC.
7. Menggunakan Eloquent Relationship.
8. Menggunakan migration.
9. Menggunakan seeder.
10. Menggunakan Blade.
11. Menggunakan Bootstrap 5.
12. Menggunakan JavaScript jika diperlukan.
13. Menggunakan custom CSS.
14. Membuat UI modern dan profesional.
15. Tidak menggunakan data fakultas secara hard-code.
16. Membuat CRUD yang diperlukan.
17. Membuat authentication.
18. Membuat authorization berdasarkan role.
19. Melakukan validasi input.
20. Mengamankan upload file.
21. Memastikan search benar-benar bekerja di database.
22. Memastikan filter benar-benar bekerja di database.
23. Memastikan export PDF bekerja.
24. Memastikan export Excel bekerja.
25. Memastikan room schedule dapat mendeteksi konflik.
26. Memastikan approval peminjaman bekerja.
27. Memastikan pengembalian bekerja.
28. Memastikan laporan kerusakan bekerja.
29. Memastikan upload foto bekerja.
30. Memastikan maintenance bekerja.
31. Memastikan perpindahan aset mengubah lokasi.
32. Memastikan riwayat perpindahan tersimpan.
33. Menambahkan notifikasi.
34. Melakukan testing setiap fase.
35. Memperbaiki error sebelum masuk ke fase berikutnya.

Antigravity tidak boleh menambahkan fitur besar yang tidak ada dalam PRD tanpa persetujuan.

Antigravity juga tidak boleh menghapus fitur inti yang telah ditentukan dalam PRD.

---

# 51. Kriteria Keberhasilan

Sistem dianggap berhasil apabila:

## Authentication

- Admin dapat login.
- Dosen dapat login.
- Mahasiswa dapat login.
- User dapat logout.

## Authorization

- Admin dapat mengakses fitur Admin.
- Dosen dan Mahasiswa tidak dapat mengakses fitur Admin.
- Hak akses berjalan berdasarkan role.

## Master Data

- Admin dapat menambah gedung.
- Admin dapat menambah lantai.
- Admin dapat menambah ruangan.
- Admin dapat menambah kategori.
- Admin dapat menambah aset.
- Admin dapat mengubah data.
- Admin dapat menghapus data sesuai aturan.

## Aset

- User dapat melihat aset.
- User dapat mencari aset.
- User dapat menggunakan filter.
- Admin dapat mengubah kondisi aset.
- Admin dapat mengubah lokasi aset.

## Peminjaman

- User dapat mengajukan peminjaman.
- Admin dapat melihat pengajuan.
- Admin dapat menyetujui.
- Admin dapat menolak.
- Status peminjaman berubah sesuai proses.
- Riwayat tercatat.

## Ruangan

- User dapat melihat ruangan.
- User dapat melihat jadwal.
- User dapat mengajukan peminjaman ruangan.
- Sistem dapat mendeteksi konflik jadwal.
- Admin dapat menyetujui atau menolak.

## Pengembalian

- Admin dapat mencatat pengembalian.
- Kondisi aset saat dikembalikan dapat dicatat.
- Status peminjaman berubah menjadi selesai.

## Kerusakan

- Dosen dapat membuat laporan.
- Mahasiswa dapat membuat laporan.
- User dapat upload foto.
- Admin dapat memverifikasi.
- Admin dapat mengubah status.
- Data pemeliharaan dapat dibuat.

## Perpindahan Aset

- Admin dapat memindahkan lokasi aset.
- Lokasi aset berubah.
- Riwayat perpindahan tersimpan.

## Notifikasi

- User menerima notifikasi.
- Status notifikasi dapat dibaca/tidak dibaca.

## Reporting

- Admin dapat melihat laporan.
- Admin dapat menggunakan filter.
- Admin dapat export PDF.
- Admin dapat export Excel.

## UI

- Sistem responsive.
- Tampilan modern.
- Navigasi jelas.
- Tidak menggunakan tampilan Bootstrap default secara mentah.

---

# 52. Prinsip Pengembangan

Prinsip utama pengembangan:

**Sederhana tetapi lengkap.**

Sistem harus mencakup kebutuhan inti tanpa menjadi terlalu kompleks.

Prioritas:

1. Database benar
2. Authentication benar
3. Authorization benar
4. CRUD berjalan
5. Peminjaman berjalan
6. Approval berjalan
7. Pengembalian berjalan
8. Kerusakan berjalan
9. Pemeliharaan berjalan
10. Perpindahan aset berjalan
11. Search dan filter berjalan
12. Export berjalan
13. UI rapi
14. Responsive
15. Testing

Jangan menambahkan kompleksitas apabila tidak diperlukan.

---

# 53. Prioritas Fitur

Prioritas utama:

### Prioritas Tinggi

- Authentication
- Role
- Gedung
- Lantai
- Ruangan
- Aset
- Peminjaman aset
- Peminjaman ruangan
- Approval
- Pengembalian
- Kerusakan
- Foto kerusakan
- Pemeliharaan
- Perpindahan aset
- Search
- Filter

### Prioritas Menengah

- Notifikasi
- Dashboard statistik
- Export PDF
- Export Excel
- Riwayat detail

### Prioritas Rendah

Fitur tambahan yang tidak diperlukan untuk alur utama.

---

# 54. Aturan Pengembangan UI

UI boleh dikembangkan secara fleksibel selama tetap memenuhi prinsip:

- Modern
- Professional
- Academic
- Clean
- Minimal
- Green and white
- Poppins
- Responsive

Tidak perlu menentukan setiap tombol atau detail halaman secara manual sejak awal.

Antigravity diperbolehkan menentukan detail UI selama:

- Tidak mengubah kebutuhan sistem.
- Tidak menambah fitur besar.
- Tetap mudah digunakan.
- Tetap konsisten antar halaman.

---

# 55. Aturan Pengembangan Database

Database harus bersifat dinamis.

Jangan membuat data seperti:

"Gedung A"

"Ruang 301"

"Laboratorium 1"

langsung di source code sebagai data tetap.

Semua data harus berasal dari database.

Admin harus dapat:

- Menambah
- Mengubah
- Menghapus
- Melihat

data sesuai hak akses dan relasi.

---

# 56. Aturan Pengelolaan Aset

Aset harus memiliki lokasi.

Aset harus memiliki kondisi.

Aset harus memiliki status.

Aset harus memiliki informasi apakah dapat dipinjam.

Perubahan lokasi harus tercatat.

Kerusakan harus dapat dilaporkan.

Aset dalam perbaikan tidak boleh dipinjam.

Aset yang sedang dipinjam tidak boleh dipinjam oleh pengguna lain apabila jumlah tersedia tidak mencukupi.

---

# 57. Aturan Peminjaman

User tidak boleh meminjam aset yang:

- Tidak tersedia
- Dalam perbaikan
- Tidak dapat dipinjam

Sistem harus melakukan validasi sebelum pengajuan.

Admin harus dapat menyetujui atau menolak.

Peminjaman yang telah disetujui harus tercatat sebagai aktivitas aktif.

---

# 58. Aturan Peminjaman Ruangan

Ruangan tidak dapat dipinjam jika:

- Tidak dapat dipinjam
- Status tidak aktif
- Ada jadwal yang bentrok
- Sedang digunakan untuk kegiatan lain

Sistem harus mengecek konflik berdasarkan:

- Tanggal
- Jam mulai
- Jam selesai

---

# 59. Aturan Laporan Kerusakan

User hanya dapat membuat laporan terhadap aset yang tersedia di sistem.

Laporan harus memiliki:

- Aset
- Deskripsi
- Tanggal
- Foto opsional sesuai aturan implementasi

Admin dapat:

- Melihat
- Memverifikasi
- Menolak
- Mengubah status
- Membuat pemeliharaan

---

# 60. Aturan Export

Export harus bersumber dari database.

Export tidak boleh menggunakan data dummy terpisah.

Export harus mengikuti filter aktif.

Contoh:

Filter:

Gedung D
Kondisi Rusak Berat

Maka PDF dan Excel hanya menampilkan data yang memenuhi filter tersebut.

---

# 61. Testing

Testing dilakukan setiap selesai tahap pengembangan.

Minimal pengujian:

### Authentication Testing

- Login benar
- Login salah
- Logout

### Authorization Testing

- Admin
- Dosen
- Mahasiswa
- Akses URL langsung

### CRUD Testing

- Create
- Read
- Update
- Delete

### Peminjaman Testing

- Submit
- Approve
- Reject
- Return

### Schedule Testing

- Jadwal normal
- Jadwal bentrok

### Upload Testing

- File valid
- File tidak valid
- File terlalu besar

### Export Testing

- PDF
- Excel
- Filter export

### Responsive Testing

- Desktop
- Laptop
- Tablet
- Mobile

---

# 62. Error Handling

Sistem harus memberikan feedback kepada user.

Contoh:

Berhasil:

"Data aset berhasil ditambahkan."

Error:

"Data gagal disimpan."

Validation:

"Nama aset wajib diisi."

Upload:

"Format file tidak didukung."

Peminjaman:

"Aset tidak tersedia pada periode tersebut."

Feedback harus jelas dan mudah dipahami.

---

# 63. Kode dan Struktur Project

Kode harus:

- Modular
- Readable
- Maintainable
- Tidak banyak duplikasi
- Menggunakan naming convention yang konsisten
- Menggunakan Laravel best practice

Hindari:

- Controller terlalu besar
- View terlalu kompleks
- Query berulang
- Hard-coded business logic yang tidak perlu
- Duplikasi HTML/CSS
- Data dummy di dalam source code

Gunakan:

- Model
- Controller
- Form Request
- Policy
- Middleware
- Blade component
- Service class bila memang diperlukan

Jangan membuat arsitektur terlalu kompleks tanpa alasan.

---

# 64. Dokumentasi

Setiap fase pengembangan harus menghasilkan catatan:

- Apa yang dibuat
- File penting
- Migration yang dibuat
- Model yang dibuat
- Controller yang dibuat
- Route yang dibuat
- Fitur yang selesai
- Testing yang dilakukan
- Error yang ditemukan
- Error yang diperbaiki
- Langkah berikutnya

---

# 65. Output Setiap Fase untuk Antigravity

Setelah setiap fase, Antigravity harus memberikan ringkasan:

Phase:
Nama fase

Completed:
Fitur yang telah selesai

Files:
File penting yang dibuat/diubah

Database:
Migration dan perubahan database

Routes:
Route yang ditambahkan

Testing:
Testing yang dilakukan

Issues:
Error yang ditemukan

Fix:
Perbaikan yang dilakukan

Next:
Fase berikutnya

---

# 66. Final Goal

Tujuan akhir adalah menghasilkan sebuah Sistem Informasi Manajemen Sarana dan Prasarana Fakultas berbasis web yang:

- Dapat digunakan Admin
- Dapat digunakan Dosen
- Dapat digunakan Mahasiswa
- Mengelola gedung
- Mengelola lantai
- Mengelola ruangan
- Mengelola aset
- Mengelola jadwal
- Mengelola peminjaman
- Mengelola persetujuan
- Mengelola pengembalian
- Mengelola kerusakan
- Mendukung foto kerusakan
- Mengelola pemeliharaan
- Mencatat perpindahan aset
- Menyediakan riwayat
- Menyediakan notifikasi
- Mendukung search
- Mendukung filter
- Mendukung export PDF
- Mendukung export Excel
- Mengintegrasikan sarana prasarana laboratorium
- Memiliki UI modern
- Responsive
- Aman
- Mudah dikembangkan

---

# 67. Instruksi Utama untuk Antigravity

Gunakan dokumen PRD ini sebagai sumber utama kebutuhan aplikasi.

Jangan langsung membuat aplikasi secara terburu-buru.

Urutan kerja:

1. Periksa environment.
2. Pastikan PHP tersedia.
3. Pastikan Composer tersedia.
4. Pastikan Node.js dan npm tersedia.
5. Pastikan MySQL tersedia.
6. Buat project Laravel apabila belum tersedia.
7. Konfigurasi environment.
8. Konfigurasi database.
9. Buat authentication.
10. Buat role dan authorization.
11. Buat database.
12. Buat migration.
13. Buat model.
14. Buat relationship.
15. Buat seeder.
16. Buat master data.
17. Buat fitur aset.
18. Buat fitur ruangan.
19. Buat jadwal.
20. Buat peminjaman.
21. Buat approval.
22. Buat pengembalian.
23. Buat laporan kerusakan.
24. Buat upload foto.
25. Buat pemeliharaan.
26. Buat perpindahan aset.
27. Buat notifikasi.
28. Buat search.
29. Buat filter.
30. Buat export.
31. Buat dashboard.
32. Testing.
33. Perbaiki error.
34. Perbaiki UI.
35. Pastikan responsive.
36. Final verification.

Setelah setiap fase, jalankan aplikasi dan lakukan pemeriksaan.

Jangan melanjutkan ke fase berikutnya apabila fase sebelumnya masih memiliki error utama.

---

# 68. Batasan Penting

Jangan:

- Membuat presensi
- Membuat SSH Server
- Membuat Aslab registration
- Membuat Surat Bebas
- Membuat sistem akademik
- Menambahkan modul besar yang tidak ada dalam PRD
- Hard-code data fakultas
- Membuat data hanya di frontend
- Mengabaikan authorization
- Mengabaikan validasi
- Mengabaikan responsive design
- Menggunakan Bootstrap default tanpa custom styling
- Mengorbankan integritas database demi kecepatan

---

# 69. Prinsip Terakhir

Prioritaskan:

**Correctness → Database → Security → Core Workflow → Usability → Responsive UI → Visual Polish**

Jangan mengejar tampilan yang bagus tetapi mengorbankan fungsi inti.

Sistem harus terlebih dahulu benar secara:

- Database
- Authentication
- Authorization
- Relationship
- Business process
- Validation

Setelah itu baru dilakukan penyempurnaan UI.

---

# 70. Status PRD

Dokumen ini merupakan baseline kebutuhan sistem.

Beberapa detail teknis dapat disesuaikan selama implementasi apabila ditemukan kebutuhan teknis baru, selama tidak mengubah tujuan utama sistem.

Perubahan besar pada scope harus dilakukan hanya dengan persetujuan pengguna.

Nama aplikasi sementara:

**SIM Sarpras**

Logo:

**Placeholder**

Tema:

**Modern Academic / Professional**

Metode:

**Rapid Application Development (RAD)**

Tech Stack:

**Laravel + MySQL + Blade + Bootstrap 5 + JavaScript + Custom CSS**

Role:

**Admin + Dosen + Mahasiswa**

Target:

**Sistem Informasi Manajemen Sarana dan Prasarana Fakultas Berbasis Web**

END OF PRD