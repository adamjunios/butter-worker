<?php
class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "adwork";
    public $kon;
    public function Konek(){
        $this->kon = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->kon->connect_error) {
            die("Koneksi gagal". $this->$konek->connect_error);
        }
        return $this->kon;
    }    
}    
?>