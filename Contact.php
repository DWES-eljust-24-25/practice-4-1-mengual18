<?php

class Contact {
    private int $id;
    private string $title;
    private string $name;
    private string $surname;
    private string $birthdate;
    private string $phone;
    private string $email;
    private bool $favourite;
    private bool $important;
    private bool $archived;

    public function __construct(array $contactArray = [
        "id" => 0,
        "title" => "Mr.",
        "name" => "",
        "surname" => "",
        "birthdate" => "",
        "phone" => "",
        "email" => "",
        "favourite" => false,
        "important" => false,
        "archived" => false
    ]) {
        $this->id = $contactArray['id'];
        $this->title = $contactArray['title'];
        $this->name = $contactArray['name'];
        $this->surname = $contactArray['surname'];
        $this->birthdate = $contactArray['birthdate'];
        $this->phone = $contactArray['phone'];
        $this->email = $contactArray['email'];
        $this->favourite = $contactArray['favourite'];
        $this->important = $contactArray['important'];
        $this->archived = $contactArray['archived'];
    }

    // Métodos Getter
    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getBirthdate(): string {
        return $this->birthdate;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function isFavourite(): bool {
        return $this->favourite;
    }

    public function isImportant(): bool {
        return $this->important;
    }

    public function isArchived(): bool {
        return $this->archived;
    }

    // Método para validar los datos de contacto
    public function validate(): array {
        $errors = [];

        // Validar nombre
        if (empty($this->name)) {
            $errors['name'] = "* El nombre es requerido";
        }

        // Validar apellidos
        if (empty($this->surname)) {
            $errors['surname'] = "* Los apellidos son requeridos";
        }

        // Validar teléfono
        if (empty($this->phone)) {
            $errors['phone'] = "* El teléfono es requerido";
        } elseif (!preg_match("/^[0-9]{9,15}$/", $this->phone)) {
            $errors['phone'] = "* El teléfono debe ser un número válido";
        }

        // Validar email
        if (empty($this->email)) {
            $errors['email'] = "* El correo electrónico es requerido";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "* Formato de correo electrónico no válido";
        }

        // Validar fecha de nacimiento
        if (!$this->checkContactDate()) {
            $errors['birthdate'] = "* La fecha de nacimiento no es válida";
        }

        return $errors;
    }

    // Método para comprobar si la fecha de contacto es válida
    public function checkContactDate(): bool {
        $date = DateTime::createFromFormat('Y-m-d', $this->birthdate);
        return $date && $date->format('Y-m-d') === $this->birthdate;
    }

    // Método para calcular los días hasta el cumpleaños
    public function checkBirthday(): ?int {
        $today = new DateTime();
        $birthDate = new DateTime($this->birthdate);
        $nextBirthday = (clone $birthDate)->setDate($today->format('Y'), $birthDate->format('m'), $birthDate->format('d'));

        if ($nextBirthday < $today) {
            $nextBirthday->modify('+1 year');
        }

        return $today->diff($nextBirthday)->days;
    }

    // Método mágico __toString
    public function __toString(): string {
        return "ID: $this->id, Título: $this->title, Nombre: $this->name, Apellido: $this->surname, " .
               "Fecha de Nacimiento: $this->birthdate, Teléfono: $this->phone, Email: $this->email, " .
               "Favorita: " . ($this->favourite ? 'Sí' : 'No') . ", Importante: " . ($this->important ? 'Sí' : 'No') . ", " .
               "Archivado: " . ($this->archived ? 'Sí' : 'No');
    }
}
