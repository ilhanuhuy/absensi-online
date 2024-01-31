<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_Absensi;
use App\Models\Model_Rapat;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Rekap extends BaseController
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
    $selectedDate = $this->request->getPost('tanggal');
    $selectedRapat = $this->request->getPost('rapat');

    $data = [
        'title' => 'Absensi',
        'selectedDate' => $selectedDate,
        'selectedRapat' => $selectedRapat,
        'isi' => 'rekap',
        'rapat' => $this->model_rapat->findAll(),
        'absen' => $this->model_absensi->findAll(),
    ];

    return view('layout/wrapper', $data);
}

public function prosesTampilanHasil()
{
    $tanggal = $this->request->getPost('tanggal');
    $id_rapat = $this->request->getPost('rapat');

    $selectedValue = $this->request->getPost('rapat');
        session()->set(['selected_rapat' => $id_rapat, 'selected_tanggal' => $tanggal]);

    $data = [
        'title' => 'Absensi',
        'isi' => 'rekap',
        'selectedValue' => $selectedValue,
        'absen' => $this->model_absensi->getAbsenByTanggal($tanggal, $id_rapat),
        'rapat' => $this->model_rapat->findAll(),
    ];

    return view('layout/wrapper', $data);
}


    public function exportExcel($tanggal = null, $id_rapat = null)
{
    if (!$tanggal || !$id_rapat) {
        // Jika tidak, redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }

    $hasil = $this->model_absensi->getAbsenByTanggal($tanggal, $id_rapat);

    // Buat objek Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Atur judul kolom
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Nomor Pekerja');
    $sheet->setCellValue('D1', 'Jabatan');
    $sheet->setCellValue('E1', 'Absen');

    // Isi data dari hasil
    $no = 1;
    $row = 2;
    foreach ($hasil as $data) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $data->nama);
        $sheet->setCellValue('C' . $row, $data->no_peg);
        $sheet->setCellValue('D' . $row, $data->jabatan);
        $sheet->setCellValue('E' . $row, $data->absensi);
        // Isi kolom-kolom lainnya sesuai kebutuhan
        $row++;
    }
    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('ffffff00');
    // // Simpan spreadsheet ke file
    // ob_clean();
    // ob_end_clean();
    // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);


    // Simpan spreadsheet ke file
    $writer = new Xlsx($spreadsheet);

    // Set header untuk download file Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="rekap_absen.xlsx"');
        header('Cache-Control: max-age=0');

    // Baca file Excel dan kirimkan ke output
    $writer->save('php://output');
    exit();
}

}
