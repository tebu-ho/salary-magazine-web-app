<?php
class Izaziso extends Controller
{
    public $igama = '';
    public function __construct()
    {
        $this->postModel = $this->model('Isaziso');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        //Get izaziso
        $izaziso = $this->postModel->getIzaziso();
        $data = [
            'heading_yesaziso' => 'Isaziso sakho singantoni?',
            'izaziso' => $izaziso
        ];
        $this->view('izaziso/index', $data);
    }

    public function sasaza()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'h1' => 'Sibhale apha isaziso sakho',
                'singantoni' => trim($_POST['singantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'isaziso' => trim($_POST['isaziso']),
                'singantoni_err' => '',
                'isaziso_err' => '',
            ];

            //Validate data
            if (empty($data['singantoni'])) {
                $data['singantoni_err'] = 'Isaziso sakho singantoni?';
            }
            if (empty($data['isaziso'])) {
                $data['isaziso_err'] = 'Sithini isaziso sakho?';
            }

            //Make sure there no errors
            if (empty($data['singantoni_err']) && empty($data['isaziso_err'])) {
                //Validated
                if ($this->postModel->fakaIsaziso($data)) {
                    flash('message_yesaziso', 'Isaziso sakho singenile');
                    redirect('izaziso');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('izaziso/sasaza', $data);
                }
        } else {
            //Add isaziso
            $data = [
                'singantoni' => '',
                'isaziso' => ''
            ];
            $this->view('izaziso/sasaza', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'singantoni' => trim($_POST['singantoni']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'isaziso' => $_POST['isaziso'],
                'updated_at' => date('Y-m-d'),
                'singantoni_err' => '',
                'isaziso_err' => ''
            ];

            //Validate data
            if (empty($data['singantoni'])) {
                $data['singantoni_err'] = 'Kufuneka uchaze isaziso sakho singantoni.';
            }
            if ($data['isaziso'] == 'Khetha') {
                $data['isaziso_err'] = 'Kufuneka ufake isaziso.';
            }

            //Make sure there no errors
            if (empty($data['singantoni_err']) && empty($data['isaziso_err'])) {
                //Validated
                if ($this->postModel->updateIsaziso($data)) {
                    flash('message_yesaziso', 'isaziso sakho has been updated');
                    redirect('izaziso/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('izaziso/edit', $data);
                }
        } else {
            $isaziso = $this->postModel->getIsazisoById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($isaziso->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("izaziso/");
            }

            //Update isaziso
            $data = [
                'id' => $id,
                'singantoni' => $isaziso->singantoni,
                'isaziso' => $isaziso->isaziso,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('izaziso/edit', $data);
        }
    }
        
    public function isaziso($id) {
        $isaziso = $this->postModel->getIsazisoById($id);
        $user = $this->userModel->getUserById($isaziso->id_yomntu);
        $comment = $this->postModel->getImpenduloById($id);
        $data = [
            'isaziso' => $isaziso,
            'igama_lomphenduli' => $comment->igama,
            'comment_date' => $comment->date,
            'umntu' => $user,
            'impendulo' => $comment->impendulo
        ];
        $this->view('izaziso/', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $isaziso = $this->postModel->getIsazisoById($id);

            //Check for owner
            if ($isaziso->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('izaziso/');
            }
            if ($this->postModel->deleteIsaziso($id)) {
                flash('message_yesaziso', 'isaziso sakho has been deleted');
                redirect('izaziso/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('izaziso/');
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
                if ($this->postModel->phendulaIsaziso($data)) {
                    flash('message_yempendulo', 'Impendulo yakho ingenile');
                    redirect('izaziso/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('izaziso/', $data);
                }
        } else {
            $isaziso = $this->postModel->getIsazisoById($id);
            $comment = $this->postModel->getImpenduloById($id);

            //Update isaziso
            if (!empty($comment)) {
                $data = [
                    'id' => $id,
                    'data' => $isaziso,
                    'id_yomntu' => $isaziso->userId,
                    'igama' => $isaziso->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'isaziso' => $isaziso->isaziso,
                    'date' => $isaziso->saziswe_nini,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment
                ];
            }
            $data = [
                'id' => $id,
                'data' => $isaziso,
                'id_yomntu' => $isaziso->userId,
                'igama' => $isaziso->igama,
                'isaziso' => $isaziso->isaziso,
                'date' => $isaziso->saziswe_nini,
                'comments' => $comment
            ];
            $this->view('izaziso/phendula', $data);
        }
    }
}