<?php namespace App\Controllers;
class Page extends BaseController
{
    public function about()
    {
        echo "about page";
    }

        public function contact()
    {
        echo "contact page";
    }
        public function faqs()
    {
        echo "Faqs page";
    }

    public function tos()
    {
        echo "Halaman Term of Service";
    }

    public function biodata()
    {
        $data=[
            'nama'=> 'Yosevira Maulidina Rahma',
            'umur'=> 15,
            'alamat'=> 'Jombang',
            'jk' => 'Perempuan',
            'status'=> "Mahasiswa aktif Unipdu"
        ];
        return view('biodata',$data);
    } 
}