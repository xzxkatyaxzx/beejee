<?php
    function tasks_all($link){
        $query = "SELECT * FROM tasks";
        $result = mysqli_query($link, $query);
        
        if(!$result)
            die(mysqli_error($link));
        
        $n = mysqli_num_rows($result);
        $tasks = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $tasks[] = $row;
        }

        return $tasks;
    }

    function tasks_sorted($link, $field, $order){
        $query = "SELECT * FROM tasks ORDER by " . $field . " ". $order;
        $result = mysqli_query($link, $query);

        if(!$result)
            die(mysqli_error($link));

        $n = mysqli_num_rows($result);
        $tasks = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $tasks[] = $row;
        }

        return $tasks;
    }

    function tasks_new($link, $name, $mail, $text){
        $template_add = "INSERT INTO tasks (name, mail, text) VALUES ('%s', '%s', '%s')";
        
        $query = sprintf($template_add, $name, $mail, $text);
        
        $result = mysqli_query($link, $query);
        
        if (!$result)
            die(mysqli_error($link));
        
        return true;
    }

    function tasks_edit($link, $IDtask, $name, $mail, $text, $performed, $edited){

        $template_add = "UPDATE tasks SET name='%s', mail='%s', text='%s', performed='%s', edited='%s' WHERE IDtask='%s'";

        $query = sprintf($template_add, $name, $mail, $text, $performed, $edited, $IDtask);

        $result = mysqli_query($link, $query);
        
        if (!result)
            die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }

    function task_get($link, $IDtask){
        $query = sprintf("SELECT * FROM tasks WHERE IDtask='%s'", (int)$IDtask);
        $result = mysqli_query($link, $query);
        
        if (!$result)
            die(mysqli_error($link));
        
        $task = mysqli_fetch_assoc($result);
        
        return $task;
    }

    function task_gett($link, $IDtask){
        $query = sprintf("SELECT * FROM tasks WHERE tasks.IDtask = '%s'", (int)$IDtask);
        $result = mysqli_query($link, $query);
        
        if (!$result)
            die(mysqli_error($link));
        
        $task = mysqli_fetch_assoc($result);
        
        return $task;
    }

    function task_delete($link, $IDtask){
        $IDtask = (int)$IDtask;
        
        $query = sprintf("DELETE FROM tasks WHERE IDtask='%s'", $IDtask);
        $result = mysqli_query($link, $query);
        
        if (!result)
            die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }

?>