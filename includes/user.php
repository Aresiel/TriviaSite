<?php

require_once "database.php";

class User
{
    public string $username;
    public int $id;
    public string $email;
    public int $total_answers;
    public int $correct_answers;

    private function __construct(string $username, int $id, string $email, int $total_answers, int $correct_answers)
    {
        $this->username = $username;
        $this->id = $id;
        $this->email = $email;
        $this->total_answers = $total_answers;
        $this->correct_answers = $correct_answers;
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
        $getUserStatement = $conn->prepare("SELECT username, email, id, total_answers, correct_answers FROM users WHERE id = ?");
        $getUserStatement->bind_param("i", $id);
        $getUserStatement->execute();
        $result = $getUserStatement->get_result();
        $data = $result->fetch_assoc();
        $user = new User($data['username'], $data['id'], $data['email'], $data['total_answers'], $data['correct_answers']);
        $getUserStatement->close();

        return $user;
    }

    public static function loginUser(string $email, string $password): User | false
    {
        $conn = Database::getConn();
        $getUserStatement = $conn->prepare("SELECT username, password, email, id, total_answers, correct_answers FROM users WHERE email = ?");
        $getUserStatement->bind_param("s", $email);
        $getUserStatement->execute();
        $result = $getUserStatement->get_result();
        $data = $result->fetch_assoc();

        if (!password_verify($password, $data['password'])){
            return false;
        }

        $user = new User($data['username'], $data['id'], $data['email'], $data['total_answers'], $data['correct_answers']);
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

    public function updateQuestions(bool $correct): void {

        $correct_increment = (int)$correct; // This is required as "only variables may be passed as reference" in bind_param, and apparently (int)$correct isn't a variable (due to the type casting) and hence cannot be put there

        $conn = Database::getConn();
        $updateStatement = $conn->prepare("UPDATE users SET total_answers = total_answers + 1, correct_answers = correct_answers + ? WHERE id = ?");
        $updateStatement->bind_param("ii", $correct_increment, $this->id);
        $updateStatement->execute();
        $updateStatement->close();
    }

    public function updateSession(): void {
        $user = $this::getUserById($this->id);
        $_SESSION['user'] = $user->serializeUser();
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

    public function serializeUser(): string {
        return serialize($this);
    }

    public static function unserializeUser(string $serializedUser): User {
        $userObj = unserialize($serializedUser); // Needed to store in $_SESSION since auto init session prevents the class from being loaded at session init
        return new User($userObj->username, $userObj->id, $userObj->email, $userObj->total_answers, $userObj->correct_answers);
}
}