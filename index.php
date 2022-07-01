<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Projeto Integrador</title>
</head>
<body>
<div class="wrapper">
        <div class="logo">
            <img src="./logopi.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            
        </div>
        <form class="p-3 mt-3" action="login.php" method="POST">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="userName" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button type="submit" class="btn mt-3">Login</button>
        </form>
        
    </div>
</body>
</html>