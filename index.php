<?php
    session_start();

    require_once("database.php");
    require_once("models/functions.php");
    
    $link = db_connect();
    $tasks = tasks_all($link);

    $task['name']='';
    $task['mail']='';
    $task['text']='';
    $task['performed']='';
    $task['edited']='';

    $sort = ["name asc", "name desc", "mail asc", "mail desc", "text asc", "text desc"];

    if(isset($_GET['action']))
        $action = $_GET['action'];
    else
        $action = "";

    if($action == "add"){
        if(!empty($_POST)){
            $trueadd = tasks_new($link, $_POST['name'], $_POST['mail'], $_POST['text']);
            header("Location: index.php?success=add");
        }
        include("views/task_add.php");
    }
    else if($action == 'edit') {
        if (isset($_SESSION["session_username"])) {
            if (!isset($_GET['IDtask']))
                header('Location: index.php');

            $IDtask = (int)$_GET['IDtask'];

            if (!empty($_POST)) {

                if(isset($_POST['performed']) == true) {
                    $performed = '1';
                }
                else {
                    $performed = '0';
                }

                $task = task_get($link, (int)$_POST['IDtask']);
                $edited = $_POST['edited'];
                if($edited == false) {
                    $edited = '0';
                }
                if($task['text'] != $_POST['text']) {
                    $edited = '1';
                }

                $trueedit = tasks_edit($link, $_POST['IDtask'], $_POST['name'], $_POST['mail'], $_POST['text'], $performed, $edited);
                header("Location: index.php?success=edit");
            }

            $task = task_get($link, $IDtask);

            include("views/task_add.php");

        }
        else {
            header("Location: index.php?action=login");
        }

    }
    else if($action == 'delete'){
        $IDtask = (int)$_GET['IDtask'];
        $task = task_delete($link, $IDtask);
        header('Location: index.php');
    }
    else if($action == 'login'){

        if(isset($_POST["login"])){

            if(!empty($_POST['username']) && !empty($_POST['password'])) {

                $username = htmlentities(mysqli_real_escape_string($link, $_POST['username']));
                $password = htmlentities(mysqli_real_escape_string($link, $_POST['password']));

                $query=mysqli_query($link,"SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."'");

                $numrows=mysqli_num_rows($query);

                if($numrows!=0)
                {
                    $_SESSION['session_username']=$username;
                    header("Location: index.php?success=login");
                }
                else {
                    $message =  "Неверное имя или пароль";
                }

            }
            else {
                $message = "Заполните все поля";
            }
        }
        include("views/login.php");
    }
    else if($action == 'logout'){
        unset($_SESSION['session_username']);
        session_destroy();
        header("Location: index.php");
    }
    else{
        if(isset($_GET['sorting']))
        {
            $sorting = explode(" ",$_GET['sorting']);
        }
        else
        {
            $sorting = explode(" ","name asc");
        }

        $tasks = tasks_sorted($link, $sorting[0], $sorting[1]);

        /* for pagination */

        $perpage = 3;
        $total = intval(ceil(count($tasks) / $perpage));
        $page = $_GET['page'];
        if(empty($page) or $page < 0) {
            $page = 1;
        }
        if($page > $total) {
            $page = $total;
        }
        $start = $page * $perpage - $perpage;
        $result = array();
        array_push($result, $tasks[$start]);
        if($tasks[$start+1]['IDtask']) {
            array_push($result, $tasks[$start+1]);
        }
        if($tasks[$start+2]['IDtask']) {
            array_push($result, $tasks[$start+2]);
        }

        if(isset($_GET['sorting'])) {
            $urlpart = '/index.php?sorting=' . str_replace(' ', '+', $_GET['sorting']) . '&';
        }
        else {
            $urlpart = '/index.php?';
        }
        
        if ($page != 1) { $pervpage = '<a href= ' . $urlpart . 'page=1><<</a>  <a href= ' . $urlpart . 'page='. ($page - 1) .'><</a> '; }
        if ($page != $total) { $nextpage = ' <a href= ' . $urlpart . 'page='. ($page + 1) .'>></a> <a href= ' . $urlpart . 'page=' .$total. '>>></a>'; }
        if ($page - 2 > 0) { $page2left = ' <a href= ' . $urlpart . 'page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; }
        if ($page - 1 > 0) { $page1left = '<a href= ' . $urlpart . 'page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; }
        if ($page + 2 <= $total) { $page2right = ' | <a href= ' . $urlpart . 'page='. ($page + 2) .'>'. ($page + 2) .'</a>'; }
        if ($page + 1 <= $total) { $page1right = ' | <a href= ' . $urlpart . 'page='. ($page + 1) .'>'. ($page + 1) .'</a>'; }

        /* end for pagination */

        include("views/tasks.php");

        $feedback = '';
    }
?>