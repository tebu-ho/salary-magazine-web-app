<?php
class Abantu extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        redirect('pages/chatroom');    }

    public function register()
    {
        //Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Process form
            $data = [
                'igama' => trim($_POST['igama']),
                'fani' => trim($_POST['fani']),
                'email' => trim($_POST['email']),
                'province' => trim($_POST['province']),
                'ndawoni' => trim($_POST['ndawoni']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'igama_err' => '',
                'email_err' => '',
                'province_err' => '',
                'ndawoni_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //Validate name
            if(empty($data['igama'])) {
                $data['igama_err'] = "Sicela ufake igama lakho";
            }

            //Validate ifani
            if(empty($data['fani'])) {
                $data['ifani_err'] = "Sicela ufake ifani lakho";
            }

            //Validate email
            if(empty($data['email'])) {
                $data['email_err'] = "Sicela ufake email yakho";
            } else {
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "Ukhona umntu osebenzisa le email.";
                }
            }

            //Validate province
            if(empty($data['province'])) {
                $data['province_err'] = "Sicela ufake province yakho";
            }

            //Validate endawonimail
            if(empty($data['ndawoni'])) {
                $data['ndawoni_err'] = "Sicela ufake ndawoni yakho";
            }
            
            //Validate password
            if(empty($data['password'])) {
                $data['password_err'] = "Sicela ufake password yakho";
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = "Password yakho kufuneka ibene characters eziyi 6 at least.";
            }

            //Validate password confirmation
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Sicela uqinisekise password yakho";
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Qinisekisa passwords zakho ziyafana.';
                }
            }

            //Make sure errors are empty
            if (
                empty($data['email_err']) && empty($data['igama_err']) && empty($data['fani_err']) && empty($data['province_err']) && empty($data['ndawoni_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ) {
                
                //Has password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register umntu
                if ($this->userModel->bhalisaUmntu($data)) {
                    flash('register_success', 'Enkosi ngokubhalisa. Ungangena ngoku.');
                   redirect('abantu/login');
                } else {
                    die('Ikhona into eyenzekileyo erongo');
                }
            } else {
                //Load view with errors
                $this->view('abantu/register', $data);
            }
        } else {
            //Init data
            $data = [
                'igama' => '',
                'fani' => '',
                'email' => '',
                'province' => '',
                'ndawoni' => '',
                'password' => '',
                'confirm_password' => '',
                'igama_err' => '',
                'email_err' => '',
                'province_err' => '',
                'ndawoni_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //Load view
            $this->view('abantu/register', $data);
        }
    }

    public function login()
    {
        //Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Process form
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            //Validate email
            if(empty($data['email'])) {
                $data['email_err'] = "Sicela ufake email yakho";
            }
            
            //Validate password
            if(empty($data['password'])) {
                $data['password_err'] = "Sicela ufake password yakho";
            }

            //Check for user/email
            if($this->userModel->findUserByEmail($data['email'])) {

            } else {
                //Akhomntu onjalo apha
                $data['email_err'] = 'Ha a, akekho umntu onjalo apha';
            }

            //Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])) {
                //Validated
                //Jonga umntu then umngeni if ukhona
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    //Qala i-session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password yakho irongo';
                    $this->view('abantu/login', $data);
                }
            } else {
                //Load view with errors
                $this->view('abantu/login', $data);
            }
        } else {
            //Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            //Load view
            $this->view('abantu/login', $data);
        }
    }
    public function createUserSession($umntu)
    {
        $_SESSION['id_yomntu'] = $umntu->id;
        $_SESSION['email_yomntu'] = $umntu->email;
        $_SESSION['igama_lomntu'] = $umntu->igama;
        redirect('pages/chatroom');
    }
    /**
     * Log user out
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['id_yomntu']);
        unset($_SESSION['email_yomntu']);
        unset($_SESSION['igama_lomntu']);
        session_destroy();
        redirect('');
    }

    public function isLoggedIn()
    {
        if(isset($_SESSION['id_yomntu'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Change password
     */
    public function password()
    {
        $this->view('abantu/password');
    }

    /**
     * Profile yomntu
     */
    public function profile($id)
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'igama' => trim($_POST['igama']),
                'fani' => trim($_POST['fani']),
                'email' => trim($_POST['email']),
                'phone_number' => trim($_POST['phone_number']),
                'phone_number_yesibini' => trim($_POST['phone_number_yesibini']),
                'province' => $_POST['province'],
                'ndawoni' => trim($_POST['ndawoni']),
                'uyasebenza' => $_POST['uyasebenza'],
                'gender' => $_POST['gender'],
                'zazise' => trim($_POST['zazise']),
                'updated_at' => date('Y-m-d')
            ];

            //Validate data
            if (empty($data['igama'])) {
                $data['igama_err'] = 'Kufuneka ufake igama le company.';
            }
            if (empty($data['fani'])) {
                $data['fani_err'] = 'Job title ithini';
            }
            if ($data['province'] == 'Khetha') {
                $data['province_err'] = 'Kufuneka ukhethe i-province';
            }
            if (empty($data['ndawoni'])) {
                $data['ndawoni_err'] = 'Ndawoni pha?';
            }
            if ($data['email'] == 'Khetha') {
                $data['email_err'] = 'Ngumsebenzi onjani lo?';
            }
            if ($data['phone_number'] == 'Khetha') {
                $dta['phone_number_err'] = 'Level yephone_number ithini';
            }
            if ($data['phone_number_yesibini'] == 'Khetha') {
                $data['phone_number_yesibini_err'] = 'phone_number_yesibini efunwayo ingakanani?';
            }
            if ($data['uyasebenza'] == 'Khetha') {
                $data['uyasebenza_err'] = 'Ngumsebenzi wantoni lo?';
            }
            if (empty($data['gender'])) {
                $data['gender_err'] = 'gender zithini?';
            }

            //Make sure there no errors
            if (empty($data['igama_err']) && empty($data['province_err']) && empty($data['ndawoni_err']) && empty($data['fani_err']) && empty($data['email_err']) && empty($dta['phone_number_err']) && empty($data['phone_number_yesibini_err']) && empty($data['uyasebenza_err']) && empty($data['gender_err']) && empty($data['zazise_err'])) {
                //Validated
                if ($this->userModel->updateUmntu($data)) {
                    flash('message_yomsebenzi', 'Personal details zakho have been updated');
                    redirect("abantu/profile/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view("abantu/profile/$id", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION['id_yomntu']) {
                redirect("abantu/profile/$id");
            }

            //Update user
            $data = [
                'id' => $id,
                'igama' => $user->igama,
                'fani' => $user->fani,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'phone_number_yesibini' => $user->phone_number_yesibini,
                'zazise' => $user->zazise,
                'province' => $user->province,
                'ndawoni' => $user->ndawoni,
                'uyasebenza' => $user->uyasebenza,
                'gender' => $user->gender,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('abantu/profile', $data);
        }
        $this->view('abantu/profile');
    }

    public function education($id)
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'id_yomntu' => $_SESSION['id_yomntu'],
                'ubufunda_phi' => trim($_POST['ubufunda_phi']),
                'ubusenza_ntoni' => trim($_POST['ubusenza_ntoni']),
                'ugqibe_nini' => trim($_POST['ugqibe_nini']),
                'created_at' => date('Y-m-d H:i:s')
            ];

            //Validate data
            if (empty($data['ubufunda_phi'])) {
                $data['ubufunda_phi_err'] = 'Kufuneka ukhethe i-ubufunda_phi';
            }
            if (empty($data['ugqibe_nini'])) {
                $dta['ugqibe_nini_err'] = 'Level yeugqibe_nini ithini';
            }
            if (empty($data['ubusenza_ntoni'])) {
                $data['ubusenza_ntoni_err'] = 'ubusenza_ntoni zithini?';
            }

            //Make sure there no errors
            if (empty($data['ubufunda_phi_err']) && empty($dta['ugqibe_nini_err']) && empty($data['ubusenza_ntoni_err'])) {
                //Validated
                if ($this->userModel->addEducation($data)) {
                    flash('message_ye_education', 'Education yakho ingenile. Ba unayo enye ungayifaka.');
                    redirect("abantu/education/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view("abantu/education/$id", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION['id_yomntu']) {
                redirect("abantu/education/$id");
            }
            //Update user
            $data = [
                'id' => $id,
                'ubufunda_phi' => '',
                'ubusenza_ntoni' =>'',
                'ugqibe_nini' => '',
                'created_at' => date("Y-m-d H:i:s")
            ];
            $this->view('abantu/education', $data);
        }
        $this->view('abantu/education');
    }

    public function experience($id)
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_yomntu' => $id,
                'company' => trim($_POST['company']),
                'job_title' => trim($_POST['job_title']),
                'uqale_nini' => trim($_POST['uqale_nini']),
                'ugqibe_nini' => trim($_POST['ugqibe_nini']),
                'responsibilities' => trim($_POST['responsibilities']),
                'reason_for_leaving' => trim($_POST['reason_for_leaving']),
                'usasebenza_apha' => trim($_POST['usasebenza_apha']),
                'created_at' => date('Y-m-d H:i:s')
            ];

            //Validate data
            if (empty($data['company'])) {
                $data['company_err'] = 'Kufuneka ukhethe i-company';
            }
            if (empty($data['uqale_nini'])) {
                $dta['uqale_nini_err'] = 'Level yeuqale_nini ithini';
            }
            if (empty($data['job_title'])) {
                $data['job_title_err'] = 'job_title zithini?';
            }

            //Make sure there no errors
            if (empty($data['company_err']) && empty($data['uqale_nini_err']) && empty($data['job_title_err'])) {
                //Validated
                if ($this->userModel->addExperience($data)) {
                    flash('message_ye_experience', 'Experience yakho ingenile. Ba unayo enye ungayifaka.');
                    redirect("abantu/experience/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view("abantu/experience/$id", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION['id_yomntu']) {
                redirect("abantu/experience/$id");
            }
            //Update user
            $data = [
                'id_yomntu' => $id,
                'company' => '',
                'job_title' =>'',
                'uqale_nini' => '',
                'ugqibe_nini' => '',
                'responsibilities' => '',
                'reason_for_leaving' => '',
                'usasebenza_apha' => '',
                'created_at' => date("Y-m-d H:i:s")
            ];
            $this->view('abantu/experience', $data);
        }
        $this->view('abantu/experience');
    }

    public function skills($id)
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_yomntu' => $id,
                'skill_sokuqala' => trim($_POST['skill_sokuqala']),
                'skill_sesibini' => trim($_POST['skill_sesibini']),
                'skill_sesithathu' => trim($_POST['skill_sesithathu']),
                'skill_sesine' => trim($_POST['skill_sesine']),
                'skill_sesihlanu' => trim($_POST['skill_sesihlanu']),
                'skill_sesithandathu' => trim($_POST['skill_sesithandathu']),
                'created_at' => date('Y-m-d H:i:s')
            ];

            //Validate data
            if (empty($data['skill_sokuqala'])) {
                $data['skill_sokuqala_err'] = 'Kufuneka ukhethe i-skill_sokuqala';
            }
            if (empty($data['skill_sesibini'])) {
                $data['skill_sesibini_err'] = 'skill_sesibini zithini?';
            }
            if (empty($data['skill_sesithathu'])) {
                $data['skill_sesithathu_err'] = 'Level yeskill_sesithathu ithini';
            }
            if (empty($data['skill_sesine'])) {
                $data['skill_sesibini_err'] = 'skill_sesibini zithini?';
            }
            if (empty($data['skill_sesihlanu'])) {
                $data['skill_sesibini_err'] = 'skill_sesibini zithini?';
            }
            if (empty($data['skill_sesithandathu'])) {
                $data['skill_sesibini_err'] = 'skill_sesibini zithini?';
            }

            //Make sure there no errors
            if (
                empty($data['skill_sokuqala_err'])
                && empty($data['skill_sesibini_err'])
                && empty($dta['skill_sesithathu_err'])
                && empty($data['skill_sesine_err'])
                && empty($data['skill_sesihlanu_err'])
                && empty($data['skill_sesithandathu_err'])
            ) {
                //Validated
                if ($this->userModel->addSkills($data)) {
                    flash('message_ye_skills', 'Skills yakho ingenile. Ba unayo enye ungayifaka.');
                    redirect("abantu/skills/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view("abantu/skills/$id", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION['id_yomntu']) {
                redirect("abantu/skills/$id");
            }
            //Update user
            $data = [
                'id_yomntu' => $id,
                'skill_sokuqala' => '',
                'skill_sesibini' =>'',
                'skill_sesithathu' => '',
                'skill_sesine' => '',
                'skill_sesihlanu' => '',
                'skill_sesithandathu' => '',
                'created_at' => date("Y-m-d H:i:s")
            ];
            $this->view("abantu/skills", $data);
        }
        $this->view("abantu/skills");
    }

    /**
     * Achievements
     *
     * @param [type] $id
     * @return void
     */
    public function achievements($id)
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_yomntu' => $id,
                'achievement_name' => trim($_POST['achievement_name']),
                'company' => trim($_POST['company']),
                'year' => trim($_POST['year']),
                'created_at' => date('Y-m-d H:i:s')
            ];

            //Validate data
            if (empty($data['achievement_name'])) {
                $data['achievement_name_err'] = 'Kufuneka ukhethe i-achievement_name';
            }
            if (empty($data['company'])) {
                $data['company_err'] = 'company zithini?';
            }
            if (empty($data['year'])) {
                $data['year_err'] = 'Level yeyear ithini';
            }

            //Make sure there no errors
            if (
                empty($data['achievement_name_err'])
                && empty($data['company_err'])
                && empty($dta['year_err'])
            ) {
                //Validated
                if ($this->userModel->addAchievements($data)) {
                    flash('message_ye_achievements', 'achievements yakho ingenile. Ba unayo enye ungayifaka.');
                    redirect("abantu/achievements/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view("abantu/achievements/$id", $data);
                }
        } else {
            $user = $this->userModel->getUserById($id);

            //Check if ufakwe nguye lomsebenzi lomntu
            if ($user->id != $_SESSION['id_yomntu']) {
                redirect("abantu/achievements/$id");
            }
            //Update user
            $data = [
                'id_yomntu' => $id,
                'achievement_name' => '',
                'company' =>'',
                'year' => '',
                'created_at' => date("Y-m-d H:i:s")
            ];
            $this->view("abantu/achievements", $data);
        }
        $this->view("abantu/achievements");
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
                redirect('abantu');
            }
            if ($this->postModel->deleteJob($id)) {
                flash('message_yomsebenzi', 'Umsebenzi wakho has been deleted');
                redirect('abantu');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('abantu');
        }
    }
}