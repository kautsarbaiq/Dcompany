<?php

global $connection;
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");

if (isset($_POST["login"])) {

    $notification = login($_POST);
    if ($notification) {
        header("Location: /auth/login.php?notification=" . urlencode($notification));
        exit;
    }
}

function login($data)
{
    session_start();
    $username = $data["username"];
    $password = $data["password"];

    $result = query("SELECT users.*, roles.name as role_name 
        FROM users 
        JOIN roles 
        ON users.role_id = roles.id
        WHERE username = '$username'
    ");


    if (count($result) > 0) {
        if (password_verify($password, $result[0]["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["name"] = $result[0]["name"];
            $_SESSION["user_id"] = $result[0]["id"];
            $_SESSION["username"] = $result[0]["username"];
            $_SESSION["role_name"] = $result[0]["role_name"];


            return "<script>
            Swal.fire({
                title: 'Success',
                text: 'Login successful!',
                icon: 'success'
            }).then((result) => {
                window.location.href = '/admin/index.php?page=dashboard';
            });
        </script>";
        } else {
            return "<script>
            Swal.fire({
                title: 'Error',
                text: 'Incorrect password',
                icon: 'error'
            }).then((result) => {
                window.location.href = '/auth/login.php';
            });
        </script>";
        }
    } else {

        return "<script>
        Swal.fire({
            title: 'Error',
            text: 'User not found',
            icon: 'error'
        }).then((result) => {
            window.location.href = '/auth/login.php';
        });
        </script>";
    }


    return null;

}

function logout()
{
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('id', '', time() - 3600);
    setcookie('key', '', time() - 3600);

    header("Location: /auth/login.php");
    exit;
}