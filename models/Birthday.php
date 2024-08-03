<?php

class Birthday {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        // Lógica para obtener todos los registros de cumpleaños
    }

    public function getById($id) {
        // Lógica para obtener un registro de cumpleaños por ID
    }

    public function create($data) {
        // Lógica para crear un nuevo registro de cumpleaños
    }

    public function update($id, $data) {
        // Lógica para actualizar un registro de cumpleaños
    }

    public function delete($id) {
        // Lógica para eliminar un registro de cumpleaños
    }
}