<?php

class Cover_Letters extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Cover_Letter');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        //Get cover_letters
        $cover_letters = $this->postModel->getCoverLetters();
        $data = [
            'h1' => 'Cover letter yakho yibhale apha.',
            'heading_ye_cover_letter' => 'Cover letter yakho ngeyantoni?',
            'cover_letter' => $cover_letters
        ];
        $this->view('cover_letters/index', $data);
    }

    public function bhala()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ngeyantoni' => trim($_POST['ngeyantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'cover_letter' => nl2br($_POST['cover_letter']),
                'ngeyantoni_err' => '',
                'cover_letter_err' => '',
            ];

            //Validate data
            if (empty($data['ngeyantoni'])) {
                $data['ngeyantoni_err'] = 'Cover letter yakho ngeyantoni?';
            }
            if (empty($data['cover_letter'])) {
                $data['cover_letter_err'] = 'Bhala i-cover letter kaloku.';
            }

            //Make sure there no errors
            if (empty($data['ngeyantoni_err']) && empty($data['cover_letter_err'])) {
                //Validated
                if ($this->postModel->addCoverLetter($data)) {
                    flash('message_ye_cover_letter', 'Cover letter yakho ingenile');
                    redirect('cover_letters');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('cover_letters/bhala', $data);
                }
        } else {
            //Add cover letter
            $data = [
                'ngeyantoni' => '',
                'cover_letter' => ''
            ];
            $this->view('cover_letters/bhala', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'ngeyantoni' => trim($_POST['ngeyantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'cover_letter' => nl2br($_POST['cover_letter']),
                'ilungiswe_nini' => date('Y-m-d'),
                'ngeyantoni_err' => '',
                'cover_letter_err' => ''
            ];

            //Validate data
            if (empty($data['ngeyantoni'])) {
                $data['ngeyantoni_err'] = 'Kufuneka uchaze cover letter yakho ngeyantoni.';
            }
            if ($data['cover_letter'] == 'Khetha') {
                $data['cover_letter_err'] = 'Bhala i-cover letter yakho kaloku.';
            }

            //Make sure there no errors
            if (empty($data['ngeyantoni_err']) && empty($data['cover_letter_err'])) {
                //Validated
                if ($this->postModel->updateCoverLetter($data)) {
                    flash('message_ye_cover_letter', 'Cover letter yakho has been updated');
                    redirect('cover_letters/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('cover_letters/edit', $data);
                }
        } else {
            $cover_letter = $this->postModel->getCoverLetterById($id);

            //Check if ufakwe nguye lombuzo lomntu
            if ($cover_letter->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("cover_letters/");
            }

            //Update cover letter
            $data = [
                'id' => $id,
                'ngeyantoni' => $cover_letter->ngeyantoni,
                'cover_letter' => $cover_letter->cover_letter,
                'ilungiswe_nini' => date("Y-m-d H:i:s")
            ];
            $this->view('cover_letters/edit', $data);
        }
    }
        
    public function cover_letter($id) {
        $cover_letter = $this->postModel->getCoverLetterById($id);
        $user = $this->userModel->getUserById($cover_letter->id_yomntu);
        $data = [
            'cover_letter' => $cover_letter,
            'umntu' => $user
        ];
        $this->view('cover_letters/cover_letter', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing cover letter from model
            $cover_letter = $this->postModel->getCoverLetterById($id);

            //Check for owner
            if ($cover_letter->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('cover_letters/');
            }
            if ($this->postModel->deleteCoverLetter($id)) {
                flash('message_ye_cover_letter', 'Cover letter yakho has been deleted');
                redirect('cover_letters/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('cover_letters/');
        }
    }

    /**
     * Insert Comments
     *
     * @param [type] $id
     * @return void
     */
    public function phendula($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'impendulo' => trim($_POST['impendulo']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'date' => date('Y-m-d H:i:s'),
                'impendulo_err' => ''
            ];

            //Validate data
            if (empty($data['impendulo'])) {
                $data['impendulo_err'] = 'Kufuneka ubhale impendulo yakho.';
            }

            //Make sure there no errors
            if (empty($data['impendulo_err'])) {
                //Validated
                if ($this->postModel->phendulaCoverLetter($data)) {
                    flash('message_yempendulo', 'Impendulo yakho ingenile');
                    redirect("cover_letters/phendula/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('cover_letters/', $data);
                }
        } else {
            $cover_letter = $this->postModel->getCoverLetterById($id);
            $comment = $this->postModel->getImpenduloById($id);

            //Update cover_letter
            if (!empty($comment)) {
                $data = [
                    'id' => $id,
                    'data' => $cover_letter,
                    'id_yomntu' => $cover_letter->userId,
                    'igama' => $cover_letter->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'cover_letter' => $cover_letter->cover_letter,
                    'date' => $cover_letter->ibhalwe_nini,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment
                ];
            }
            $data = [
                'id' => $id,
                'data' => $cover_letter,
                'id_yomntu' => $cover_letter->userId,
                'igama' => $cover_letter->igama,
                'cover_letter' => $cover_letter->cover_letter,
                'date' => $cover_letter->ibhalwe_nini,
                'comments' => $comment
            ];
            $this->view('cover_letters/phendula', $data);
        }
    }  
}