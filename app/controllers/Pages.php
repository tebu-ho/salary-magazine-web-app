<?php
    class Pages extends Controller
    {
        public function __construct()
        {
            
        }

        public function index() {
            $data = [
                'title' => 'Ukhangela Umsebenzi Ondawoni?',
                'description' => 'Cofa kwi province owuyifunayo.',
                'provinces' => array(
                    'Eastern Cape',
                    'Free State',
                    'Gauteng',
                    'KwaZulu-Natal',
                    'Limpopo',
                    'Mpumalanga',
                    'North West',
                    'Northern Cape',
                    'Western Cape'
                ),
                'cta_heading' => 'Nawe unayo imisebenzi ofuna ukuyifaka?',
                'cta_content' => 'Kufuneka ungene kwi profile yakho ukuze ufake imisebenzi. Okanye ubhalise ukuba awukabhalisi.'
            ];
            $this->view('pages/index', $data);
        }
        
        public function chatroom() {
            $data = [
                'title' => 'Chatroom',
            ];
            $this->view('pages/chatroom', $data);
        }

        public function imibuzo()
        {
            $data = [];
            $this->view('chatroom/imibuzo/index');
        }

        public function events()
        {
            $data = [];
            $this->view('chatroom/events', $data);
        }
    
        public function imithandazo()
        {
            $data = [];
            $this->view('chatroom/imithandazo', $data);
        }
    
        public function izaziso()
        {
            $data = [];
            $this->view('chatroom/izaziso', $data);
        }
    
        public function add()
        {
            $data = [];
            $this->view('jobs/add', $data);
        }
    
        public function blog()
        {
            $data = [];
            $this->view('chatroom/blog', $data);
        }
    }