<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function nomor1()
    {
        $nilai = "72,65,73,78,75,74,90,81,87,65,55,69,72,78,79,91,100,40,67,77,86";
        $data_nilai = explode(',', $nilai);
        $total = null;
        foreach ($data_nilai as $value) {
            # code...
            $total += $value;
        }


        return [
            'rata rata' => $total / count($data_nilai),
            'tertinggi' => min($data_nilai),
            'terendah' => max($data_nilai)
        ];
    }

    public function nomor2()
    {
        

        $string = "Cazh";
        $lowerCase = mb_strtolower($string);

        $hasil =  strlen($lowerCase) - similar_text($string, $lowerCase);

        return [
            'KATA' => $string,
            'Jumlah Huruf Kecil' => strlen($string) - $hasil
        ];
    }

    function searchForId($id, $arr)
    {
        foreach ($arr as $key => $val) {
            if ($val[$key] === $id) {
                return $key;
            }
        }
        return null;
    }

    public function nomor3()
    {
        $arr = [
            ['f', 'g', 'h', 'i'],
            ['j', 'k', 'p', 'q'],
            ['r', 's', 't', 'u'],
        ];

        $id = $this->searchForId('fghi', $arr);
        dd($id);
    }
}
