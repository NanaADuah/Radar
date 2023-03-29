<?php


//student controller

class Students extends Controller
{
    function index()
    {
        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $user = new User();
        $school_id = Auth::getSchool_id();
        $limit = 4;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $query = "SELECT * FROM USERS WHERE school_id = :school_id  && rank in ('student') order by id desc LIMIT $limit offset $offset";
        $arr['school_id'] = $school_id;

        if (isset($_GET['find'])) {
            $find = $_GET['find'] . "%";
            $query = "SELECT * FROM USERS WHERE school_id = :school_id  && rank in ('student') && (firstname LIKE :find || lastname LIKE :find) order by id desc LIMIT $limit offset $offset";
            $arr['find'] = $find;
        }

        $data = $user->query($query, $arr);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['students', 'students'];

        if (Auth::access('reception')) {
            $this->view('students', [
                'rows' => $data,
                'crumbs' => $crumbs,
                'pager' => $pager,
            ]);
        } else {
            $this->view('access-denied');
        }
    }
}
