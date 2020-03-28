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
            <form name="loginform" id="loginform" action="" method="POST" style="max-width: 50%; margin: auto; text-align: center">

                <h1>Login</h1>
                
                <label for="user_login">Имя</label>
                    <input class="form-control" type="text" name="username"
                           value="<?php if(isset($_POST['username'])) echo (''.$_POST['username']);?>"/>

                <label for="user_pass">Пароль</label>
                    <input class="form-control" type="password" name="password"
                           value="<?php if(isset($_POST['password'])) echo (''.$_POST['password']);?>"/>

                <input class="btn" type="submit" name="login" value="Log in" />

            </form>

            <?php if (!empty($message)) {echo "<p class=\"error\">" . "MESSAGE: ". $message . "</p>";} ?>
        </div>
    </div>
    </body>
</hmtl>