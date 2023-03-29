<?php


//users controller

class Users extends Controller
{
    function index()
    {
        if(!Auth::loggedIn())
        {
            $this->redirect('login');
        }
        
        $user = new User();
        $limit = 4;
        $school_id = Auth::getSchool_id();
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $query = "SELECT * FROM USERS WHERE school_id = :school_id  && rank not in ('student') order by id desc LIMIT $limit OFFSET $offset";
        $arr['school_id'] = $school_id;
        
        if(isset($_GET['find'])){
            $find = $_GET['find']."%";
            $query = "SELECT * FROM USERS WHERE school_id = :school_id  && rank not in ('student')  && (firstname LIKE :find || lastname LIKE :find) order by id desc LIMIT $limit OFFSET $offset";
            $arr['find'] = $find;
        }

        $data = $user->query($query,$arr);
        $crumbs[] = ['Dashboard',''];
        $crumbs[] = ['staff','users'];
        
        if(Auth::access('admin'))
        {
            $this->view('users', [
                'rows'=>$data,
                'crumbs'=>$crumbs,
                'pager'=>$pager
            ]);
        }
        else
        {
            $this->view('access-denied');
        }
    }

}

