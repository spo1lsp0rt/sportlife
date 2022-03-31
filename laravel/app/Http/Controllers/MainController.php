<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\statistic;
use App\Models\User;
use App\Models\Userdata;
use App\Models\Test;
use App\Models\users;


class MainController extends Controller
{
    public function  home() {
        return view('home');
    }

    public function  normatives() {
        return view('normatives');
    }

    public function  profile() {
        return view('user_profile',);
    }

    public function  statistic_table() {
        return view('statistic_table');
    }

    public function  privacy_policy() {
        return view('privacy_policy');
    }

    public function  tests() {
        return view('tests');
    }

    public function  clear_statistic(int $id) {
        $id_user = DB::table('statistic')->where('ID_Result', $id)->value('ID_User');
        $id_test = DB::table('statistic')->where('ID_Result', $id)->value('ID_Test');
        DB::table('test_user')->where('ID_User', $id_user)->where('ID_Test', $id_test)->delete();
        DB::table('statistic')->where('ID_Result', $id)->delete();
        DB::table('result_exercises')->where('ID_Result', $id)->delete();
        DB::table('results')->where('ID_Result', $id)->delete();
        return redirect('/profile');
    }

    public function  add_users()
    {
        $file = $_FILES['uploadfile']['tmp_name']; // файл для получения данных
        $spreadsheet = IOFactory::load( $file );
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];
        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
        }
        foreach($rows as $row)
        {
            $key = key_gen();
            DB::table('reg_key')->insert(array(
                'fio' => $row[0],
                'key' => $key
            ));
        }
        return Redirect::back()->with(['add_success' => 'Студенты были успешно добавлены!']);

    }

    public function  registration() {
        return view('registration');
    }

    public function  authorization() {
        return view('authorization');
    }

    public function  check_key() {
        if(!($fio = DB::table('reg_key')->where('key', $_POST['key'])->value('fio'))) {
            return Redirect::back()->withErrors(['key_failed' => 'Неверно введен ключ!']);
        }
        return Redirect::back()->with(['fio' => $fio]);
    }

    public function  reg(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        $fio = $request->input('secondname') . " " . $request->input('firstname') . " " . $request->input('lastname');
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors(['reg_failed' => 'Ошибка! Проверьте введенные данные!'])
                ->with('fio', $fio);
        }
        $id_group = DB::table('class')->where('Name', $request->input('group'))->value('ID_Class');
        $id_student = DB::table('student')->max('ID_Student');
        DB::table('student')->insert([
            'ID_Student' => $id_student + 1,
            'Fullname' => $fio,
            'ID_Class' => $id_group
        ]);
        $id_user = DB::table('user')->max('ID_User');
        DB::table('user')->insert([
            'ID_User' => $id_user + 1,
            'FullName' => $fio,
            'ID_Role' => 1
        ]);
        DB::table('userdata')->insert([
            'ID_User' => $id_user + 1,
            'Login' => $request->input('email'),
            'Password' => hash('sha512', $request->input('password'))
        ]);
        DB::table('reg_key')->where('fio', $fio)->delete();
        return redirect('authorization');
    }

    public function  exit()
    {
        setcookie('login', '');
        setcookie('password', '');
        setcookie('ID_User', '');
        return redirect('/');
    }

    public function  updateStudent() {
        $id = DB::table('student')->where('FullName', $_POST['old_fio'])->value('ID_Student');
        DB::table('student')->where('ID_Student', $id)->update(array(
            'FullName' => $_POST['new_fio'],
            'ID_Class' => $_POST['groups']
        ));
        return Redirect::back()->with(['update_success' => 'Обновление студента прошло успешно!']);
    }

    public function  delete_student(Request $request) {
       $students = DB::select('select * from student');
       $success = false;
       foreach ($students as $student)
       {
           if($request->input((string)$student->ID_Student) == "on")
           {
               DB::table('student')->where('ID_Student', $student->ID_Student)->delete();
               DB::table('user')->where('FullName', $student->FullName)->delete();
               $success = true;
           }
       }
       if($success)
           return Redirect::back()->with(['delete_success' => 'Студент(-ы) успешно удален(-ы)!']);
        return Redirect::back()->withErrors(['delete_failed' => 'Для удаления выберите хотя бы одного студента!']);
    }

    public function  auth_check() {
        $Userdata = new Userdata();
        $allUserdata = $Userdata->all();
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        foreach ($allUserdata as $user) {
            if ($user->Login == $login
                && $user->Password == hash('sha512', $password))
            {
                $allStat = new statistic();
                $allTests = new Test();
                $allUsers = new users();
                $currentData = array($allStat->all(), $allTests->all(), $allUsers->all());
                setcookie('login', $login, 0, '/');
                setcookie('ID_User', $user->ID_User, 0, '/');
                setcookie('Gender', $user->gender, 0, '/');
                return redirect('/profile');
            }
        }
        return Redirect::back()->withErrors(['failed' => 'Неверный логин или пароль!']);
    }

    public function  about() {
        return view('about');
    }

    public function  contacts() {
        return view('contacts');
    }
}
