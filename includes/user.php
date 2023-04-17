<?php

require_once "database.php";

class User
{
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


    public static function userExistsByEmail(string $email): bool
    {
        $conn = Database::getConn();
        $existsStatement = $conn->prepare("SELECT COUNT(id) FROM users WHERE email = ?");
        $existsStatement->bind_param("s", $email);
        $existsStatement->execute();
        $result = $existsStatement->get_result();
        $data = $result->fetch_row();
        $userCount = $data[0];
        return $userCount > 0;
    }

    public static function userExistsById(int $id): bool
    {
        $conn = Database::getConn();
        $existsStatement = $conn->prepare("SELECT COUNT(id) FROM users WHERE id = ?");
        $existsStatement->bind_param("i", $id);
        $existsStatement->execute();
        $result = $existsStatement->get_result();
        $data = $result->fetch_row();
        $userCount = $data[0];
        $existsStatement->close();
        return $userCount > 0;
    }

    public static function getUserById(int $id): User
    {
        $conn = Database::getConn();
        $getUserStatement = $conn->prepare("SELECT username, email, id, total_answers, correct_answers, answered_questions FROM users WHERE id = ?");
        $getUserStatement->bind_param("i", $id);
        $getUserStatement->execute();
        $result = $getUserStatement->get_result();
        $data = $result->fetch_assoc();
        $user = new User($data['username'], $data['id'], $data['email'], $data['total_answers'], $data['correct_answers'], $data['answered_questions']);
        $getUserStatement->close();

        return $user;
    }

    public static function loginUser(string $email, string $password): User | false
    {
        $conn = Database::getConn();
        $getUserStatement = $conn->prepare("SELECT username, password, email, id, total_answers, correct_answers, answered_questions FROM users WHERE email = ?");
        $getUserStatement->bind_param("s", $email);
        $getUserStatement->execute();
        $result = $getUserStatement->get_result();
        $data = $result->fetch_assoc();

        if (!password_verify($password, $data['password'])){
            return false;
        }

        $user = new User($data['username'], $data['id'], $data['email'], $data['total_answers'], $data['correct_answers'], $data['answered_questions']);
        $getUserStatement->close();

        return $user;
    }

    public static function registerUser(string $username, string $email, string $password): User
    {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $conn = Database::getConn();
        $registerStatement = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $registerStatement->bind_param("sss", $username, $email, $password_hash);
        $registerStatement->execute();
        $user_id = $registerStatement->insert_id;

        return self::getUserById($user_id);

    }


    public static function validUsername(string $username): bool
    {
        return !(preg_match("/^[a-zA-Z0-9_]{4,32}$/", $username) == false);
    }

    public static function validEmail(string $email): bool
    {
        //return !!filter_var($email, FILTER_VALIDATE_EMAIL);
        return !(preg_match("/@/", $email) == false) && (strlen($email) < 256);
    }

    public static function validPassword(string $password): bool
    {
        return !(preg_match("/^.{8,256}$/", $password) == false);
    }
}