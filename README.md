# 📚 SIPENSI - Sistem Informasi Penelitian Skripsi

## 🎯 Deskripsi Proyek

SIPENSI (Sistem Informasi Penelitian Skripsi) adalah platform modern yang dirancang untuk memudahkan manajemen dan monitoring proses skripsi mahasiswa.

## ✨ Fitur Utama

### 👥 Manajemen Pengguna
- 🔐 Tiga tingkat akses: Admin, Dosen, dan Mahasiswa
- 🛡️ Sistem autentikasi dan otorisasi
- 📸 Profil pengguna dengan foto profil

### 📋 Manajemen Skripsi
- 📝 Pengajuan judul skripsi
- 👨‍🏫 Pemilihan dosen pembimbing
- 🔄 Tracking status skripsi
- 📤 Unggah dokumen proposal dan skripsi

### 💬 Bimbingan Online
- 📆 Jadwal bimbingan dengan dosen
- 📝 Catatan bimbingan digital
- 📎 Unggah dokumen pendukung

### 🎓 Seminar dan Sidang
- 🗓️ Penjadwalan seminar dan sidang
- 📊 Pencatatan nilai
- 📑 Manajemen dokumen revisi

## 💻 Persyaratan Sistem

- 🐘 PHP 8.1+
- 🚀 Laravel 9/10
- 🗃️ MySQL 5.7+
- 📦 Composer
- 🟢 Node.js

## 🚀 Instalasi

### 🔧 Konfigurasi
```bash
git clone https://github.com/Madleyym/sistem-pengelola-skripsi
cd sipensi
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
```

## 🗂️ Struktur Database

### 📊 Tabel Utama
- `users`    : Autentikasi pengguna
- `jurusan`  : Data jurusan
- `dosen`    : Informasi dosen
- `mahasiswa`: Data mahasiswa
- `skripsi`  : Manajemen skripsi
- `bimbingan`: Rekam jejak konsultasi
- `seminar`  : Jadwal seminar
- `sidang`   : Hasil sidang akhir

## 🤝 Kontribusi

1. 🍴 Fork repository
2. 🌿 Buat branch fitur
3. 💾 Commit perubahan
4. 📤 Push ke branch
5. 🔀 Buat Pull Request

## 📜 Lisensi

Proyek ini dilisensikan di bawah [Tentukan Lisensi]

## 📞 Kontak

- 📧 Email: support@sipensi.ac.id
- 🌐 Website: [URL Website]

---

**Dibuat dengan ❤️ untuk mahasiswa**