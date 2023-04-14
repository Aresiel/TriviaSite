<?php

require_once "database.php";
class User {
    private string $username;
    private int $id;
    private string $email;
    private int $total_answers;
    private int $correct_answers;
    private string $answered_questions;

    private function __construct(string $username, int $id, string $email, int $total_answers, int $correct_answers, string $answered_questions)
    {
        $this->username = $username;
        $this->id = $id;
        $this->email = $email;
        $this->total_answers = $total_answers;
        $this->correct_answers = $correct_answers;
        $this->answered_questions = $answered_questions;
    }


    public static function userExistsByEmail(string $email): bool {
        $conn = Database::getConn();
        $existsStatement = $conn->prepare("SELECT COUNT(id) FROM users WHERE email = ?");
        $existsStatement->bind_param("s", $email);
        $existsStatement->execute();
        $result = $existsStatement->get_result();
        $data = $result->fetch_row();
        $userCount = $data[0];
        return $userCount > 0;
    }

    public static function userExistsById(int $id): bool {
        $conn = Database::getConn();
        $existsStatement = $conn->prepare("SELECT COUNT(id) FROM users WHERE id = ?");
        $existsStatement->bind_param("i", $id);
        $existsStatement->execute();
        $result = $existsStatement->get_result();
        $data = $result->fetch_row();
        $userCount = $data[0];
        return $userCount > 0;
    }

    public static function registerUser(string $username, string $email, string $password): User {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $conn = Database::getConn();
        //TODO: Implement the rest

    }

    public static function validUsername(string $username): bool {
        return !(preg_match("/^[a-zA-Z0-9_]{4,32}$/", $username) == false);
    }

    public static function validEmail(string $email): bool {
        return !(preg_match("/@/", $email) == false) && (strlen($email) < 256);
    }

    public static function validPassword(string $password): bool {
        return !(preg_match("/^.{8,256}$/", $password) == false);
    }
}