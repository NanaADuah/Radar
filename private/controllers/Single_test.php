<?php

//single test controller

class Single_test extends Controller
{
    public function index($id = '')
    {
        $errors = array();
        if (!Auth::access('lecturer') ) {
            $this->redirect('access_denied');
        }

        $limit = 4;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $tests = new Tests_model();
        $row = $tests->first('test_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];

        if ($row) {
            $crumbs[] = [$row->test, ''];
        }
        
        $quest = new Questions_model();
        $questions = $quest ->where("test_id",$id);
        $page_tab = 'view';
        $total_questions = is_array($questions) ? count($questions): 0;

        $results = false;

        $data['row']      = $row;
        $data['crumbs']   = $crumbs;
        $data['results']  = $results;
        $data['pager']  = $pager;
        $data['questions']  = $questions;
        $data['total_questions']  = $total_questions;
        $data['page_tab']  = $page_tab;
        $data['errors']  = $errors;
        $this->view('single-test', $data);
    }

    public function addquestion($id = '')
    {
        $errors = array();
        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $tests = new Tests_model();
        $row = $tests->first('test_id', $id);
        
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];
        
        if ($row) {
            $crumbs[] = [$row->test, ''];
        }

        $page_tab = 'add-question';
        $limit = 4;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        
        $quest = new Questions_model();
        if(count($_POST) > 0)
        {
            if($quest->validate($_POST))
            {
                if($myimage = upload_image($_FILES))
                {
                    $_POST['image'] = $myimage;
                }

                $_POST['test_id'] = $id;
                $_POST['date'] = date("Y-m-d H:i:s");

                if(isset($_GET['type']) && $_GET['type'] == "objective")
                {
                    $_POST['question_type'] = "objective";
                }else
                if(isset($_GET['type']) && $_GET['type'] == "multiple")
                {
                    $_POST['question_type'] = "multiple";
                    $num = 0;
                    $arr = [];
                    $letters = ['A','B','C','D','E'];

                    foreach ($_POST as $key => $value) {
                        if(strstr($key,'choice'))
                        {
                            $arr[$letters[$num]] = $value;
                            $num++;
                        }
                    }
                    
                    $_POST['choices'] = json_encode($arr);
                }else
                {
                    $_POST['question_type'] = "subjective";
                }

                $quest->insert($_POST);
                $this->redirect('single_test/'.$id);
            }else
            {
                $errors = $quest->errors;
            }
        }
        $results = false;
        $data['row']      = $row;
        $data['crumbs']   = $crumbs;
        $data['results']  = $results;
        $data['pager']  = $pager;
        $data['page_tab']  = $page_tab;
        $data['errors']  = $errors;
        $this->view('single-test', $data);
    }

    public function editquestion($id = '', $quest_id = '')
    {
        $errors = array();
        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $tests = new Tests_model();
        $row = $tests->first('test_id', $id);
        
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];
        
        if ($row) {
            $crumbs[] = [$row->test, ''];
        }

        $page_tab = 'edit-question';
        $limit = 4;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        
        $quest = new Questions_model();
        $question = $quest->first('id', $quest_id);
        if(count($_POST) > 0)
        {
            if($quest->validate($_POST))
            {
                if($myimage = upload_image($_FILES))
                {
                    $_POST['image'] = $myimage;
                    unlink($question->image);
                }
                //check question type
                $type = '';
                if(isset($_GET['type']) && $_GET['type'] == "multiple")
                {
                    $_POST['question_type'] = "multiple";
                    $num = 0;
                    $arr = [];
                    $letters = ['A','B','C','D','E'];

                    foreach ($_POST as $key => $value) {
                        if(strstr($key,'choice'))
                        {
                            $arr[$letters[$num]] = $value;
                            $num++;
                        }
                    }
                    $type = '?type=multiple';
                    
                    $_POST['choices'] = json_encode($arr);
                }else
                if($question->question_type == "objective")
                {
                    $type = "?type=objective";
                }

                $quest->update($question->id, $_POST);
           
                $this->redirect('single_test/editquestion/'.$id.'/'.$quest_id.$type);
            }else
            {
                $errors = $quest->errors;
            }
        }
        $results = false;
        $data['row']      = $row;
        $data['crumbs']   = $crumbs;
        $data['results']  = $results;
        $data['pager']  = $pager;
        $data['page_tab']  = $page_tab;
        $data['errors']  = $errors;
        $data['question']  = $question;
        $this->view('single-test', $data);
    }

    public function deletequestion($id = '', $quest_id = '')
    {
        $errors = array();
        if (!Auth::loggedIn()) {
            $this->redirect('login');
        }

        $tests = new Tests_model();
        $row = $tests->first('test_id', $id);
        
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];
        
        if ($row) {
            $crumbs[] = [$row->test, ''];
        }

        $page_tab = 'delete-question';
        $limit = 4;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        
        $quest = new Questions_model();
        $question = $quest->first('id', $quest_id);
        if(count($_POST) > 0)
        {
            if(Auth::access('lecturer'))
            {
                $quest->delete($question->id);
                if(file_exists($question->image))
                {
                    unlink($question->image);
                }                
                $this->redirect('single_test/'.$id);
            }
        }
        $results = false;
        $data['row']      = $row;
        $data['crumbs']   = $crumbs;
        $data['results']  = $results;
        $data['pager']  = $pager;
        $data['page_tab']  = $page_tab;
        $data['errors']  = $errors;
        $data['question']  = $question;
        $this->view('single-test', $data);
    }

}
