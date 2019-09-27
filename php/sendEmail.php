<?php   
    $post_email = $_POST["email"];
    require_once("mysql_connect.php");
    $statement = $conn->prepare("INSERT INTO contact (email) 
                VALUES (?)");
    $statement->bind_param("s", $post_email);
    $statement->execute();
    $statement->close();
    $conn->close();
    header("Location: http://www.luisr.sgedu.site/portfolio/html/index.html");
?>