<?php

//access-denied controller

class Access_denied extends Controller
{
    function index()
    {
        if(!Auth::loggedIn())
        {
            $this->redirect('login');
        }
        
        $this->view('access-denied');
    }

}

