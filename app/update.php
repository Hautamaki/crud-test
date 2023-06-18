<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
        echo 'error: no id found';
    }else {
        $stmt = $conn->prepare("UPDATE list(fname, lname) VALUES(?, ?)");

        $stmt->bindParam('fname', $fname);
        $stmt->bindParam('lname', $lname);
        
        $values = array($fname, $lname);

        $stmt->execute($values);
        $todos->execute([$id]);

        //$todo = $todos->fetch();
        //$uId = $todo['id'];
        //$newFname = $todo['fname'];


        //$res = $conn->query("UPDATE list SET fname=$newFname WHERE id=$uId");


        



        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}