<?php 

class School extends Model
{ 
    protected $allowedColumns = [
        'school',
        'date',
        'user_id'
    ];

    protected $beforeInsert = [
        'make_school_id',
        'make_user_id',
    ]; 
   
    protected $afterSelect = [
        'get_user',
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        //check school name
        if(empty($DATA['school']) || !preg_match('/^[a-zA-Z]+$/',$DATA['school']))
        {
            $this->errors['school'] = "Invalid school name";
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
        $data['school_id'] = randomString(60);
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
}