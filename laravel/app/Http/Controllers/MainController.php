<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class MainController extends Controller
{
    public function  home() {
        return view('home');
    }

    public function  tests() {

        return view('tests');
    }

    public function  testform() {
        $tests = new Test();
        return view('testform', ['allTests' => $tests->all()]);
    }

    public function  about() {
        return view('about');
    }

    public function test1(){
        return view('test1');
    }
}
