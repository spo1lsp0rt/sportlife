<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function  home() {
        return view('home');
    }

    public function  tests() {
        return view('tests');
    }

    public function  testform() {
        return view('testform');
    }

    public function  about() {
        return view('about');
    }

    public function test1(){
        return view('test1');
    }
}
