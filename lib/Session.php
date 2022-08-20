<?php

class Session
{

    public static function init()
    {
        session_start();
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    // Session Check for Faculty
    public static function checkSession()
    {
        if (self::get("login") == false) {
            self::destroy();
            header("Location:index.php");
        }
    }

    // Login Check for Faculty
    public static function checkLogin()
    {
        if (self::get("login") == true) {
            header("Location:dashboard.php");
        }
    }

    // Session Check for Student
    public static function stdCheckSession()
    {
        if (self::get("login") == false) {
            self::destroy();
            header("Location:index.php");
        }
    }

    // Login Check for Student
    public static function stdCheckLogin()
    {
        if (self::get("login") == true) {
            header("Location:student_dashboard.php");
        }
    }


    // Session Destroy
    public static function destroy()
    {
        session_destroy();
        session_unset();
    }
}
