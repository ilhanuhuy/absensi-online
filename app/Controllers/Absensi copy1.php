<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_Absensi;
use App\Models\Model_Rapat;
class Absensi extends BaseController
{
    protected $model_absensi;
    protected $model_rapat;
    public function __construct()
    {
        $this->model_absensi = new Model_Absensi();
        $this->model_rapat = new Model_Rapat();
    }

    public function index()
    {
        $this->model_rapat = new Model_Rapat();
        $data = array(
            'rapat' => $this->model_rapat->findAll(),
    );
        return view('absensi', $data);
    }

    public function rekap()
    {
        {
            $model_absensi = new Model_Absensi();

            $id_rapat = $this->request->getVar('rapat');
            $session_key = 'last_access_time_' . $id_rapat;
            // $session_expiration_key = 'session_expiration_' . $id_rapat;
    
            if (session()->has($session_key)) {
                $last_access_time = session()->get($session_key);
                $current_time = time();
    
                if ($current_time - $last_access_time <= 10) {
                    // Jika masih dalam 15 menit pertama, rapat tetap dapat dipilih
                    $this->saveAbsensi($model_absensi, $id_rapat);
                    return redirect()->to(base_url('absensi'));
                } else {
                    // Setelah 15 menit, rapat tidak dapat dipilih lagi selama 24 jam
                    session()->setFlashdata('pesan', "Maaf, sesi $id_rapat sudah berlalu. Silakan pilih sesi lain.");
                }
            } else {
                // Pertama kali pemilihan, rapat tetap dapat dipilih
                $this->saveAbsensi($model_absensi, $id_rapat);
                session()->set($session_key, time());
                // Set session untuk 24 jam
                $this->setRapatSessionExpiration($id_rapat);
            }
    
            return redirect()->to(base_url('absensi'));
    }
    }
        // Metode untuk menyimpan data absensi
        protected function saveAbsensi($model_absensi, $id_rapat)
        {
            $data = [
                'jabatan' => $this->request->getVar('jabatan'),
                'nama' => $this->request->getVar('nama'),
                'no_peg' => $this->request->getVar('no_peg'),
                'absensi' => $this->request->getVar('absensi'),
                'id_rapat' => $id_rapat,
            ];
        
            $model_absensi->insert($data);
        // dd($data);
        session()->setFlashdata('pesan','Absensi anda telah terkirim!!!');
        return redirect()->to(base_url('absensi'));
    }

    protected function setRapatSessionExpiration($id_rapat)
    {
        $session_expiration_key = 'session_expiration_' . $id_rapat;

        // Set session untuk 24 jam
        session()->set($session_expiration_key, time() + (1 * 60));
        dd(session()->get());
    }
}
