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
                </div>
            </nav> 

            <div>
                <form method="post" action="index.php?action=<?=$_GET['action']?>" style="max-width: 50%; margin: auto; text-align: center">
                    <input type="numeric" name="IDtask" value="<?=$task['IDtask']?>" hidden>
                    <input type="text" name="feedback" value="<?=$_GET['action']?>" hidden>

                    <h1>
                        <?php
                        if($_GET['action'] == 'add') {
                            echo 'Добавить задачу';
                        }
                        else {
                            echo 'Изменить задачу';
                        }
                        ?>
                    </h1>

                    <label for="name">
                       Имя:
                    </label>
                        <input class="form-control" type="text" name="name" value="<?=$task['name']?>" required>
                    <label for="mail">
                        Mail:
                    </label>
                        <input class="form-control" type="email" name="mail" value="<?=$task['mail']?>" required>
                    <label for="text">
                        Текст:
                    </label>
                        <input class="form-control" type="text" name="text" value="<?=$task['text']?>" required>
                    <?php if(isset($_SESSION["session_username"]) && $_GET['action']=='edit') { ?>
                        <label for="performed">
                            Выполнено:
                        </label>
                        <input type="checkbox" name="performed" <?php if($task['performed'] == '1') { echo 'checked'; } ?>>
                    <?php } ?>
                    <br>
                    
                    <input type="submit" value="Сохранить" class="btn">
                </form>

            </div>
        </div>
    </body>
</hmtl>