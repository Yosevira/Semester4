<?php namespace App\Controllers;
class mata_kuliah extends BaseController
{
    public function pemweb(): string
    {
        return view('pemweb');
    }

    public function mjk(): string
    {
        return view('mjk.php');
    }
    public function rpl():string
    {
        return view('rpl');
    }

    public function mbd():string
    {
        return view('mbd');
    }

}