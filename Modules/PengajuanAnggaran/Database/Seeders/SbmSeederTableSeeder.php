<?php

namespace Modules\PengajuanAnggaran\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PengajuanAnggaran\Entities\DetailSbm;
use Modules\PengajuanAnggaran\Entities\Sbm;

class SbmSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

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
