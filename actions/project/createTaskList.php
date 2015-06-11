<?php 
include_once('../../config/init.php');
include_once($BASE_DIR .'database/project.php');

if(!isset($_SESSION['username'])){
    header("Location: $BASE_URL" . 'pages/users/index.php');
 }

if (!isset($_POST['TLName'])) {
    $_SESSION['error_messages'][] = 'Expected project name';
    $_SESSION['form_values'] = $_POST;
    header("Location: $BASE_URL" . 'pages/users/profile.php');
    exit;
}

if(isset($_POST['task_date']))
	createTaskList($_GET['name'],$_POST['TLName'], $_POST['task_date']);
else
	createTaskList($_GET['name'],$_POST['TLName'], NULL);
header("Location: $BASE_URL" . 'pages/projects/projects.php?name=' . $_GET['name']);

?>