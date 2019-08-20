<?php

class westernCapeJobs extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('westernCapeJob');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        //Get imisebenzi
        $imisebenzi = $this->postModel->getImisebenzi();
        $data = [
            'imisebenzi' => $imisebenzi
        ];
        $this->view('westernCapeJobs/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'gama_le_company' => trim($_POST['igama_le_company']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'province' => $_POST['job_province'],
                'ndawoni' => trim($_POST['ndawoni_pha']),
                'job_title' => trim($_POST['job_title']),
                'closing_date' => trim($_POST['closing_date']),
                'msebenzi_onjani' => trim($_POST['msebenzi_onjani']),
                'mfundo' => trim($_POST['mfundo']),
                'experience' => trim($_POST['experience']),
                'ngowantoni' => trim($_POST['ngowantoni']),
                'requirements' => trim($_POST['requirements']),
                'skills_competencies' => trim($_POST['skills_competencies']),
                'responsibilities' => trim($_POST['responsibilities']),
                'additional_info' => trim($_POST['additional_info']),
                'application_mode' => trim($_POST['application_mode']),
                'gama_le_company_err' => '',
                'province_err' => '',
                'ndawoni_pha_err' => '',
                'job_title_err' => '',
                'msebenzi_onjani_err' => '',
                'mfundo_err' => '',
                'experience_err' => '',
                'ngowantoni_err' => '',
                'requirements_err' => '',
                'responsibilities_err' => '',
                'application_mode_err' => '',
            ];

            //Validate data
            if (empty($data['gama_le_company'])) {
                $data['gama_le_company_err'] = 'Kufuneka ufake igama le company.';
            }
            if ($data['province'] == 'Khetha') {
                $data['province_err'] = 'Kufuneka ukhethe i-province';
            }
            if (empty($data['ndawoni'])) {
                $data['ndawoni_pha_err'] = 'Ndawoni pha?';
            }
            if (empty($data['job_title'])) {
                $data['job_title_err'] = 'Job title ithini';
            }
            if ($data['msebenzi_onjani'] == 'Khetha') {
                $data['msebenzi_onjani_err'] = 'Ngumsebenzi onjani lo?';
            }
            if ($data['mfundo'] == 'Khetha') {
                $dta['mfundo_err'] = 'Level yemfundo ithini';
            }
            if ($data['experience'] == 'Khetha') {
                $data['experience_err'] = 'Experienceefunwayo ingakanani?';
            }
            if ($data['ngowantoni'] == 'Khetha') {
                $data['ngowantoni_err'] = 'Ngumsebenzi wantoni lo?';
            }
            if (empty($data['requirements'])) {
                $data['requirements_err'] = 'Requirements zithini?';
            }
            if (empty($data['responsibilities']))  {
                $data['responsibilities_err'] = 'Responsibilities zithini?';
            }
            if (empty($data['application_mode'])) {
                $data['application_mode_err'] = 'Ku aplaywa njani?';
            }

            //Make sure there no errors
            if (empty($data['gama_le_company_err']) && empty($data['province_err']) && empty($data['ndawoni_pha_err']) && empty($data['job_title_err']) && empty($data['msebenzi_onjani_err']) && empty($dta['mfundo_err']) && empty($data['experience_err']) && empty($data['ngowantoni_err']) && empty($data['requirements_err']) && empty($data['responsibilities_err']) && empty($data['application_mode_err'])) {
                //Validated
                if ($this->postModel->addJob($data)) {
                    flash('message_yomsebenzi', 'Umsebenzi wakho ungenile');
                    redirect('westernCapeJobs');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('westernCapeJobs/add', $data);
                }
        } else {
            //Add umsebenzi
            $data = [
                'gama_le_company' => '',
                'province' => '',
                'ndawoni' => '',
                'job_title' => '',
                'closing_date' => '',
                'msebenzi_onjani' => '',
                'mfundo' => '',
                'experience' => '',
                'ngowantoni' => '',
                'requirements' => '',
                'skills_competencies' => '',
                'responsibilities' => '',
                'additional_info' => '',
                'application_mode' => '',
            ];
            $this->view('westernCapeJobs/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'gama_le_company' => filter_input(INPUT_POST, 'igama_le_company', FILTER_SANITIZE_STRING),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'province' => filter_input(INPUT_POST, 'job_province', FILTER_SANITIZE_STRING),
                'ndawoni' => filter_input(INPUT_POST, 'ndawoni_pha', FILTER_SANITIZE_STRING),
                'job_title' => filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING),
                'closing_date' => filter_input(INPUT_POST, 'closing_date', FILTER_SANITIZE_STRING),
                'msebenzi_onjani' => filter_input(INPUT_POST, 'msebenzi_onjani', FILTER_SANITIZE_STRING),
                'mfundo' => filter_input(INPUT_POST, 'mfundo', FILTER_SANITIZE_STRING),
                'experience' => filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING),
                'ngowantoni' => filter_input(INPUT_POST, 'ngowantoni', FILTER_SANITIZE_STRING),
                'requirements' => trim($_POST['requirements']),
                'skills_competencies' => trim($_POST['skills_competencies']),
                'responsibilities' => trim($_POST['responsibilities']),
                'additional_info' => filter_input(INPUT_POST, 'additional_info', FILTER_SANITIZE_STRING),
                'application_mode' => filter_input(INPUT_POST, 'application_mode', FILTER_SANITIZE_STRING),
                'updated_at' => date('Y-m-d'),
                'gama_le_company_err' => '',
                'province_err' => '',
                'ndawoni_pha_err' => '',
                'job_title_err' => '',
                'msebenzi_onjani_err' => '',
                'mfundo_err' => '',
                'experience_err' => '',
                'ngowantoni_err' => '',
                'requirements_err' => '',
                'responsibilities_err' => '',
                'application_mode_err' => '',
            ];

            //Validate data
            if (empty($data['gama_le_company'])) {
                $data['gama_le_company_err'] = 'Kufuneka ufake igama le company.';
            }
            if ($data['province'] == 'Khetha') {
                $data['province_err'] = 'Kufuneka ukhethe i-province';
            }
            if (empty($data['ndawoni'])) {
                $data['ndawoni_pha_err'] = 'Ndawoni pha?';
            }
            if (empty($data['job_title'])) {
                $data['job_title_err'] = 'Job title ithini';
            }
            if ($data['msebenzi_onjani'] == 'Khetha') {
                $data['msebenzi_onjani_err'] = 'Ngumsebenzi onjani lo?';
            }
            if ($data['mfundo'] == 'Khetha') {
                $dta['mfundo_err'] = 'Level yemfundo ithini';
            }
            if ($data['experience'] == 'Khetha') {
                $data['experience_err'] = 'Experience efunwayo ingakanani?';
            }
            if ($data['ngowantoni'] == 'Khetha') {
                $data['ngowantoni_err'] = 'Ngumsebenzi wantoni lo?';
            }
            if (empty($data['requirements'])) {
                $data['requirements_err'] = 'Requirements zithini?';
            }
            if (empty($data['responsibilities']))  {
                $data['responsibilities_err'] = 'Responsibilities zithini?';
            }
            if (empty($data['application_mode'])) {
                $data['application_mode_err'] = 'Ku aplaywa njani?';
            }

            //Make sure there no errors
            if (empty($data['gama_le_company_err']) && empty($data['province_err']) && empty($data['ndawoni_pha_err']) && empty($data['job_title_err']) && empty($data['msebenzi_onjani_err']) && empty($dta['mfundo_err']) && empty($data['experience_err']) && empty($data['ngowantoni_err']) && empty($data['requirements_err']) && empty($data['responsibilities_err']) && empty($data['application_mode_err'])) {
                //Validated
                if ($this->postModel->updateJob($data)) {
                    flash('message_yomsebenzi', 'Umsebenzi wakho has been updated');
                    redirect('westernCapeJobs');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('westernCapeJobs/edit', $data);
                }
        } else {
            $umsebenzi = $this->postModel->getPostById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($umsebenzi->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("westernCapeJobs");
            }

            //Update umsebenzi
            $data = [
                'id' => $id,
                'gama_le_company' => $umsebenzi->gama_le_company,
                'province' => $umsebenzi->province,
                'ndawoni' => $umsebenzi->ndawoni,
                'job_title' => $umsebenzi->job_title,
                'closing_date' => $umsebenzi->closing_date,
                'msebenzi_onjani' => $umsebenzi->msebenzi_onjani,
                'mfundo' => $umsebenzi->mfundo,
                'experience' => $umsebenzi->experience,
                'ngowantoni' => $umsebenzi->ngowantoni,
                'requirements' => $umsebenzi->requirements,
                'skills_competencies' => $umsebenzi->skills_competencies,
                'responsibilities' => $umsebenzi->responsibilities,
                'additional_info' => $umsebenzi->additional_info,
                'application_mode' => $umsebenzi->application_mode,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('westernCapeJobs/edit', $data);
        }
    }
        
    public function umsebenzi($slug) {
        $umsebenzi = $this->postModel->getPostById($slug);
        $user = $this->userModel->getUserById($umsebenzi->id_yomntu);
        $data = [
            'umsebenzi' => $umsebenzi,
            'umntu' => $user
        ];
        $this->view('westernCapeJobs/umsebenzi', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $umsebenzi = $this->postModel->getPostById($id);

            //Check for owner
            if ($umsebenzi->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('westernCapeJobs');
            }
            if ($this->postModel->deleteJob($id)) {
                flash('message_yomsebenzi', 'Umsebenzi wakho has been deleted');
                redirect('westernCapeJobs');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('westernCapeJobs');
        }
    }

    /**
     * Search query
     */

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Get imisebenzi
            $search = $_GET['search'];
            $search = "%$search%";
            $data = [
                'search' =>  $search
            ];
            
            $imisebenzi = $this->postModel->searchImisebenzi($data);
            $data = [
                'imisebenzi' => $imisebenzi
            ];
            $this->view('westernCapeJobs/search', $data);
        }
    }
}