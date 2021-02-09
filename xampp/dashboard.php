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
    <?php include "basedatos.php";
    
    ?>
    <div class="container-fluid p-0 m-0">

        <div class="col-2 shadow text-center bg-white fixed-top" style="z-index:1; height: 100vh; padding: 6rem 0 0 0">
            
            <button class="section-btn all <?php if($_GET['level']==6){ echo 'unauthorized'; } ?>">
                <i class="fas fa-clipboard-list mr-3"></i>Todos<span class="count">0</span></button>
            <button class="section-btn waiting <?php if($_GET['level']==1||$_GET['level']==5||$_GET['level']==6){ echo 'unauthorized'; } ?>">
                <i class="fas fa-clock mr-3"></i>Pendientes<span class="count">0</span></button>
            <button class="section-btn approved">
                <i class="fas fa-check-circle mr-3"></i>Aprobados<span class="count">0</span></button>
            <button class="section-btn rejected <?php if($_GET['level']!=1 && $_GET['level']!=7){ echo 'unauthorized'; } ?>">
                <i class="fas fa-times-circle mr-3"></i>Rechazados<span class="count">0</span></button>
            

            <div class="position-absolute w-100 p-3" style="bottom: 0">
                <button id="specs-btn" class="btn btn-primary btn-block text-white circled <?php if($_GET['level']!=1 && $_GET['level']!=7){ echo 'unauthorized'; } ?>">
                    <i class="fas fa-file-upload"></i> &nbsp; Especificaciones</button> 
                
                <button id="logout-btn" onclick="exitPage()" class="btn btn-light border btn-block circled">
                    <i class="fas fa-arrow-left"></i> &nbsp; Salir </button> 
            </div>
        </div>

        <div id="topbar" class="row m-0 p-0">
            <div class="col-4 my-3">
                <img class="avatar" src="img/avatar.png">
                <div class="d-inline-block mx-3" style="vertical-align:middle;">
                    <h4 class="user"> <?php
                            $userName = DataBase::query("SELECT Names FROM users WHERE UserId = '". $_GET['userId'] ."';")->fetch_array()[0];
                            echo $userName;
                        ?></h6></h4>
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
                </div>
            </div>
            <div class="col-6 text-center">
                <input type="text" id="search-bar" class="form-control circled w-75 d-inline-block mt-3" style="height: 3rem;" placeholder="Buscar especificaciones...">
                <button class="fas btn btn-primary fa-search d-inline-block mb-2 ml-3 circled" style="font-size:3rem;"></button>
            </div>
            <div class="col-2 text-center">
                <img src="img/tracemail-imagetype.png" style="height: 5rem; padding: 1rem;">
            </div>
        </div> 


        <div class="container-fluid mx-0 p-0" style="margin-top: 6rem;">
            <div class="row p-0 m-0">
                <div class="col-2 p-0 m-0"></div>
                <div id="mail-center" class="col-10 text-center" style="padding: 0 5rem; ">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog w-100 h-100" style="max-width: 70vw; max-height: 90vh;">
            <div class="modal-content h-100" style="border-radius: 1.5rem;">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileTitle">777777777</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <iframe src="Tareas.pdf" frameborder="0" class="w-100 h-100"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary circled" data-dismiss="modal"><i class="fas fa-undo-alt mr-2"></i>Regresar a <b>Materia Prima</b></button>
                    <button type="button" class="btn btn-primary circled"><i class="fas fa-paper-plane mr-2"></i>Enviar a <b>Control de Calidad</b></button>
                </div>
            </div>
        </div>
    </div>

        

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/main.js"></script>
    <script>

        function exitPage() {
            window.location.replace("login.php");
        }

        var ColorList = {
            "all": "var(--info-light)",
            "waiting": "var(--warning-light)",
            "approved": "var(--success-light)",
            "rejected": "var(--danger-light)",
        }


        function generateDocView(docId, specId, version, date, authLevel){
            var status = "Esperando...";
            var icon = "<i class='fas fa-hourglass-half mx-2'></i>";
            var color = "<div class='bg-warning'>";
            var row = "<div class='row'></div>";
            var doc = "<button class='specs-card col' data-toggle='modal' data-target='#exampleModal'><span>"+date.substring(0, 10)+"</span><span>"+docId+": </span><span>"+specId+"</span><span>REVISIÓN: "+version+"</span>";
            switch(authLevel) {
                case 0: status = "Documento devuelto para <b>revisión</b>"; icon = "<i class='fas fa-undo-alt mx-2'></i>"; color = "<div class='bg-danger'>"; break;
                case 1: status = "<b>Esperando</b> al Jefe de calidad"; break;
                case 2: status = "<b>Esperando a</b> la Gestión de Calidad"; break;
                case 3: status = "<b>Esperando</b> a la Dirección de Operación"; break;
                default: status = "Documento <b>aprobado</b>"; icon = "<i class='fas fa-thumbs-up mx-2'></i>"; color = "<div class='bg-success'>";
            }
            doc += color + /*icon +*/ status + "</div></button>";
            $("#mail-center").find(".row").last().append(doc);
        }

    

        $(document).ready(function() {
            $(".section-btn").click(function(event) {
                var this2 = $(this);
                $(".section-btn").removeClass("active");
                $(this).addClass("active");
                colors = Object.keys(ColorList);
                colors.forEach(function(e, i){
                    if(this2.hasClass(colors[i])) {
                        $("body").css("background-color", ColorList[e]);
                        $("#mail-center").html(" ");
                        $("#mail-center").append("<div class='row'></div>");

                        <?php
                        $queries = array(
                            "SELECT DocId, Specification, Revision, Dates, Levels FROM Documents ORDER BY Dates DESC",
                            "SELECT DocId, Specification, Revision, Dates, Levels FROM Documents WHERE Levels = (SELECT Levels - 1 FROM Users WHERE UserId = 'Jefe calidad') ORDER BY Dates DESC",
                            "SELECT DocId, Specification, Revision, Dates, Levels FROM Documents WHERE Levels >= 4 ORDER BY Dates DESC",
                            "SELECT d.DocId, d.Specification, d.Revision, d.Dates, d.Levels FROM Documents as d INNER JOIN Rejected as r on d.DocId = r.DocId ORDER BY d.Dates DESC"
                        );
                        ?>

                        if(i==0) {
                            <?php 
                            $query1 = DataBase::query($queries[0]);
                            $counter = 0;
                            while($row = $query1->fetch_array()) {
                                $counter = $counter + 1;
                                if($counter % 3 == 0) 
                                    echo "$('#mail-center').append('<div class=row></div>');";
                                echo "generateDocView(".$row['DocId'].",'".$row['Specification']."',".$row['Revision'].",'".$row['Dates']."',".$row['Levels'].");";
                            } ?>
                        }
                        else if(i==1){
                            <?php 
                            $query2 = DataBase::query($queries[1]);
                            $counter = 0;
                            while($row = $query2->fetch_array()) {
                                $counter = $counter + 1;
                                if($counter % 3 == 0) 
                                    echo "$('#mail-center').append('<div class=row></div>');";
                                echo "generateDocView(".$row['DocId'].",'".$row['Specification']."',".$row['Revision'].",'".$row['Dates']."',".$row['Levels'].");";
                            } ?>
                        }

                        else if(i==2){
                            <?php 
                            $query3 = DataBase::query($queries[2]);
                            $counter = 0;
                            while($row = $query3->fetch_array()) {
                                $counter = $counter + 1;
                                if($counter % 3 == 0) 
                                    echo "$('#mail-center').append('<div class=row></div>');";
                                echo "generateDocView(".$row['DocId'].",'".$row['Specification']."',".$row['Revision'].",'".$row['Dates']."',".$row['Levels'].");";
                            } ?>
                        }

                        else if(i==3){
                            <?php 
                            $query4 = DataBase::query($queries[3]);
                            $counter = 0;
                            while($row = $query4->fetch_array()) {
                                $counter = $counter + 1;
                                if($counter % 3 == 0) 
                                    echo "$('#mail-center').append('<div class=row></div>');";
                                echo "generateDocView(".$row['DocId'].",'".$row['Specification']."',".$row['Revision'].",'".$row['Dates']."',".$row['Levels'].");";
                            } ?>
                        }


                        <?php
                            
                            
                        ?>
                    }
                });                        
                                
            });
        });





            </script>
            
</body>
</html>