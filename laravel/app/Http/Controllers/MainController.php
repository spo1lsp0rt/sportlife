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

    public function  statistics() {
        return view('statistics');
    }

    public function  profile() {
        return view('user_profile',);
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
        $gender = 'муж';
        if ($request->input('gender') == 'Девушка') {
            $gender = 'жен';
        }
        DB::table('user')->insert([
            'Fullname' => $fio,
            'ID_Role' => 1,
            'id_class' => $id_group,
            'gender' => $gender
        ]);
        $id_user = DB::table('user')->where('FullName', $fio)->value('ID_User');
        DB::table('userdata')->insert([
            'ID_User' => $id_user,
            'Login' => $request->input('email'),
            'Password' => hash('sha512', $request->input('password'))
        ]);
        DB::table('reg_key')->where('fio', $fio)->delete();
        return redirect('authorization')->with(['reg_success' => 'Регистрация прошла успешно!']);
    }

    public function  exit()
    {
        setcookie('login', '');
        setcookie('password', '');
        setcookie('ID_User', '');
        return redirect('/');
    }

    public function  out_ofp()
    {
        $gender = "";
        if($_POST['gender'] == 'Все')
            $gender = "все";
        else if($_POST['gender'] == 'Юноши')
            $gender = "муж";
        else if($_POST['gender'] = 'Девушки')
            $gender = "жен";
        $id_class = DB::table('class')->where('Name', $_POST['group'])->value('ID_Class');
        return Redirect::back()->with(['ofp_id_class' => $id_class, 'ofp_gender' => $gender]);
    }

    public function  ofp_table()
    {
        $keys = array_keys($_POST);
        for($i = 1; $i < count($keys); $i++)
        {
            if($_POST[$keys[$i]] != "")
            {
                $data = explode('_', $keys[$i]);
                $id_class = DB::table('user')->where('ID_User', $data[0])->value('id_class');
                DB::insert("REPLACE INTO ofp (id_user, id_normative, result, date, actual_class_id) values (".$data[0].", ".$data[1].", ".$_POST[$keys[$i]].", CURRENT_DATE, ".$id_class.")");
            }
        }
        return Redirect::back()->with(['success_update_ofp' => 'Данные обновлены!']);
    }

    public function  out_testResults(Request $request)
    {
        $id_class = DB::table('class')->where('Name', $request->input('group'))->value('ID_Class');
        $statistic = DB::select('CALL getStatistic(' . $id_class . ')');
        $id_class = DB::table('class')->where('Name', $_POST['group'])->value('ID_Class');
        return Redirect::back()->with(['statistic' => $statistic, 'ofp_id_class' => $id_class]);
    }

    public function  getStatistic(Request $request)
    {
        $gender = "";
        if($request->input('gender') == "Юноши")
            $gender = "муж";
        else if($request->input('gender') == "Девушки")
            $gender = "жен";
        $statistic = array();
        $statistic['test1'] = DB::select('CALL getAllStatFromTest1("' . $gender . '", "' . $request->input('group') . '")');
        $statistic['normativesForTest1'] = DB::select('CALL 	getNormativesForTest1("' . $gender . '")');
        return Redirect::back()->with(['statistic' => $statistic, 'gender' => $request->input('gender')]);
    }

    public function  updateStudent() {
        $id = DB::table('user')->where('FullName', $_POST['old_fio'])->value('ID_User');
        $id_class = DB::table('class')->where('Name', $_POST['group'])->value('ID_Class');
        DB::table('user')->where('ID_User', $id)->update(array(
            'FullName' => $_POST['new_fio'],
            'ID_Class' => $id_class
        ));
        return Redirect::back()->with(['update_success' => 'Обновление студента прошло успешно!']);
    }

    public function  delete_student(Request $request) {
       $users = DB::select('select * from user where ID_Role = 1');
       $success = false;
       foreach ($users as $user)
       {
           if($request->input((string)$user->ID_User) == "on")
           {
               DB::table('user')->where('ID_User', $user->ID_User)->delete();
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
                $gender = DB::table('user')->where('ID_User', $user->ID_User)->value('gender');
                $currentData = array($allStat->all(), $allTests->all(), $allUsers->all());
                setcookie('login', $login, 0, '/');
                setcookie('ID_User', $user->ID_User, 0, '/');
                setcookie('Gender', $gender, 0, '/');
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
