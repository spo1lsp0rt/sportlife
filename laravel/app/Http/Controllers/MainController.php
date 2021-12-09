<?php

namespace App\Http\Controllers;

use App\Models\statistic;
use Illuminate\Http\Request;
use App\Models\Test;

class MainController extends Controller
{
    public function  home() {
        return view('home');
    }

    public function  user_profile() {
        return view('user_profile');
    }

    public function  statistic_table() {
        $allStat = new statistic();
        $tests = new Test();
        return view('statistic_table', ['allStat' => $allStat->all()], ['allTests' => $tests->all()]);
    }

    public function  tests() {
        return view('tests');
    }

    public function  authorization() {
        return view('authorization');
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
    public function test1_check(Request $request){
        $valid = $request->validate([
            'PushUp' => 'required|max:100',
            'RaisTorso' => 'required|max:100',
            'TiltForward' => 'required|max:100',
            'Retention' => 'required|max:100',
            'Catching' => 'required|max:100',
            'Equilibrium' => 'required|max:100',
            'Tapping' => 'required|max:100'
        ]);

        return view('home');
    }

    public function test2(){
        return view('test2');
    }
}
