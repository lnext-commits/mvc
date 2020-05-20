<?php
namespace controllers;

class Logout
{
    public function index($pr = '')
    {
       unset($_SESSION['id']);
       header("location: /");
    }
}
