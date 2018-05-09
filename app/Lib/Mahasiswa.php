<?php
// Buat namespace sesuai folder
namespace App\Lib;
 
class Mahasiswa {
    // Sebuah method untuk mencari grade
    public static function GradeNilai($nilai) {
        $tabel = array(
            'A' => [85, 101],
            'B' => [75, 85],
            'C' => [65, 75],
            'D' => [55, 65],
            'E' => [0, 55],
        );
 
        foreach ($tabel as $grade => $batas) {
            if ($nilai >= $batas[0] and
                $nilai < $batas[1]) {
                return $grade;
            }
        }
    }
}