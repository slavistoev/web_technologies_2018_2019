<?php

class Pixel {
    private $id;
    private $empty;
    private $img;
    private $link;
    private $owner;
    private $text;

    private $db;
    private $pdo;

    public function __construct($id, $empty = 1, $img = '', $link = '', $owner = '', $text = '') {
        $this->id = $id;
        $this->empty = $empty;
        $this->img = $img;
        $this->link = $link;
        $this->owner = $owner;
        $this->text = $text;

        try {
            $this->db = new Database;
            $this->pdo = $this->db->connect();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function selectPixel() {
        $sql = "SELECT * FROM grid WHERE id='$this->id'";
        $query = $this->pdo->query($sql);

        $query ->setFetchMode(PDO::FETCH_ASSOC);
        $pixel = $query->fetch();

        if ($pixel) {
            $this->empty = $pixel['empty'];
            $this->img = $pixel['img'];
            $this->link = $pixel['link'];
            $this->owner = $pixel['owner'];
            $this->text = $pixel['text'];

            return array("success" => true);
        } else {
            return array("success" => false, "error" => "Unable to find pixel.");
        }
    }

    public function isEmpty() {
        return $this->empty;
    }

    public function getLink() {
        return $this->link;
    }

    public function getImg() {
        return $this->img;
    }

    public function getText() {
        return $this->text;
    }

    public function updatePixel($img, $link, $owner, $text) {
        $this->img = $img;
        $this->link = $link;
        $this->owner = $owner;
        $this->text = $text;

        $sql = "UPDATE grid SET empty=0, link='$link', text='$text', owner='$owner', img='$img' WHERE id='$this->id'";
        $query = $this->pdo->query($sql);
        if ($query) {
            return array("success" => true);
        } else {
            return array("success" => false, "error" => "Unable to update pixel.");
        }
    }

    public static function getAllPixels() {
        try {
            $db = new Database;
            $pdo = $db->connect();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }

        $sql = 'SELECT * FROM grid';
        $query = $pdo->query($sql);
        if ($query) {
            return array("success" => true, "pixels" => $query);
        } else {
            return array("success" => false, "error" => "Unable to get pixels.");
        }

        $db->closeConnection($pdo);
    }

    public function deletePixel() {
        $sql = "UPDATE grid SET empty=1, link='NULL', text='NULL', owner='NULL', img='NULL' WHERE id='$this->id'";
        $query = $this->pdo->query($sql);

        if ($query) {
            return array("success" => true);
        } else {
            return array("success" => false, "error" => "Unable to delete pixel.");
        }
    }

    function __destruct() {
        $this->db->closeConnection($this->pdo);
    }
    
}