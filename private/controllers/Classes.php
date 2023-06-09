<?php

//classes controller

class Classes extends Controller
{
    public function index()
    {
        if (!Auth::loggedIn()) 
            $this->redirect('login');

        $classes = new Classes_model();

        $school_id = Auth::getSchool_id();
        
        if (Auth::access('admin')) 
        {
            $query = "SELECT * FROM classes WHERE school_id = :school_id order by id desc";
            $arr["school_id"] = $school_id;

            if(isset($_GET['find']))
            {
                $find = "%". $_GET['find'] . "%";
                $query = "SELECT * FROM classes WHERE school_id = :school_id && (class LIKE :find) order by id desc";
                $arr['find'] = $find;
            }
            $data = $classes->query($query,$arr);
        } else 
        {
            $class = new Classes_model();
            $mytable = "class_students";
            if (Auth::getRank() == "lecturer") {
                $mytable = "class_lecturers";
            }

            $query = "SELECT * FROM $mytable WHERE user_id = :user_id && disabled = 0";
            $arr['user_id'] = Auth::getUser_id();

            if(isset($_GET['find']))
            {
                $find = "%". $_GET['find']. "%";
                $query = "SELECT classes.class, {$mytable}.* FROM $mytable join classes on classes.class_id = {$mytable}.class_id WHERE {$mytable}.user_id = :user_id && disabled = 0 && classes.class LIKE :find";

                $arr['find'] = $find;
            }

            $arr['stud_classes'] = $class->query($query, $arr);

            $data = array();
            if ($arr['stud_classes']) {
                foreach ($arr['stud_classes'] as $key => $arow) {
                    $data[] = $class->first('class_id', $arow->class_id);
                }
            }
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];

        $this->view('classes', [
            'rows' => $data,
            'crumbs' => $crumbs,
        ]);
    }

    public function add()
    {

        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $errors = array();
        if (count($_POST) > 0 && Auth::access('lecturer')) {
            $classes = new Classes_model();
            if ($classes->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $classes->insert($_POST);
                $this->redirect('classes');
            } else {
                $errors = $classes->errors;
            }
        }

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Add', 'classes/add'];

        if (Auth::access('lecturer')) {

            $this->view('classes.add', [
                'errors' => $errors,
                'crumbs' => $crumbs,
            ]);
        } else {
            $this->view("access-denied");
        }
    }

    public function edit($id = null)
    {

        if (!Auth::loggedIn())
            $this->redirect('login');
        

        $classes = new Classes_model();
        $errors = array();
        $row = $classes->where('id', $id);

        if (count($_POST) > 0 && Auth::access('lecturer') && Auth::owned_content($row)) {
            if ($classes->validate($_POST)) {
                $classes->update($id, $_POST);
                $this->redirect('classes');
            } else {
                $errors = $classes->errors;
            }
        }

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Edit', 'classes/edit'];

        if (Auth::access('lecturer') && Auth::owned_content($row)) {
            $this->view('classes.edit', [
                'row' => $row,
                'errors' => $errors,
                'crumbs' => $crumbs,
            ]);
        } else {
            $this->view('access-denied');
        }
    }

    public function delete($id = null)
    {

        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $classes = new Classes_model();
        $row = $classes->where('id', $id);


        if (count($_POST) > 0 && Auth::access('lecturer') && Auth::owned_content($row)) {
            $classes->delete($id, $_POST);
            $this->redirect('classes');
        }


        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Delete', 'classes/delete'];

        if (Auth::access('lecturer') && Auth::owned_content($row)) {

            $this->view('classes.delete', [
                'row' => $row,
                'crumbs' => $crumbs,
            ]);
        } else {
            $this->view('access-denied');
        }
    }
}
