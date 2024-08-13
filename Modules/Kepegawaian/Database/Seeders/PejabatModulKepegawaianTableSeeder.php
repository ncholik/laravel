<?php

namespace Modules\Kepegawaian\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PejabatModulKepegawaianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('pejabats')->insert([
            // bisnis dan informatika
            [
                'jabatan' => 'Direktur',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 1,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Wakil Direktur Bidang Akademik',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 2,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Wakil Direktur Bidang Umum dan Keuangan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 3,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Wakil Direktur Bidang Kemahasiswaan dan Alumni',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 4,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Jurusan Bisnis dan Informatika',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 5,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Jurusan Teknik Mesin',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 6,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Jurusan Teknik Sipil',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 7,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Jurusan Pariwisata',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 8,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Jurusan Pertanian',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 9,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Sekretaris Jurusan Bisnis dan Informatika',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 10,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Sekretaris Jurusan Teknik Mesin',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 11,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Sekretaris Jurusan Teknik Sipil',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 12,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Sekretaris Jurusan Pariwisata',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 13,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Sekretaris Jurusan Pertanian',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 14,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Kepala Pusat Penelitian dan Pengabdian Kepada Masyarakat',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 15,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Kepala Pusat Penjaminan Mutu',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 16,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Kepala UPT Kewirausahaan dan Inkubistek',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 17,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Kepala UPT Bahasa dan Budaya',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 18,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Kepala UPT Teknologi Informasi dan Komunikasi',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 19,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Kepala UPT Perpustakaan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 20,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Unit Job Placement Center',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 21,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Unit Kerjasama dan Urusan Internasional',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 22,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Unit Kesehatan Kampus',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 23,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Unit Hubungan Masyarakat',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 24,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Unit Pengadaan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 25,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Rekayasa Perangkat Lunak',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 26,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Rekayasa Komputer',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 27,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Bisnis Digital',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 28,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Rekayasa Manufaktur',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 29,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknik Manufaktur Kapal',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 30,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknik Sipil',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 31,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Rekayasa Konstruksi Jalan dan Jembatan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 32,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Manajemen Bisnis Pariwisata',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 33,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Destinasi Pariwisata',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 34,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Pengelolaan Perhotelan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 35,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Pengolahan Hasil Ternak',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 36,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Agribisnis',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 37,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Produksi Ternak',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 38,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Pengembangan Produk Agroindustri',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 39,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Produksi Tanaman Pangan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 40,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Program Studi Teknologi Budi Daya Perikanan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 41,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
            [
                'jabatan' => 'Ketua Laboratorium Jurusan Bisnis dan Informatika',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 42,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Laboratorium Jurusan Teknik Sipil',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 43,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
            [
                'jabatan' => 'Ketua Laboratorium Jurusan Teknik Mesin',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 44,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Laboratorium Program Studi Teknologi Pengolahan Hasil Ternak',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 45,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
            [
                'jabatan' => 'Ketua Laboratorium Jurusan Pariwisata',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 46,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Laboratorium Program Studi Agribisnis',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 47,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
            [
                'jabatan' => 'Koordinator Akademik dan Kemahasiswaan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 48,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Koordinator Perencanaan dan Sistem Informasi',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 49,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
            [
                'jabatan' => 'Koordinator Umum dan Kepegawaian',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 50,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Koordinator Keuangan',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 51,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
            [
                'jabatan' => 'Ketua Senat',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 52,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Satuan Pengawasan Internal',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 53,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
            [
                'jabatan' => 'Ketua Lembaga Sertifikasi Profesi',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 54,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],
            [
                'jabatan' => 'Ketua Penerbit Poliwangi Press',
                'mulai' => NULL,
                'selesai' => NULL,
                'SK' => NULL,
                'pegawai_id' => 55,
                'unit_id' => NULL,
                'status' => 'Aktif'
            ],  
        ]);
    }
}
