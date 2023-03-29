<?php 

//tests Model
class Tests_model extends Model

{ 
    protected $table = "tests";

    protected $allowedColumns = [
        'test',
        'date',
        'class_id',
        'description',
        'disabled',
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'make_test_id',
    ]; 
   
    protected $afterSelect = [
        'get_user',
        'get_class',
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        //check class name
        if(empty($DATA['test']) || !preg_match('/^[a-z A-Z0-9]+$/',$DATA['test']))
        {
            $this->errors['test'] = "Invalid test name";
        }   

        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    public function make_user_id($data)
    {
        if(isset($_SESSION['USER']->user_id))
        {
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;        
    }
    
    public function make_school_id($data)
    {
        if(isset($_SESSION['USER']->school_id))
        {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;        
    }

    public function make_test_id($data)
    {
        $data['test_id'] = randomString(60);
        return $data;        
    }

    public function get_user($data)
    {
        $user = new User();
        foreach($data as $key => $row)
        {
            $result = $user->where('user_id',$row->user_id);
            $data[$key]->user = is_array($result) ? $result[0]: false;
        }

        return $data;
    }
    public function get_class($data)
    {
        $class = new Classes_model();
        foreach($data as $key => $row)
        {
            $result = $class->where('class_id',$row->class_id);
            $data[$key]->user = is_array($result) ? $result[0]: false;
        }

        return $data;
    }
}