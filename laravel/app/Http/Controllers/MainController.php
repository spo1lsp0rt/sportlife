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

    public function  privacy_policy() {
        return view('privacy_policy');
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

    public function test2_check(Request $request){
        $valid = $request->validate([
            'Weight' => 'required|max:100',
            'Growth' => 'required|max:100',
            'RecoveryReaction' => 'required|max:100',
            'HeartResult1' => 'required|max:100',
            'HeartResult2' => 'required|max:100',
            'HeartResult3' => 'required|max:100',
            'Pulse' => 'required|max:100',
            'ArterialPressure' => 'required|max:100',
            'StangeTest' => 'required|max:100',
            'GencheTest' => 'required|max:100',
            'OrthostaticTest1' => 'required|max:100',
            'OrthostaticTest2' => 'required|max:100',
            'ClinostaticTest1' => 'required|max:100',
            'ClinostaticTest2' => 'required|max:100',
        ]);

        return view('home');
    }
}
