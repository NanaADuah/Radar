<?php

//home controller

class Home extends Controller
{
    function index()
    {
        if(!Auth::loggedIn())
        {
            $this->redirect('login');
        }
        
        $this->view('home');
    }

}

