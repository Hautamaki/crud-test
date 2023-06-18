<?php 

if(isset($_POST['fname'])){
    require '../db_conn.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    
    if(empty($fname)){
        header("Location: ../index.php?mess=error");
    }else {

        //Now this WORKS, I'm not sure how exactly but it works!
        // It takes both title and description and puts them both into 
        // the same row in database!
        // I understand prepare sql line, but not the rest really
        $stmt = $conn->prepare("INSERT INTO list(fname, lname) VALUES(?, ?)");

        $stmt->bindParam('fname', $fname);
        $stmt->bindParam('lname', $lname);
        

        $values = array($fname, $lname);

        $stmt->execute($values);

        if($stmt){
            header("Location: ../index.php?mess=success");
        }else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}


?>