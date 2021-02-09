<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
    
    .vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */
  display: flex;
  align-items: center;
}
    
    </style>

</head>
<body>
    <div class="vertical-center">
        <div class="card mx-auto w-25">
            <form class="card-body text-center" action="login_controller.php" method="POST">
                <h5 class="card-title">Acceder a TraceMail</h5>
                <input type="text" class="form-control my-4" name="userId" placeholder="ID Usuario">
                <input type="password" class="form-control my-4" name="userPass" placeholder="Contraseña">
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/fontawesome.min.js"></script>
</body>
</html>