<?php

namespace App\Helpers;

class Tanggal
{
    public static function TanggalIndo($date)
    {
        $BulanIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);

        $result = $tgl.' '.$BulanIndo[(int) $bulan - 1].' '.$tahun;

        return $result;
    }
}