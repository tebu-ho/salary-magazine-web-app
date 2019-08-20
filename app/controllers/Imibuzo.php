<?php

class Imibuzo extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Umbuzo');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        //Get imibuzo
        $imibuzo = $this->postModel->getImibuzo();
        $data = [
            'h1' => 'Wubhale apha umbuzo wakho',
            'heading_yombuzo' => 'Umbuzo wakho ungantoni?',
            'imibuzo' => $imibuzo
        ];
        $this->view('imibuzo/index', $data);
    }

    public function buza()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ungantoni' => trim($_POST['ungantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'umbuzo' => trim($_POST['umbuzo']),
                'ungantoni_err' => '',
                'umbuzo_err' => '',
            ];

            //Validate data
            if (empty($data['ungantoni'])) {
                $data['ungantoni_err'] = 'Umbuzo wakho ungantoni?';
            }
            if (empty($data['umbuzo'])) {
                $data['umbuzo_err'] = 'Uthini umbuzo wakho?';
            }

            //Make sure there no errors
            if (empty($data['ungantoni_err']) && empty($data['umbuzo_err'])) {
                //Validated
                if ($this->postModel->fakaUmbuzo($data)) {
                    flash('message_yombuzo', 'Umbuzo wakho ungenile');
                    redirect('imibuzo');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imibuzo/buza', $data);
                }
        } else {
            //Add umbuzo
            $data = [
                'ungantoni' => '',
                'umbuzo' => ''
            ];
            $this->view('imibuzo/buza', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'ungantoni' => trim($_POST['ungantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'umbuzo' => $_POST['umbuzo'],
                'updated_at' => date('Y-m-d'),
                'ungantoni_err' => '',
                'umbuzo_err' => ''
            ];

            //Validate data
            if (empty($data['ungantoni'])) {
                $data['ungantoni_err'] = 'Kufuneka uchaze umbuzo wakho ungantoni.';
            }
            if ($data['umbuzo'] == 'Khetha') {
                $data['umbuzo_err'] = 'Kufuneka ubuze.';
            }

            //Make sure there no errors
            if (empty($data['ungantoni_err']) && empty($data['umbuzo_err'])) {
                //Validated
                if ($this->postModel->updateUmbuzo($data)) {
                    flash('message_yombuzo', 'Umbuzo wakho has been updated');
                    redirect('imibuzo/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imibuzo/edit', $data);
                }
        } else {
            $umbuzo = $this->postModel->getUmbuzoById($id);

            //Check if ufakwe nguye lombuzo lomntu
            if ($umbuzo->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("imibuzo/");
            }

            //Update umbuzo
            $data = [
                'id' => $id,
                'ungantoni' => $umbuzo->ungantoni,
                'umbuzo' => $umbuzo->umbuzo,
                'buzwe_nini' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('imibuzo/edit', $data);
        }
    }
        
    public function umbuzo($id) {
        $umbuzo = $this->postModel->getUmbuzoById($id);
        $user = $this->userModel->getUserById($umbuzo->id_yomntu);
        $data = [
            'umbuzo' => $umbuzo,
            'umntu' => $user
        ];
        $this->view('imibuzo/umbuzo', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $umbuzo = $this->postModel->getUmbuzoById($id);

            //Check for owner
            if ($umbuzo->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('imibuzo/');
            }
            if ($this->postModel->deleteUmbuzo($id)) {
                flash('message_yombuzo', 'Umbuzo wakho has been deleted');
                redirect('imibuzo/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('imibuzo/');
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
                if ($this->postModel->phendulaUmbuzo($data)) {
                    flash('message_yempendulo', 'Impendulo yakho ingenile');
                    redirect('imibuzo/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('imibuzo/', $data);
                }
        } else {
            $imibuzo = $this->postModel->getUmbuzoById($id);
            $comment = $this->postModel->getImpenduloById($id);
            
            if (!empty($comment)) {
                $data = [
                    'id' => $id,
                    'data' => $imibuzo,
                    'id_yomntu' => $imibuzo->id_yomntu,
                    'igama' => $imibuzo->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'umbuzo' => $imibuzo->umbuzo,
                    'date' => $imibuzo->buzwe_nini,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment
                ];
            } else {
                $data = [
                    'id' => $id,
                    'data' => $imibuzo,
                    'id_yomntu' => $imibuzo->id_yomntu,
                    'igama' => $imibuzo->igama,
                    'umbuzo' => $imibuzo->umbuzo,
                    'date' => $imibuzo->buzwe_nini,
                    'comments' => $comment
                ];
            }
            $this->view('imibuzo/phendula', $data);
        }
    }    
}