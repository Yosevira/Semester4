<?php

namespace App\Controllers;

use App\Models\BookModel;

class Books extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
        $this->bukuModel = new BookModel();
    }
    public function index()
    {
        $buku = $this->bukuModel->findAll();
        $data =[
            'title' => 'Daftar Buku',
            'buku' => $this->bukuModel->getBuku()
        ];
        return view('books/index', $data);
    }
    public function detail($slug)
    {
        //$buku = $this->bukuModel->where(['$slug' => $slug])->first();
        //$buku = $this->bukuModel->getKomik($slug); pindah ke data

        $data =[
            'title' => 'Detail Buku',
            'buku' => $this->bukuModel->getBuku($slug)
        ];
        return view('books/detail', $data);
    }
}