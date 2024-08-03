<?php

class BirthdayController
{

    private $db;
    private $birthday;

    public function __construct($db)
    {
        $this->db = $db;  // Stores the database connection in the controller's property
        $this->birthday = new Birthday($this->db);  // Creates an instance of the `Birthday` model using the database connection
    }

    public function index()
    {
        // Retrieve all birthday records from the model
        $stmt = $this->birthday->read();
        $num = $stmt->rowCount();

        // Check if there are any records
        if ($num > 0) {
            $birthdays_arr = array();
            $birthdays_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $birthday_item = array(
                    "id_birthday" => $id_birthday,
                    "id_user_birthday" => $id_user_birthday,
                    "date_birthday" => $date_birthday
                );

                array_push($birthdays_arr["records"], $birthday_item);
            }

            // Set response code - 200 OK
            http_response_code(200);

            // Show birthdays data in json format
            echo json_encode($birthdays_arr);
        } else {
            // Set response code - 404 Not Found
            http_response_code(404);

            // Tell the user no birthdays found
            echo json_encode(array("message" => "No birthdays found."));
        }
    }

    public function show($id_user_birthday)
    {
        // Retrieve a specific birthday record from the model
        $stmt = $this->birthday->getById($id_user_birthday);
        $num = $stmt->rowCount();

        // Check if record exists
        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $birthday_item = array(
                "id_birthday" => $id_birthday,
                "id_user_birthday" => $id_user_birthday,
                "date_birthday" => $date_birthday
            );

            // Set response code - 200 OK
            http_response_code(200);

            // Show birthday data in json format
            echo json_encode($birthday_item);
        } else {
            // Set response code - 404 Not Found
            http_response_code(404);

            // Tell the user birthday not found
            echo json_encode(array("message" => "Birthday not found."));
        }
    }

    // Create a new birthday record
    public function store()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_user_birthday) && !empty($data->birthdate)) {
            $this->birthday->id_user_birthday = $data->id_user_birthday;
            $this->birthday->date_birthday = $data->birthdate; // Change to date_birthday

            if ($this->birthday->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Birthday was created."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create birthday."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create birthday. Data is incomplete."));
        }
    }


    // Update a specific birthday record
    public function update($id_birthday)
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->birthdate)) {
            $this->birthday->id_birthday = $id_birthday;
            $this->birthday->date_birthday = $data->birthdate; // Change to date_birthday

            if ($this->birthday->update($id_birthday, $data->birthdate)) {
                http_response_code(200);
                echo json_encode(array("message" => "Birthday was updated."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to update birthday."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to update birthday. Data is incomplete."));
        }
    }


    // Delete a specific birthday record
    public function destroy($id_birthday)
    {

        // Delete the birthday record
        if ($this->birthday->delete($id_birthday)) {
            http_response_code(200);
            echo json_encode(array("message" => "Birthday was deleted."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to delete birthday."));
        }
    }
}
