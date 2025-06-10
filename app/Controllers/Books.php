<?php

namespace App\Controllers;

use App\Models\BookModel;


class Books extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
          helper(['form']); 
        $this->bukuModel = new BookModel();
    }
    public function index()
{
    $data = [
        'title' => 'Daftar Buku',
        'buku' => $this->bukuModel->findAll() // langsung saja
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

        //jika buku tidak ada
        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku ' . $slug . ' Tidak ditemukan');
        }

        return view('books/detail', $data);

    }
    public function create()
{
    return view('books/create', [
        'title' => 'Form Tambah Buku',
        'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation()

    ]);

    }
   public function save()
{   log_message('debug', 'Mencoba validasi...');

    if (!$this->validate([
        'judul' => [
            'rules' => 'required|is_unique[books.judul]',
            'errors'=> [
                'required' => '{field} Judul buku harus diisi',
                'is_unique' => '{field} Judul buku sudah ada'
            ]
        ],
        'penulis' => [
            'rules' => 'required',
            'errors'=> [
                'required' => '{field} Penulis harus diisi',
                'is_unique' => '{field} Penulis sudah terdaftar'
            ]
        ],
        'penerbit' => [
            'rules' => 'required',
            'errors'=> [
                'required' => '{field} Penerbit harus diisi',
                'is_unique' => '{field} Penerbit sudah terdaftar'
            ]
        ],
        'sampul' => [
            'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
            'errors'=> [
                'max_size' => 'Ukuran File terlalu  besar',
                'is_image' => 'File yang anda pilih bukan gambar',
                'mime_in' => 'File yang anda pilih bukan gambar',
            ]
        ]
    ])) {
        return redirect()->to('/books/create')->withInput()->with('validation', \Config\Services::validation());
    }
    $gambarSampul = $this->request->getFile('sampul'); //ambil file gambar
    
    //cek apakah ada file yang diunggah
    if ($gambarSampul->getError() == 4) {
        $namaSampul = 'no-cover.jpg';
    } else{
        $namaSampul  = $gambarSampul->getRandomName(); //generate nama gambar
        $gambarSampul->move('img', $namaSampul); //pindah file gambar ke folder img
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);

    $this->bukuModel->save([
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $namaSampul
    ]);

    session()->setFlashdata('pesan', 'Buku berhasil ditambahkan.');
    return redirect()->to('/books');
}
 
    public function delete($id)
{
    // Cari nama gambar
    $buku = $this->bukuModel->find($id);

    // Cek jika file gambar bukan default dan hanya digunakan oleh satu entri
    if ($buku['sampul'] != 'no-cover.jpg') {
        $path = 'img/' . $buku['sampul'];

        // Hapus hanya jika tidak dipakai oleh buku lain
        $penggunaLain = $this->bukuModel
            ->where('sampul', $buku['sampul'])
            ->where('id !=', $id)
            ->countAllResults();

        if ($penggunaLain == 0 && file_exists($path)) {
            unlink($path);
        }
    }

    // Hapus data dari database
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
        if ($slugLama['penulis'] == $this->request->getVar('penulis')) {
            $rule_penulis = 'required';
        } else {
            $rule_penulis = 'required|is_unique[books.penulis]';
        }
        if ($slugLama['penerbit'] == $this->request->getVar('penerbit')) {
            $rule_penerbit = 'required';
        } else {
            $rule_penerbit= 'required|is_unique[books.penerbit]';
        }



        // Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Judul buku harus diisi.',
                    'is_unique' => '{field} buku sudah dimasukkan'
                ]
                ],
            'sampul' => [
            'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
            'errors'=> [
                //'uploaded' => 'Pilihlah gambar yang sesuai',
                'max_size' => 'Ukuran File terlalu  besar',
                'is_image' => 'File yang anda pilih bukan gambar',
                'mime_in' => 'File yang anda pilih bukan gambar',
            ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $gambarSampul = $this->request->getFile('sampul');

        //cek gambar, apakah tetap gambar lama
        if ($gambarSampul->getError() == 4){
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate nama gambar
            $namaSampul = $gambarSampul->getRandomName();
            //pindahkan gambar
            $gambarSampul -> move ('img' , $namaSampul);
            //hapus file
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/books');
    }

}