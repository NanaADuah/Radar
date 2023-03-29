<?php

//tests controller

class Tests extends Controller
{
    public function index()
    {
        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $tests = new Tests_model();

        $school_id = Auth::getSchool_id();
        
        if (Auth::access('admin')) 
        {
            $query = "SELECT * FROM tests WHERE school_id = :school_id order by id desc";
            $arr["school_id"] = $school_id;

            if(isset($_GET['find']))
            {
                $find = "%". $_GET['find'] . "%";
                $query = "SELECT * FROM tests WHERE school_id = :school_id && (tests LIKE :find) order by id desc";
                $arr['find'] = $find;
            }
            $data = $tests->query($query,$arr);
        } else 
        {
            $test = new Tests_model();
            $mytable = "class_students";
            if (Auth::getRank() == "lecturer") {
                $mytable = "class_lecturers";
            }

            $query = "SELECT * FROM $mytable WHERE user_id = :user_id && disabled = 0";
            $arr['user_id'] = Auth::getUser_id();

            if(isset($_GET['find']))
            {
                $find = "%". $_GET['find']. "%";
                $query = "SELECT tests.test, {$mytable}.* FROM $mytable join tests on tests.test_id = {$mytable}.tests_id WHERE {$mytable}.user_id = :user_id && disabled = 0 && tests.tests LIKE :find";
                $arr['find'] = $find;
            }

            $arr['stud_classes'] = $test->query($query, $arr);
            $data = array();
            if ($arr['stud_classes']) {
                foreach ($arr['stud_classes'] as $key => $arow) {
                    $a= $test->where('class_id', $arow->class_id);
                    if(is_array($a))
                    {
                        $data = array_merge($data, $a);
                    }
                }
            }
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Tests', 'tests'];

        $this->view('tests', [
            'crumbs' => $crumbs,
            'test_rows' => $data,
        ]);
    }

}
