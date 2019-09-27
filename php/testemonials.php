<html lang="en">
    <head>
        <title>Testemonials</title>
        <link href="../css/portfoliostyle.css" rel="stylesheet">
    </head>
    <body>
    <header>
            <h1>Luis Ramirez</h1>
            <nav>
                <a href="../html/index.html">Home</a>
                <a href="../html/interests.html">Interests</a>
                <a href="../html/projects.html">Projects</a>
                <a href="../html/resume.html">Resume</a>
                <a href="http://www.luisr.sgedu.site/portfolio/php/testemonials.php" class="active">Testemonials</a>
            </nav>
    </header>
    <main>
<?php

require_once("mysql_connect.php");

$query = "SELECT name, comments FROM testemonials"; 
$response = $conn->query($query);

if($response->num_rows > 0) {
    echo "<h2>Here is what people have to say about me!</h2><br>";
    while($row = $response->fetch_assoc()) {
        echo "<p>\"{$row['comments']}\"</p><h4>{$row['name']}</h4><hr class='hrwhite'>";
    }
} else {
    echo "Be the first to write a testemonial!"; 

}

$conn->close();

?>
        <br>
        <button type="button" class="blueBorderButton" onclick="location.href='http://www.luisr.sgedu.site/portfolio/php/addTestemonial.php'">Add one!</button>
        <br>
    </main>
    <hr>
    <footer>
        <p>Copyright &copy; Luis Ramirez</p>
    </footer>
</body>
</html>