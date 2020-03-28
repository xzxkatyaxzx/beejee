<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="utf-8">
        <title>testtask</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Список задач</a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php?action=add">Добавить задачу</a></li>
                        <li><a href="index.php?action=<?php if(isset($_SESSION["session_username"])){ echo 'logout'; }else { echo 'login'; } ?>"><?php if(isset($_SESSION["session_username"])){ echo 'Выход'; }else { echo 'Вход'; } ?></a></li>
                    </ul>
                </div>
            </nav>

            <!-- sorting -->

            <form method="get" action="index.php" id="form">

                <select class="form-control" name="sorting" style="display: inline-block; width: auto">
                    <?php foreach ($sort as $option): ?>
                        <option value='<?=$option?>'><?=$option?></option>
                    <?php endforeach; ?>

                </select>

                <input type="submit" value="Сортировать" class="btn" id="form">
            </form>

            <br>

            <form method="get" action="index.php" id="form">
                <input type="submit" value="Отменить сортировку" class="btn" id="form" >
            </form>

            <!-- end sorting -->

            <br>

            <!-- task table -->

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>mail</th>
                    <th>Текст</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($result as $task): ?>
                    <tr>
                    <td><?=$task['IDtask']?></td>
                    <td><?=$task['name']?></td>
                    <td><?=$task['mail']?></td>
                    <td><?=$task['text']?></td>
                    <td>
                        <?php if($task['performed'] == '1'){ ?>Выполнено<?php } ?>
                    </td>
                    <td>
                        <?php if($task['edited'] == '1'){ ?>Отредактировано<?php } ?>
                    </td>
                    <td>
                        <?php if(isset($_SESSION["session_username"])){ ?><a href="index.php?action=edit&IDtask=<?=$task['IDtask']?>">Редактировать</a> <?php } ?>
                    </td>
                    </tr>
                <?php endforeach ?>`
            </table>

            <!-- end task table -->

            <!-- pagination -->

            <?php
            echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;
            ?>

            <!-- end pagination -->

            <br>

            <!-- success message -->

            <?php if(isset($_GET['success']))
            {
                if($_GET['success'] == 'add') {
                    echo '<p>Задача добавлена.</p>';
                }
                else if($_GET['success'] == 'edit') {
                    echo '<p>Задача отредактирована.</p>';
                }
                else {
                    echo '<p>Успешный вход.</p>';
                }
            }
            ?>

            <!-- end success message -->

        </div>
    </body>
</hmtl>