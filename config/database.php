<?php
class Database {
private $host = "localhost";
private $db_name = "data_base_name";
private $username = "user";
private $password = "pass";
public $conn;

public function getConnection() {
$this->conn = null;

try {
$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
echo "Error: " . $exception->getMessage();
}

return $this->conn;
}
}
?>