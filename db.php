<?php
require_once("config.php");
session_start();
try{
    $conn = new mysqli($CONFIG['DB_HOST'], $CONFIG['DB_USER'], $CONFIG['DB_PASS'], $CONFIG['DB_NAME'], $CONFIG['DB_PORT']);
}catch(Exception $e){
    die("Database connection error: " . $e->getMessage());
}

class Encryptor {
    private $spliter = "$";
    private $key;
    public function __construct($key) {
        $this->key = $key;
    }
    private function generateSalt($length = 32) {
        return substr(md5(date('Y-m-d H:i:s') . rand(100, 1000).str_shuffle('abbcABBC1234ABBCDE')),0, $length);
    }
    public function encrypt($data) {
        $salt = $this->generateSalt(32);
        return $salt.$this->spliter.hash_hmac('sha256', $salt.$data, $this->key);
    }
    public function check($data, $hash) {
        $hash_split = explode($this->spliter, $hash);
        if(count($hash_split) != 2) return false;
        $salt = $hash_split[0];
        return hash_equals(hash_hmac('sha256', $salt.$data, $this->key), $hash_split[1]);
    }
}

try{
    $Encryptor = new Encryptor($CONFIG['ENCRYPTION_KEY']);
}catch(Exception $e){
    die("Encryption error: " . $e->getMessage());
}

?>