<?php

namespace Modules\PengajuanAnggaran\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PengajuanAnggaran\Entities\dataIKU;
use Modules\PengajuanAnggaran\Entities\DetailSbm;
use Modules\PengajuanAnggaran\Entities\Iku;
use Modules\PengajuanAnggaran\Entities\Sbm;

class PengajuanAnggaranDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("MenuModulPengajuanAnggaranTableSeeder");
        $iku = [
            ['sasaran_kinerja' => '[S 1] Meningkatnya kualitas lulusan pendidikan tinggi',],
            ['sasaran_kinerja' => '[S 1] Meningkatnya kualitas lulusan pendidikan tinggi'],
            ['sasaran_kinerja' => '[S 3] Meningkatnya kualitas kurikulum dan pembelajaran'],
            ['sasaran_kinerja' => '[S 4] Meningkatnya tata kelola satuan kerja di lingkungan Ditjen Pendidikan Vokasi'],
        ];

        foreach ($iku as $i) {
            Iku::create($i);
        }

        $data_iku = [
            [
                'iku_id' => 1,
                'indikator' => '[IKU 1.1] Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan; melanjutkan studi; atau menjadi wiraswasta.',
                'target' => '57'
            ],
            [
                'iku_id' => 1,
                'indikator' => '[IKU 1.2] Persentase mahasiswa S1 dan D4/D3/D2 yang menghabiskan paling sedikit 20 (dua puluh) sks di luar kampus; atau meraih prestasi paling rendah tingkat nasional.',
                'target' => '13'
            ],
            [
                'iku_id' => 2,
                'indikator' => '[IKU 2.1] Persentase dosen yang berkegiatan tridarma di kampus lain, di QS100 berdasarkan bidang ilmu (QS100 by subject), bekerja sebagai praktisi di dunia industri, atau membina mahasiswa yang berhasil meraih prestasi paling rendah tingkat nasional dalam 5 (lima) tahun terakhir.',
                'target' => '52'
            ],
            [
                'iku_id' => 2,
                'indikator' => '[IKU 2.2] Persentase dosen tetap berkualifikasi akademik S3; memiliki sertifikat kompetensi/profesi yang diakui oleh industri dan dunia kerja; atau berasal dari kalangan praktisi profesional, dunia industri, atau dunia kerja.',
                'target' => '85'
            ],
            [
                'iku_id' => 2,
                'indikator' => '[IKU 2.3] Jumlah keluaran penelitian dan pengabdian kepada masyarakat yang berhasil mendapat rekognisi internasional atau diterapkan oleh masyarakat per jumlah dosen.',
                'target' => '0.7'
            ],
            [
                'iku_id' => 3,
                'indikator' => '[IKU 3.1] Persentase program studi S1 dan D4/D3/D2 yang melaksanakan kerja sama dengan mitra.',
                'target' => '57'
            ],
            [
                'iku_id' => 3,
                'indikator' => '[IKU 3.2] Persentase mata kuliah S1 dan D4/D3/D2 yang menggunakan metode pembelajaran pemecahan kasus (case method) atau pembelajaran kelompok berbasis projek (team-based project) sebagai sebagian bobot evaluasi.',
                'target' => '42'
            ],
            [
                'iku_id' => 3,
                'indikator' => '[IKU 3.3] Persentase program studi S1 dan D4/D3/D2 yang memiliki akreditasi atau sertifikat internasional yang diakui pemerintah.',
                'target' => '2.5'
            ],
            [
                'iku_id' => 4,
                'indikator' => '[IKU 4.1] Rata-rata Predikat SAKIP Satker minimal BB',
                'target' => 'BB'
            ],
            [
                'iku_id' => 4,
                'indikator' => '[IKU 4.2] Rata-rata Nilai Kinerja Anggaran atas pelaksanaan RKA-K/L Satker minimal 93',
                'target' => '94'
            ],
        ];

        foreach ($data_iku as $val) {
            DataIKU::create($val);
        }


        $sbm = [
            [
                'jenis_kegiatan' => 'Honorarium Narasumber',
            ],
            [
                'jenis_kegiatan' => 'Panitia',

            ],
            [
                'jenis_kegiatan' => 'Perjadin',

            ],
            [
                'jenis_kegiatan' => 'Konsumsi Rapat / Kegiatan',

            ],

            [
                'jenis_kegiatan' => 'Paket Meeting Luar',

            ],
            [
                'jenis_kegiatan' => 'Pelaporan',
            ],
        ];

        foreach ($sbm as $sbm) {
            Sbm::create($sbm);
        }

        $detailSbm = [
            [
                'sbm_id' => 1,
                'nama' => 'Menteri/Pejabat Setingkat Menteri',
                'jumlah_satuan' => '1',
                'satuan' => 'OJ',
                'harga_satuan' => '1500000',
                'keterangan' => 'Berasal dari Luar kementerian, dosen diluar PTN, Pihak lain diluar PTN',

            ],
            [
                'sbm_id' => 1,
                'nama' => 'Eselon 1',
                'jumlah_satuan' => '1',
                'satuan' => 'OJ',
                'harga_satuan' => '1250000',
                'keterangan' => 'Berasal dari Luar kementerian, dosen diluar PTN, Pihak lain diluar PTN',

            ],
            [
                'sbm_id' => 1,
                'nama' => 'Eselon 2',
                'jumlah_satuan' => '1',
                'satuan' => 'OJ',
                'harga_satuan' => '900000',
                'keterangan' => 'Berasal dari Luar kementerian, dosen diluar PTN, Pihak lain diluar PTN',

            ],
            [
                'sbm_id' => 1,
                'nama' => 'Eselon 3 dan 4',
                'jumlah_satuan' => '1',
                'satuan' => 'OJ',
                'harga_satuan' => '750000',
                'keterangan' => 'Berasal dari Luar kementerian, dosen diluar PTN, Pihak lain diluar PTN',

            ],
            [
                'sbm_id' => 2,
                'nama' => 'Penanggungjawab',
                'satuan' => 'OK',
                'jumlah_satuan' => '1',
                'harga_satuan' => '450000',
                'keterangan' => 'Sasaran utama kegiatan berasal dari luar lingkup kementerian/lembaga/pihak lain dan dilaksanakan secara offline, jumlah panitia maksimal 10% dari jumlah peserta, jika kurang dari 40 org maka jumlah panitia maksimal 4',

            ],
            [
                'sbm_id' => 2,
                'nama' => 'Ketua / Wakil Ketua',
                'satuan' => 'OK',
                'jumlah_satuan' => '1',
                'harga_satuan' => '400000',
                'keterangan' => 'Sasaran utama kegiatan berasal dari luar lingkup kementerian/lembaga/pihak lain dan dilaksanakan secara offline, jumlah panitia maksimal 10% dari jumlah peserta, jika kurang dari 40 org maka jumlah panitia maksimal 4',

            ],
            [
                'sbm_id' => 2,
                'nama' => 'Sekretaris',
                'satuan' => 'OK',
                'jumlah_satuan' => '1',
                'harga_satuan' => '300000',
                'keterangan' => 'Sasaran utama kegiatan berasal dari luar lingkup kementerian/lembaga/pihak lain dan dilaksanakan secara offline, jumlah panitia maksimal 10% dari jumlah peserta, jika kurang dari 40 org maka jumlah panitia maksimal 4',

            ],
            [
                'sbm_id' => 2,
                'nama' => 'Anggota',
                'satuan' => 'OK',
                'jumlah_satuan' => '1',
                'harga_satuan' => '300000',
                'keterangan' => 'Sasaran utama kegiatan berasal dari luar lingkup kementerian/lembaga/pihak lain dan dilaksanakan secara offline, jumlah panitia maksimal 10% dari jumlah peserta, jika kurang dari 40 org maka jumlah panitia maksimal 4',

            ], [
                'sbm_id' => 3,
                'nama' => 'Uang Harian',
                'jumlah_satuan' => '1',
                'satuan' => 'OH',
                'harga_satuan' => '85% dari SBM',
                'keterangan' => null,

            ], [
                'sbm_id' => 3,
                'nama' => 'Transport',
                'jumlah_satuan' => '1',
                'satuan' => 'OK',
                'harga_satuan' => 'At cost',
                'keterangan' => 'Sesuai kuitansi, dan di RAB kota yang dituju harus jelas',

            ], [
                'sbm_id' => 3,
                'nama' => 'Penginapan / Akomodasi',
                'jumlah_satuan' => '1',
                'satuan' => 'OH',
                'harga_satuan' => 'Sesuai SBM',
                'keterangan' => 'Sesuai kuitansi, dan di RAB kota yang dituju harus jelas',

            ], [
                'sbm_id' => 3,
                'nama' => 'Diklat dan Fullday ',
                'jumlah_satuan' => '1',
                'satuan' => 'OH',
                'harga_satuan' => 'Sesuai SBM',
                'keterangan' => null,

            ], [
                'sbm_id' => 4,
                'nama' => 'Nasi Kotak',
                'jumlah_satuan' => '1',
                'satuan' => 'Org/kali',
                'harga_satuan' => '35000',
                'keterangan' => 'dilaksanakan  minimal 2 jam secara offline, dan melibatkan pihak lain',

            ], [
                'sbm_id' => 4,
                'nama' => 'Snack Kotak',
                'jumlah_satuan' => '1',
                'satuan' => 'Org/kali',
                'harga_satuan' => '15000',
                'keterangan' => null,

            ], [
                'sbm_id' => 5,
                'nama' => 'Fullboard',
                'jumlah_satuan' => '1',
                'satuan' => 'OP',
                'harga_satuan' => '1000000',
                'keterangan' => 'Menginap',

            ], [
                'sbm_id' => 5,
                'nama' => 'Fullday',
                'jumlah_satuan' => '1',
                'satuan' => 'OP',
                'harga_satuan' => '350000',
                'keterangan' => 'Minimal 8 jam',

            ], [
                'sbm_id' => 5,
                'nama' => 'Halfday',
                'jumlah_satuan' => '1',
                'satuan' => 'OP',
                'harga_satuan' => '250000',
                'keterangan' => 'Minimal 5 jam',

            ], [
                'sbm_id' => 5,
                'nama' => 'Paket Meeting Jinggo',
                'jumlah_satuan' => '1',
                'satuan' => 'OP',
                'harga_satuan' => '125000',
                'keterangan' => 'Tanpa Menginap',

            ], [
                'sbm_id' => 5,
                'nama' => 'Uang Harian',
                'jumlah_satuan' => '1',
                'satuan' => 'OH',
                'harga_satuan' => '100000',
                'keterangan' => 'Dilengkapi dengan surat tugas',

            ], [
                'sbm_id' => 6,
                'nama' => 'Penggandaan',
                'jumlah_satuan' => '1',
                'satuan' => 'lembar',
                'harga_satuan' => '250',
                'keterangan' => '',

            ], [
                'sbm_id' => 6,
                'nama' => 'Jilid Laporan',
                'jumlah_satuan' => null,
                'satuan' => null,
                'harga_satuan' => '250',
                'keterangan' => 'At cost',

            ]
        ];
        foreach ($detailSbm as $detailSbm) {

            DetailSbm::create($detailSbm);
        }
    }
}
