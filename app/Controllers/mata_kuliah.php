<?php namespace App\Controllers;
class mata_kuliah extends BaseController
{
    public function pemweb(): string
    {
        return view('Matkul/pemweb');
    }

    public function mjk(): string
    {
        return view('Matkul/mjk');
    }
    public function rpl():string
    {
        return view('Matkul/rpl');
    }

    public function mbd():string
    {
        return view('Matkul/mbd');
    }

}