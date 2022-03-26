<?php

class User extends Database
{

    public function login($data)
    {
        try {
            if (!isset($data['username']) || !$data['username']) {
                throw new Exception('Need username to process!');
            }
            if (!isset($data['password']) || !$data['password']) {
                throw new Exception('Need password to process!');
            }

            $_SESSION['user'] = array();

            $sql_command = "
SELECT *
FROM `user`
WHERE 
 LOWER(`username`) = '" . $this->mysqli->real_escape_string(strtolower($data['username'])) . "' AND
 `password` = '" . $this->mysqli->real_escape_string($data['password']) . "'
LIMIT 1";
            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            if (!$query->num_rows) {
                throw new Exception('Invalid username or password!');
            }
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $_SESSION['user'] = $row;
                if (isset($data['remember']) && $data['remember']) {
                    setcookie('user_id', $row['user_id'], time() + (259200), "/"); // 86400 = 1 day
                }
            }

            return true;
        } catch (Exception $e) {
            file_put_contents(
                $_SERVER['DOCUMENT_ROOT'] . "/log/class." . get_class() . "." . __FUNCTION__ . ".txt",
                $e->getMessage()
            );
            return array('error' => $e->getMessage());
        }
        return false;
    }

    public function logout()
    {
        $_SESSION = array();
        $_COOKIE = array();

        setcookie('user_id', "", time() - 3600);
        setcookie('user_id', null, -1, '/');
        unset($_SESSION['user']);
        session_destroy();
    }

    public function authentication()
    {
        try {
            if (isset($_SESSION['user']['user_id'])) {
                return true;
            } else {
                if (isset($_COOKIE['user_id'])) {
                    $user_detail = $this->get_user_detail($_COOKIE['user_id']);
                    if (isset($user_detail['error'])) {
                        throw new Exception($user_detail['error']);
                    }
                    $_SESSION['user'] = $user_detail;

                    return true;
                }
            }

            $this->logout();
            header('Location: /meter/login.php');
        } catch (Exception $e) {
            file_put_contents(
                $_SERVER['DOCUMENT_ROOT'] . "/log/class." . get_class() . "." . __FUNCTION__ . ".txt",
                $e->getMessage()
            );
            return array('error' => $e->getMessage());
        }
        return false;
    }

    public function can($roles): bool
    {
        try {
            if (!isset($_SESSION['user']['role'])) {
                return false;
            }

            $auth_user_roles = json_decode($_SESSION['user']['role'], true, 512, JSON_THROW_ON_ERROR);

            if (is_string($roles) && in_array($roles, $auth_user_roles, true)) {
                return true;
            }

            if (is_array($roles)) {
                foreach ($roles as $role) {
                    if (in_array($role, $auth_user_roles, true)) {
                        return true;
                    }
                }
            }
        } catch (JsonException $e) {
            // silent is gold
        }

        return false;
    }

    protected function get_user_detail($user_id)
    {
        try {
            $sql_command = "SELECT * FROM `user` WHERE `user_id` = " . (int)$user_id . " LIMIT 1";
            $query = $this->mysqli->query($sql_command);
            if (!$query) {
                throw new Exception($this->mysqli->error);
            }
            if (!$query->num_rows) {
                throw new Exception('No user match to this user_id!');
            }
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                return $row;
            }
        } catch (Exception $e) {
            file_put_contents(
                $_SERVER['DOCUMENT_ROOT'] . "/log/class." . get_class() . "." . __FUNCTION__ . ".txt",
                $e->getMessage()
            );
            return array('error' => $e->getMessage());
        }
        return array('error' => 'Fail');
    }


    public function logoutAndRedirect() {
        $this->logout();
        header('Location: /meter/login.php');
        exit;
    }
}
