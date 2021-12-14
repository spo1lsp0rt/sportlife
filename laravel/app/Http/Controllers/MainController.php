<?php

namespace App\Http\Controllers;

use App\Models\statistic;
use App\Models\User;
use App\Models\Userdata;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\users;

class MainController extends Controller
{
    public function  home() {
        return view('home');
    }

    public function  user_profile() {
        $allUsers = new users();
        return view('user_profile', ['allUsers' => $allUsers]);
    }

    public function  statistic_table() {
        $allStat = new statistic();
        $allTests = new Test();
        $allUsers = new users();
        $currentData = array($allStat->all(), $allTests->all(), $allUsers->all());
        return view('statistic_table', ['currentData' => $currentData]);
    }

    public function  privacy_policy() {
        return view('privacy_policy');
    }

    public function  tests() {
        return view('tests');
    }

    public function  authorization() {
        $error = "";
        return view('authorization', ['error' => $error]);
    }

    public function  exit()
    {
        setcookie('login', '');
        setcookie('password', '');
        setcookie('ID_User', '');
        return redirect('/');
    }

    public function  auth_check() {
        $Userdata = new Userdata();
        $allUserdata = $Userdata->all();
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        foreach ($allUserdata as $user) {
            if ($user->Login == $login
                && $user->Password == $password)
            {
                $allStat = new statistic();
                $allTests = new Test();
                $allUsers = new users();
                $currentData = array($allStat->all(), $allTests->all(), $allUsers->all());
                setcookie('login', $login, 0, '/');
                setcookie('password', $password, 0, '/');
                setcookie('ID_User', $user->ID_User, 0, '/');
                return redirect('/');
            }
        }
        $error = "Неверный логин или пароль";
        return view('authorization', ['error' => $error]);
    }

    public function  testform() {
        $tests = new Test();
        return view('testform', ['allTests' => $tests->all()]);
    }

    public function  about() {
        return view('about');
    }

    public function  contacts() {
        return view('contacts');
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

        return view('test1_result', $_POST);
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
