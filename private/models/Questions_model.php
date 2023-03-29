<?php 

//Questiond Model
class Questions_model extends Model

{ 
    protected $table = "test_questions";

    protected $allowedColumns = [
        'question',
        'date',
        'test_id',
        'question_type',
        'correct_answer',
        'choices',
        'image',
        'comment',
        'date',
    ];

    protected $beforeInsert = [
        'make_user_id',
    ]; 
   
    protected $afterSelect = [
        'get_user',
    ];

    public function validate($DATA)
    {
        $this->errors = array();

        //check class name
        if(empty($DATA['question']))
        {
            $this->errors['question'] = "Invalid question information";
        }
        
        //check for multiple choice answers

        $num = 0;
        $letters = ['A','B','C','D','E'];

        foreach ($DATA as $key => $value) {
            if(strstr($key,'choice'))
            {
                if(empty($value))
                {
                    $this->errors['Choice'] = "Invalid information at " . $letters[$num];
                }
                $num++;
            }
        }
        if( isset($DATA['correct_answer']))
        {
            if(empty($DATA['correct_answer'])  ) 
            {
                $this->errors['answer'] = "Please add an answer for the question";
            }   
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