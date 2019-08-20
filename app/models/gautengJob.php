<?php
class gautengJob
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getImisebenzi()
    {
        $this->db->query(
            'SELECT *,
            imisebenzi.id as jobId,
            abantu.id as userId,
            imisebenzi.ndawoni as ndawoni_pha,
            imisebenzi.province as job_province,
            abantu.province as province_yomntu
            FROM imisebenzi
            INNER JOIN abantu
            ON imisebenzi.id_yomntu = abantu.id
            WHERE imisebenzi.province = "Gauteng"
            ORDER BY imisebenzi.created_at DESC
         ');
        $results = $this->db->resultSet();

        return $results;
    }

    public function addJob($data)
    {
        $this->db->query(
            "INSERT INTO imisebenzi (
                gama_le_company,
                id_yomntu,
                province,
                ndawoni,
                job_title,
                closing_date,
                msebenzi_onjani,
                mfundo,
                experience,
                ngowantoni,
                requirements,
                skills_competencies,
                responsibilities,
                additional_info,
                application_mode,
                slug,
                created_at,
                updated_at
                ) VALUE (
                :gama_le_company,
                :id_yomntu,
                :province,
                :ndawoni,
                :job_title,
                :closing_date,
                :msebenzi_onjani,
                :mfundo,
                :experience,
                :ngowantoni,
                :requirements,
                :skills_competencies,
                :responsibilities,
                :additional_info,
                :application_mode,
                :slug,
                :created_at,
                :updated_at
            )"
        );
        $this->db->bind(':gama_le_company', $data['gama_le_company']);
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':ndawoni', $data['ndawoni']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':closing_date', $data['closing_date']);
        $this->db->bind(':msebenzi_onjani', $data['msebenzi_onjani']);
        $this->db->bind(':mfundo', $data['mfundo']);
        $this->db->bind(':experience', $data['experience']);
        $this->db->bind(':ngowantoni', $data['ngowantoni']);
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':skills_competencies', $data['skills_competencies']);
        $this->db->bind(':responsibilities', $data['responsibilities']);
        $this->db->bind(':additional_info', $data['additional_info']);
        $this->db->bind(':application_mode', $data['application_mode']);
        $this->db->bind(':slug', createSlug($data['gama_le_company'] . '-' . $data['job_title'] . '-' . $data['ndawoni']));
        $this->db->bind(':created_at', date("Y-m-d H:i:s"));
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateJob($data)
    {
        $this->db->query(
            "UPDATE imisebenzi SET
                gama_le_company = :gama_le_company,
                province = :province,
                ndawoni = :ndawoni,
                job_title = :job_title,
                closing_date = :closing_date,
                msebenzi_onjani = :msebenzi_onjani,
                mfundo = :mfundo,
                experience = :experience,
                ngowantoni = :ngowantoni,
                requirements = :requirements,
                skills_competencies = :skills_competencies,
                responsibilities = :responsibilities,
                additional_info = :additional_info,
                application_mode = :application_mode, 
                created_at = :created_at,
                updated_at = :updated_at
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':gama_le_company', $data['gama_le_company']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':ndawoni', $data['ndawoni']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':closing_date', $data['closing_date']);
        $this->db->bind(':msebenzi_onjani', $data['msebenzi_onjani']);
        $this->db->bind(':mfundo', $data['mfundo']);
        $this->db->bind(':experience', $data['experience']);
        $this->db->bind(':ngowantoni', $data['ngowantoni']);
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':skills_competencies', $data['skills_competencies']);
        $this->db->bind(':responsibilities', $data['responsibilities']);
        $this->db->bind(':additional_info', $data['additional_info']);
        $this->db->bind(':application_mode', $data['application_mode']);
        $this->db->bind(':created_at', date("Y-m-d H:i:s"));
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getPostById($slug)
    {
        $this->db->query("SELECT * FROM imisebenzi WHERE slug = :slug");
        $this->db->bind(':slug', $slug);

        $row = $this->db->single();
        return $row;
    }
    
    public function getUserById($id)
    {
        $this->db->query(
            "SELECT * FROM abantu WHERE id = :id"
        );
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    /**
     * Delete the job
     */
    public function deleteJob($id)
    {
        $this->db->query("DELETE FROM imisebenzi WHERE id = :id");
        $this->db->bind(':id', $id);
        echo $id;

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Search query
     */
    public function searchImisebenzi($data)
    {
        $this->db->query(
            'SELECT * FROM
            imisebenzi WHERE province = "Gauteng"
            AND gama_le_company LIKE :search
            OR province = "Gauteng" AND ndawoni LIKE :search
            OR province = "Gauteng" AND job_title LIKE :search
            OR province = "Gauteng" AND ngowantoni LIKE :search
            OR province = "Gauteng" AND mfundo LIKE :search
            OR province = "Gauteng" AND responsibilities LIKE :search
            OR province = "Gauteng" AND skills_competencies LIKE :search
            OR province = "Gauteng" AND requirements LIKE :search
            OR province = "Gauteng" AND additional_info LIKE :search
            ORDER BY imisebenzi.created_at DESC
         ');
        $this->db->bind(':search', $data['search']);
        $results = $this->db->resultSet();

        return $results;
    }
}
?>