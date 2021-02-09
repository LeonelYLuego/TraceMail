<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
    <?php
        include "basedatos.php";
    ?>
    <div class="container-fluid p-0 m-0">

        <div class="col-2 shadow text-center bg-white fixed-top" style="z-index:1; height: 100vh; padding: 6rem 0 0 0">
            <form  action="qcontroller.php" method="POST">
                <button type="submit" class="section-btn all" name = "btn" value = "1">
                    <i class="fas fa-clipboard-list mr-3"></i>Todos<span class="count">0</span></button>
            
                <button type = "submit" class = "section-btn waiting" name="btn" value = "2">
                    <i class="fas fa-clock mr-3"></i>Pendientes<span class="count">0</span></button>
            
                <button type = "submit" class="section-btn approved" name="btn" value = "3">
                    <i class="fas fa-check-circle mr-3"></i>Aprobados<span class="count">0</span></button>
        
                <button type = "submit" class="section-btn rejected" name="btn" value = "4">
                    <i class="fas fa-times-circle mr-3"></i>Rechazados<span class="count">0</span></button>
            </form>
            <div class="position-absolute w-100 p-3" style="bottom: 0">
            <button id="specs-btn" class="btn btn-primary btn-block text-white circled">
                <i class="fas fa-user-plus"></i> &nbsp; Agregar Usuario</button> 
            <button id="specs-btn" class="btn btn-primary btn-block text-white circled">
                <i class="fas fa-file-upload"></i> &nbsp; Especificaciones</button> 
            <button id="test-btn" class="btn btn-light border btn-block circled">
                        Generar</button> 
            <button id="logout-btn" class="btn btn-light border btn-block circled">
                <i class="fas fa-arrow-left"></i> &nbsp; Salir </button> 
            </div>
        </div>

        <div id="topbar" class="row m-0 p-0">
            <div class="col-4 my-3">
                <img class="avatar" src="img/avatar.png">
                <div class="d-inline-block mx-3" style="vertical-align:middle;">
                    <h4 class="user">
                        <?php
                            $userName = DataBase::query("SELECT Names FROM users WHERE UserId = '". $_GET['userId'] ."';")->fetch_array()[0];
                            echo $userName;
                        ?>
                    </h4>
                    <h6 class="position text-muted">
                        <?php
                            $userPosition = DataBase::query("SELECT levels FROM users WHERE UserId = '". $_GET['userId'] ."';")->fetch_array()[0];
                            switch($userPosition){
                                case 1:
                                    echo 'Materia prima';
                                    break;
                                case 2:
                                    echo 'Jefe calidad';
                                    break;
                                case 3;
                                    echo 'Gestion calidad';
                                    break;
                                case 4:
                                    echo 'Direccion operaciones';
                                    break;
                                case 5:
                                    echo 'Compras';
                                    break;
                                case 6:
                                    echo 'Proveedor';
                                    break;
                                case 7:
                                    echo 'Admin';
                                    break;
                            }
                        ?>
                    </h6>
                </div>
            </div>
            <div class="col-6 text-center">
                <input type="text" id="search-bar" class="form-control circled w-75 d-inline-block mt-3" style="height: 3rem;" placeholder="Buscar especificaciones...">
                <i class="fas fa-search d-inline-block pt-2 ml-3" style="font-size:2rem;"></i>
            </div>
        </div> 

        <div class="container-fluid" style="margin-top:7rem">
            <div class="row">
                <div class="col-2"></div>
                <div id="mail-center" class="col-10 text-center" style="padding: 0 5rem">

                </div>
        </div>
             
        </div>
    </div>
    

    

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/main.js"></script>
    <script>


        var ColorList = {
            "all": "var(--info-light)",
            "waiting": "var(--warning-light)",
            "approved": "var(--success-light)",
            "rejected": "var(--danger-light)",
        }


        $(document).ready(function() {
            $(".section-btn").click(function(event) {
               
                var this2 = $(this);
                $(".section-btn").removeClass("active");
                $(this).addClass("active");

                colors = Object.keys(ColorList);
                

                colors.forEach(function(e, i){
                    console.log(this2.hasClass(colors[i]));
                    if(this2.hasClass(colors[i])) {
                        console.log("ahuevo sí jaló");
                        $("body").css("background-color", ColorList[e]);
                        
                    }

                });
                
            });
        });
            </script>
</body>
</html>