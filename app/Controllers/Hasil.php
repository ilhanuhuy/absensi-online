<?php

namespace App\Controllers;

class Hasil extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Hasil',
            'isi' => 'hasil'
    );
        return view('layout/wrapper/hasil',$data);
    }
}
