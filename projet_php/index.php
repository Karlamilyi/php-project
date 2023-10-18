<?php
require 'controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: index.php');
    exit;
}

include 'view.php';