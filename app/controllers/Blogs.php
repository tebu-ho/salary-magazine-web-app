<?php

class Blogs extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Blog');
        $this->userModel = $this->model('Umntu');
    }

    public function index()
    {
        //Get imisebenzi
        $blogs = $this->postModel->getBlogs();
        $data = [
            'h1' => 'Blog yakho yibhale apha',
            'heading_ye_blog' => 'Igama le blog yakho',
            'blogs' => $blogs
        ];
        $this->view('blogs/index', $data);
    }

    public function bhala()
    {
        if (!isset($_SESSION['id_yomntu'])) {
            redirect('abantu/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'body' => nl2br($_POST['body']),
                'image_name' => strip_tags(trim($_FILES['image']['name'])),
                'image_size' => trim($_FILES['image']['size']),
                'image_type' => trim($_FILES['image']['type']),
                'tmp_name' => trim($_FILES['image']['tmp_name']),
                'title_err' => '',
                'body_err' => '',
                'image_type_err' => '',
                'image_size_err' => '',
            ];

            //Set image directory
             $dir = 'C:\wamp64\www\mvc-app\public\img';
            echo $dir . '/' . $data['image_name'];
            //Validate image type
            if ($data['image_type'] != "image/jpg" || $data['image_type'] != "image/png") {
                $data['image_type_err'] = "Type ye image yakho kufuneka ibe yi jpg or png";
            }
            //Validate image size
            if ($data['image_size'] > 2000000) {
                $data['image_size_err'] = "Image yakho akufunekanga ibengaphezulu ko 2 MB";
            }
            //Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Title ye blog yakho';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Body ye blog yakho?';
            }

            //Make sure there no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //Validate image type
                    move_uploaded_file($data['tmp_name'], $dir . '/' . $data['image_name']);
                //Validated
                if ($this->postModel->addBlog($data)) {
                    flash('message_ye_blog', 'Blog yakho ingenile');
                    redirect('blogs');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('blogs/bhala', $data);
                }
        } else {
            //Add body
            $data = [
                'title' => '',
                'body' => '',
                'image_name' => ''
            ];
            $this->view('blogs/bhala', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'id_yomntu' => $_SESSION['id_yomntu'],
                'body' => nl2br($_POST['body']),
                'updated_at' => date('Y-m-d'),
                'title_err' => '',
                'body_err' => ''
            ];

            //Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Kufuneka uchaze Blog title yakho.';
            }
            if ($data['body'] == 'Khetha') {
                $data['body_err'] = 'Kufuneka uthandaze.';
            }

            //Make sure there no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //Validated
                if ($this->postModel->updateBlog($data)) {
                    flash('message_ye_blog', 'Blog yakho has been updated');
                    redirect('blogs/');
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('blogs/edit', $data);
                }
        } else {
            $body = $this->postModel->getBlogById($id);

            //Check if ifakwe nguye le blog lomntu
            if ($body->id_yomntu != $_SESSION['id_yomntu']) {
                redirect("blogs/");
            }

            //Update body
            $data = [
                'id' => $id,
                'title' => $body->title,
                'body' => $body->body,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->view('blogs/edit', $data);
        }
    }
        
    public function blog($id) {
        $blog = $this->postModel->getBlogById($id);
        $user = $this->userModel->getUserById($blog->id_yomntu);
        $data = [
            'body' => $blog,
            'umntu' => $user
        ];
        $this->view('blogs/blog', $data);
    }

    /**
     * Delete job
     * 
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get existing job from model
            $blog = $this->postModel->getBlogById($id);

            //Check for owner
            if ($blog->id_yomntu != $_SESSION['id_yomntu']) {
                redirect('blogs/');
            }
            if ($this->postModel->deleteBlog($id)) {
                flash('message_ye_blog', 'Blog yakho has been deleted');
                redirect('blogs/');
            } else {
                die('Ikhono into erongo eyenzekileyo');
            }
        } else {
            redirect('blogs/');
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
                if ($this->postModel->blogComment($data)) {
                    flash('message_yempendulo', 'Impendulo yakho ingenile');
                    redirect("blogs/phendula/$id");
                } else {
                    die('Ikhona into erongo');
                }
                } else {
                    //Load the view with errors
                    $this->view('blogs/', $data);
                }
        } else {
            $blogs = $this->postModel->getBlogById($id);
            $comment = $this->postModel->getImpenduloById($id);

            if (!empty($comment)) {
                $data = [
                    'id' => $id,
                    'data' => $blogs,
                    'id_yomntu' => $blogs->userId,
                    'igama' => $blogs->igama,
                    'igama_lomphenduli' => $comment[0]->igama,
                    'comment_date' => $comment[0]->date,
                    'title' => $blogs->title,
                    'body' => $blogs->body,
                    'date' => $blogs->pub_date,
                    'impendulo' => $comment[0]->impendulo,
                    'comments' => $comment
                ];
            } else {
                $data = [
                    'id' => $id,
                    'data' => $blogs,
                    'id_yomntu' => $blogs->userId,
                    'igama' => $blogs->igama,
                    'title' => $blogs->title,
                    'body' => $blogs->body,
                    'date' => $blogs->pub_date,
                    'comments' => $comment
                ];
            }
            $this->view('blogs/phendula', $data);
        }
    }  
}