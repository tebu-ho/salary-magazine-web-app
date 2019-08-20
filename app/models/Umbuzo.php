<?php
class Umbuzo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getImibuzo()
    {
        $this->db->query(
            'SELECT *,
            imibuzo.id as umbuzoId,
            abantu.id as userId
            FROM imibuzo
            INNER JOIN abantu
            ON imibuzo.id_yomntu = abantu.id
            ORDER BY imibuzo.buzwe_nini DESC'
        );
        $results = $this->db->resultSet();

        return $results;
    }

    public function fakaUmbuzo($data)
    {
        $this->db->query(
            "INSERT INTO imibuzo (
                ungantoni,
                id_yomntu,
                umbuzo,
                number_of_likes,
                number_comments,
                number_of_complaints,
                buzwe_nini
                ) VALUE (
                :ungantoni,
                :id_yomntu,
                :umbuzo,
                :number_of_likes,
                :number_comments,
                :number_of_complaints,
                :buzwe_nini
            )"
        );
        $this->db->bind(':ungantoni', $data['ungantoni']);
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':umbuzo', $data['umbuzo']);
        $this->db->bind(':number_of_likes', 0);
        $this->db->bind(':number_comments', 0);
        $this->db->bind(':number_of_complaints', 0);
        $this->db->bind(':buzwe_nini', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUmbuzo($data)
    {
        $this->db->query(
            "UPDATE imibuzo SET
                ungantoni = :ungantoni,
                umbuzo = :umbuzo,
                updated_at = :updated_at
                WHERE id = :id"
        );
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':ungantoni', $data['ungantoni']);
        $this->db->bind(':umbuzo', $data['umbuzo']);
        $this->db->bind(':updated_at', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUmbuzoById($id)
    {
        $this->db->query(
            "SELECT *,
            imibuzo.id as umbuzoId,
            abantu.id as userId
            FROM imibuzo
            INNER JOIN abantu
            ON imibuzo.id_yomntu = abantu.id WHERE imibuzo.id = :id"
        );
        $this->db->bind(':id', $id);

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
    public function deleteUmbuzo($id)
    {
        $this->db->query("DELETE FROM imibuzo WHERE id = :id");
        $this->db->bind(':id', $id);
        echo $id;

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function phendulaUmbuzo($data)
    {
        $this->db->query(
            "INSERT INTO imibuzo_comments (
                id_yomntu,
                id_yombuzo,
                impendulo,
                date
            ) VALUE (
                :id_yomntu,
                :id_yombuzo,
                :impendulo,
                :date
            )"
        );
        $this->db->bind(':id_yomntu', $data['id_yomntu']);
        $this->db->bind(':id_yombuzo', $data['id']);
        $this->db->bind(':impendulo', $data['impendulo']);
        $this->db->bind(':date', date("Y-m-d H:i:s"));

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get impendulo yo Mbuzo
     */
    public function getImpenduloById($id)
    {
        $this->db->query(
            "SELECT *,
            imibuzo_comments.id_yombuzo as umbuzoId,
            abantu.id as userId,
            abantu.igama as igama_lomphenduli
            FROM imibuzo_comments
            INNER JOIN abantu
            ON imibuzo_comments.id_yomntu = abantu.id WHERE imibuzo_comments.id_yombuzo = :id
            ");
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();
        return $results;
    }
}
?>