<?php

	include 'data_base.php';
    
    $id = $_POST['userid']
    $admin = $_POST['admin']
    $consulta = sprintf("SELECT Pass FROM users WHERE pass = '$admin'");
    $consulta == $admin ? header("Location: ../main.php?userid=".$id) : header("Refresh:0");
    // página destino
    $id = $_GET["userid"];
    // fin pagina destino

    $consulta2 = sprintf("SELECT DocId, Specification, Revision, Levels FROM documents");
    $consulta3 = sprintf("SELECT DocId, Specification, Revision, Levels FROM documents WHERE Level = '0' ");
    $consulta4 = sprintf("SELECT DocId, Specification, Revision, Levels FROM documents ORDER BY Specification");
    $consulta5 = sprintf("SELECT DocId, Specification, Revision, Levels FROM documents ORDER BY Revision");
    $consulta6 = sprintf("SELECT DocId, Specification, Revision, Levels FROM documents ORDER BY Levels");
    $consulta7 = sprintf("SELECT DocId, Specification, Revision, Levels FROM documents WHERE Specification LIKE '%371%'");
    $consulta8 = sprintf("INSERT INTO Documents(DocId, Specification, Revision, Date, Provider, Addres, Levels) VALUES (null, 'ASDFGH', '36', '2019-01-01 08:08:08', 'Proovedor', 'C:\\Documents', '0')");
    $consulta9 = sprintf("INSERT INTO Rejected(RejectId, DocId, Levels, Comments) VALUES (null, 1, 3, 'Le falto más box')");
    $consulta10 = sprintf("SELECT Addres FROM Documents WHERE DocId = '1'");
    $consulta11 = sprintf("SELECT COUNT(*) FROM Documents WHERE Levels = '0'");
?>