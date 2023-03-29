<?php

//profile controller

class Profile extends Controller
{
    function index($id = '')
    {
        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $user = new User();
        $id = trim($id == '') ? Auth::getUser_id() : $id;

        $row = $user->first('user_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['profile', 'profile'];

        if ($row) {
            $crumbs[] = [$row->firstname, 'profile'];
        }

        //get more info depending on tab
        $data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';
        if ($data['page_tab'] == "classes" && $row) 
        {
            $class = new Classes_model();
            $mytable = "class_students";
            if ($row->rank == "lecturer") {
                $mytable = "class_lecturers";
            }
            $query = "SELECT * FROM $mytable WHERE user_id = :user_id && disabled = 0";
            $data['stud_classes'] = $class->query($query, ['user_id' => $id]);

            $data['student_classes'] = array();
            if ($data['stud_classes']) {
                foreach ($data['stud_classes'] as $key => $arow) {
                    $data['student_classes'][] = $class->first('class_id', $arow->class_id);
                }
            }
        }else
        if ($data['page_tab'] == "tests" && $row) 
        {
            $class = new Classes_model();
            $mytable = "class_students";
            if ($row->rank == "lecturer") {
                $mytable = "class_lecturers";
            }
            $query = "SELECT * FROM $mytable WHERE user_id = :user_id && disabled = 0";
            $data['stud_classes'] = $class->query($query, ['user_id' => $id]);

            $data['student_classes'] = array();
            if ($data['stud_classes']) {
                foreach ($data['stud_classes'] as $key => $arow) {
                    $data['student_classes'][] = $class->first('class_id', $arow->class_id);
                }
            }
            //collect class id's
            $class_ids = [];
            foreach($data['stud_classes'] as $key => $class_row) 
            {
                $class_ids[] = $class_row->class_id;
            }

            $id_str = "'". implode("','",$class_ids) . "'";
            $query = "SELECT * FROM tests WHERE class_id in ($id_str)";
            $tests_model = new Tests_model();
            $tests = $tests_model->query($query);
            $data['test_rows'] = $tests;
        }

        $data['row'] = $row;
        $data['crumbs'] = $crumbs;

        
        if (Auth::access('reception') || Auth::owned_content($row)) {
            $this->view('profile', $data);
        } else {
            $this->view('access-denied');
        }
    }

    function edit($id = '')
    {
        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $user = new User();
        $id = trim($id == '') ? Auth::getUser_id() : $id;
        $errors = array();

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['profile', ''];
        $data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';

        if (count($_POST) > 0 && Auth::access('lecturer')) {
            if (count($_POST) > 0) {
                $user = new User();

                //check if passwords exist

                if (trim($_POST['password']) == "") 
                {
                    unset($_POST['password']);
                    unset($_POST['password2']);
                }

                if ($user->validate($_POST, $id)) 
                {
                    
                    if($myimage = upload_image($_FILES))
                    {
                        $_POST['image']  = $myimage;
                    }
                    //check for files
                    /*
                    if(count($_FILES) > 0 )
                    {
                        //image present
                        $allowed[] = "image/jpeg";
                        $allowed[] = "image/png";

                        if($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed))
                        {
                            $folder = "uploads/";
                            if(!file_exists($folder))
                            {
                                mkdir($folder,0777, true);
                            }
                            $destination = $folder.$_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                            $_POST['image'] = $destination;                             
                        }

                    }
                    */
                    
                    if ($_POST['rank'] == "super_admin" && $_SESSION['USER']->rank != "super_admin") {
                        $_POST['rank'] = "admin";
                    }

                    $myrow = $user->first('user_id', $id);
                    if(is_object($myrow))
                    {
                        $user->update($myrow->id,$_POST);
                    }

                    $redirect = 'profile/edit/' . $id;
                    $this->redirect($redirect);
                } else {
                    $errors = $user->errors;
                }
            }
        }

        $row = $user->first('user_id', $id);
        $data['row'] = $row;
        $data['errors'] = $errors;

        $data['crumbs'] = $crumbs;

        if (Auth::access('reception') || Auth::owned_content($row)) {
            $this->view('profile-edit', $data);
        } else {
            $this->view('access-denied');
        }
    }
}
