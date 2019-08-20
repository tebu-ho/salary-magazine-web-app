<?php
    class Umntu
    {
        private $db;
        
        public function __construct()
        {
            $this->db = new Database;
        }

        /**
         * Register umntu
         *
         * @param [type] $email
         * @return void
         */
        public function bhalisaUmntu($data)
        {
            $this->db->query(
                "INSERT INTO abantu (
                    igama,
                    fani,
                    email,
                    password,
                    province,
                    ndawoni,
                    pro_pic,
                    gender,
                    nani_lemisebenzi,
                    nani_le_likes,
                    user_closed,
                    array_yabantu,
                    bhalise_nini,
                    vkey,
                    verified
                    ) VALUE (
                        :igama,
                        :fani,
                        :email,
                        :password,
                        :province,
                        :ndawoni,
                        '',
                        '',
                        0,
                        0,
                        '',
                        '',
                        now(),
                        '',
                        ''
                        )"
            );
            $this->db->bind(':igama', $data['igama']);
            $this->db->bind(':fani', $data['fani']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':province', $data['province']);
            $this->db->bind(':ndawoni', $data['ndawoni']);

            //Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //Ngenisa umntu
        public function login($email, $password) {
            $this->db->query('SELECT * FROM abantu WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        }

        /**
         * Update umntu
         */
        public function updateUmntu($data)
        {
            $this->db->query(
                "UPDATE abantu SET
                    igama = :igama,
                    fani = :fani,
                    email = :email,
                    province = :province,
                    ndawoni = :ndawoni,
                    uyasebenza = :uyasebenza,
                    gender = :gender,
                    zazise = :zazise,
                    phone_number = :phone_number,
                    phone_number_yesibini = :phone_number_yesibini,
                    updated_at = :updated_at
                    WHERE id = :id"
            );
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':igama', $data['igama']);
            $this->db->bind(':fani', $data['fani']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':province', $data['province']);
            $this->db->bind(':ndawoni', $data['ndawoni']);
            $this->db->bind(':uyasebenza', $data['uyasebenza']);
            $this->db->bind(':gender', $data['gender']);
            $this->db->bind(':zazise', $data['zazise']);
            $this->db->bind(':phone_number', $data['phone_number']);
            $this->db->bind(':phone_number_yesibini', $data['phone_number_yesibini']);
            $this->db->bind(':updated_at', date("Y-m-d H:i:s"));
    
            //Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //Find user by email
        public function findUserByEmail($email)
        {
            $this->db->query('SELECT * FROM abantu WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    
    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM abantu WHERE id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    /**
     * Eduction
     */
    public function addEducation($data)
    {
        $this->db->query(
            "INSERT INTO education (
                id_yomntu,
                ubufunda_phi,
                ubusenza_ntoni,
                ugqibe_nini
                ) VALUE (
                    :id,
                    :ubufunda_phi,
                    :ubusenza_ntoni,
                    :ugqibe_nini
                    )"
        );
        $this->db->bind(':ubufunda_phi', $data['ubufunda_phi']);
        $this->db->bind(':ubusenza_ntoni', $data['ubusenza_ntoni']);
        $this->db->bind(':ugqibe_nini', $data['ugqibe_nini']);
        $this->db->bind(':id', $data['id']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Experience
     */
    public function addExperience($data)
    {
        $this->db->query(
            "INSERT INTO experience (
                id_yomntu,
                company,
                job_title,
                responsibilities,
                uqale_nini,
                ugqibe_nini,
                reason_for_leaving,
                usasebenza_apha
                ) VALUE (
                    :id_yomntu,
                    :company,
                    :job_title,
                    :responsibilities,
                    :uqale_nini,
                    :ugqibe_nini,
                    :reason_for_leaving,
                    :usasebenza_apha
                )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':company', $data['company']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':responsibilities', $data['responsibilities']);
        $this->db->bind(':uqale_nini', $data['uqale_nini']);
        $this->db->bind(':ugqibe_nini', $data['ugqibe_nini']);
        $this->db->bind(':reason_for_leaving', $data['reason_for_leaving']);
        $this->db->bind(':usasebenza_apha', $data['usasebenza_apha']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Skills
     */
    public function addSkills($data)
    {
        $this->db->query(
            "INSERT INTO skills (
                id_yomntu,
                skill_sokuqala,
                skill_sesibini,
                skill_sesithathu,
                skill_sesine,
                skill_sesihlanu,
                skill_sesithandathu
                ) VALUE (
                    :id_yomntu,
                    :skill_sokuqala,
                    :skill_sesibini,
                    :skill_sesithathu,
                    :skill_sesine,
                    :skill_sesihlanu,
                    :skill_sesithandathu
                )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':skill_sokuqala', $data['skill_sokuqala']);
        $this->db->bind(':skill_sesibini', $data['skill_sesibini']);
        $this->db->bind(':skill_sesithathu', $data['skill_sesithathu']);
        $this->db->bind(':skill_sesine', $data['skill_sesine']);
        $this->db->bind(':skill_sesihlanu', $data['skill_sesihlanu']);
        $this->db->bind(':skill_sesithandathu', $data['skill_sesithandathu']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Skills
     */
    public function addAchievements($data)
    {
        $this->db->query(
            "INSERT INTO achievements (
                id_yomntu,
                achievement_name,
                company,
                year
                ) VALUE (
                    :id_yomntu,
                    :achievement_name,
                    :company,
                    :year
                )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':achievement_name', $data['achievement_name']);
        $this->db->bind(':company', $data['company']);
        $this->db->bind(':year', $data['year']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}