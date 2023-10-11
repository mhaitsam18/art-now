<?php

class Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function controller($controller)
    {
        require_once '../app/controllers/' . $controller . '.php';
        return new $controller;
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function route($url)
    {
        header("Location: ".BASEURL.'/'.$url);  
    }

    public function alert($message, $url)
    {
        if($url == null)
        {
            echo "<script>alert('".$message."');</script>";
        }
        else
        {
            echo "<script>alert('".$message."');window.location.href='".BASEURL.'/'.$url."';</script>";
        }
    }
}
