<?php

require_once __DIR__ . '/../config/database.php';

class Birthday
{
    private $conn;
    private $table_name = "birthdays";

    public $id_birthday;
    public $id_user_birthday;
    public $date_birthday;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Retrieve all birthday records from the table
    public function read()
    {
        $query = "SELECT id_birthday, id_user_birthday, date_birthday FROM " . $this->table_name;

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $exception) {
            // Handle errors
            echo "Error: " . $exception->getMessage();
            return false; // Indicate that the operation failed
        }
    }

    // Retrieve a specific birthday record by user ID
    public function getById($id_user_birthday)
    {
        $query = "SELECT id_birthday, id_user_birthday, date_birthday 
              FROM " . $this->table_name . " 
              WHERE id_user_birthday = :id_user_birthday";

        try {
            $stmt = $this->conn->prepare($query);

            // Bind the parameter
            $stmt->bindParam(':id_user_birthday', $id_user_birthday);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $exception) {
            // Handle errors
            echo "Error: " . $exception->getMessage();
            return false; // Indicate that the operation failed
        }
    }

    // Insert a new birthday record into the birthdays table
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET id_user_birthday=:id_user_birthday, date_birthday=:date_birthday";

        try {
            $stmt = $this->conn->prepare($query);

            // Clean data 
            $this->id_user_birthday = htmlspecialchars(strip_tags($this->id_user_birthday));
            $this->date_birthday = htmlspecialchars(strip_tags($this->date_birthday));

            // Bind parameters
            $stmt->bindParam(':id_user_birthday', $this->id_user_birthday);
            $stmt->bindParam(':date_birthday', $this->date_birthday);

            if ($stmt->execute()) {
                return true; // Indicate that the update was successful
            }

            return false; // Indicate that the update failed
        } catch (PDOException $exception) {
            // Handle errors 
            echo "Error: " . $exception->getMessage();
            return false; // Indicate that the operation failed
        }
    }

    // Modify only dates birthdays
    public function update($id_birthday, $birthdate)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET date_birthday = :date_birthday 
        WHERE id_birthday = :id_birthday";

        try {
            $stmt = $this->conn->prepare($query);

            // Clean data
            $birthdate = htmlspecialchars(strip_tags($birthdate));

            // Bind parameters
            $stmt->bindParam(':date_birthday', $birthdate);
            $stmt->bindParam(':id_birthday', $id_birthday);

            if ($stmt->execute()) {
                return true; // Indicate that the update was successful
            }

            return false; // Indicate that the update failed
        } catch (PDOException $exception) {
            // Handle errors 
            echo "Error: " . $exception->getMessage();
            return false; // Indicate that the operation failed
        }
    }

    // Delete a specific birthday record
    public function delete($id_birthday)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_birthday = :id_birthday";

        try {
            $stmt = $this->conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':id_birthday', $id_birthday);

            if ($stmt->execute()) {
                return true; // Indicate that the update was successful
            }

            return false; // Indicate that the update failed
        } catch (PDOException $exception) {
            // Handle errors
            echo "Error: " . $exception->getMessage();
            return false; // Indicate that the operation failed
        }
    }
}
