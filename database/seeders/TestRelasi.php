<?php

namespace Database\Seeders;

use App\Models\Obat;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class TestRelasi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Poli::create([
            'nama_poli' => 'poli_gigi',
            'keterangan' => 'coba aja',
        ]);

        Dokter::create([
            'nama' => 'yanto',
            'alamat' => 'Truko',
            'no_hp' => '085565454',
            'password' => bcrypt('123'),
            'poli_id' => 1
        ]);

        JadwalPeriksa::create([
            'dokter_id' => 1,
            'hari' => 'Selasa',
            'jam_mulai' => Carbon::parse('15:00', 7),
            'jam_selesai' => Carbon::parse('17:00', 7),
        ]);

        Pasien::create([
            'nama' => 'Wotif',
            'alamat' => 'T Area',
            'no_ktp' => '3173086305030062',
            'no_hp' => '0896969696',
            'no_rm' => 'Wotif-69'
        ]);


        DaftarPoli::create([
            'pasien_id' => 1,
            'jadwal_periksa_id' => 1,
            'keluhan' => 'Saya disakitin bang farhan kebab',
            'no_antrian' => 69,
        ]);

        Periksa::create([
            'daftar_poli_id' => 1,
            'tgl_periksa' => Carbon::parse('23-05-2023'),
            'catatan' => 'Angel, butuh damkar ki',
            'biaya_periksa' => 50000
        ]);

        Obat::create([
            'nama_obat' => 'Pseudoefedrin HCl',
            'kemasan' => 'saset',
            'harga' => 10000
        ]);

        DetailPeriksa::create([
            'periksa_id' => 1,
            'obat_id' => 1
        ]);

    }
}
