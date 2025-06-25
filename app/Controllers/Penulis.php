<?php

namespace App\Controllers;

use App\Models\PenulisModel;
use Codeigniter\Codeigniter;
use PSpell\Config;

class Penulis extends BaseController
{
    protected $penulisModel;
    public function __construct()
    {
        $this->penulisModel = new PenulisModel();
    }
    public function index()
    {   
        $pageSekarang = $this->request->getVar('page_penulis') ? $this->request->getVar('page_penulis') : 1;
        $kataKunci = $this->request->getVar('keyword');
            if ($kataKunci) {
                $penulis = $this->penulisModel->search($kataKunci);
            } else {
                $penulis = $this->penulisModel;
            }
        $data = [
            'title' => 'Daftar Penulis',
           // 'penulis' => $this->penulisModel->findAll(),
            'penulis' => $penulis->paginate(10, 'penulis'),
            'pager'  => $this->penulisModel->pager,
            'pageSekarang' => $pageSekarang
        ];
        return view('penulis/index', $data);
    }  
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Penulis',
            // Mengambil data penulis berdasarkan ID dari model
            'penulis' => $this->penulisModel->find($id) 
        ];

        // Memastikan data ditemukan sebelum menampilkan view
        if (empty($data['penulis'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Penulis ' . $id . ' tidak ditemukan.');
        }

        return view('penulis/detail', $data);
    }
    
}