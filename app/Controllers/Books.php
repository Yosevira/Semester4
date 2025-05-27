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

        //jika buku tidak ada
        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku ' . $slug . ' Tidak ditemukan');
        }

        return view('books/detail', $data);

    }
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Buku',
            'validation' => \Config\Services::validation(),
        ];

        // Ambil data validasi dari session kalau ada
        if (session()->get('validation')) {
            $data['validation'] = session()->get('validation');
        }

        return view('books/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Judul buku harus diisi',
            ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Penulis harus diisi'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Penerbit harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/books/create')->withInput()->with('validation', \Config\Services::validation());

}

// Cek apakah data dengan kombinasi judul, penulis, penerbit sudah ada
    $cekDuplikat = $this->bukuModel->where([
        'judul' => $this->request->getVar('judul'),
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit')
    ])->first();

    if ($cekDuplikat) {
        session()->setFlashdata('pesan', 'Data dengan kombinasi tersebut sudah ada.');
        return redirect()->to('/books/create')->withInput();
}
 {
        return redirect()->to('/books/create')->withInput()->with('validation', \Config\Services::validation());
    }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/books');
    }
    public function delete($id)
    {
        $this->bukuModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');

        return redirect()->to('/books');
    }
    public function edit($slug)
    {
        //session();
        $data = [
            'title' => 'Form Edit Data Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->bukuModel->getBuku($slug)
        ];
        return view('books/edit', $data);
    }
    public function update($id)
    {
        // ambil data slug buku yang lama
        $slugLama = $this->bukuModel->getBuku($this->request->getVar('slug'));

        if ($slugLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[books.judul]';
        }

        // Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul buku harus diisi.',
                    'is_unique' => '{field} buku sudah dimasukkan'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/books');
    }

}