<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Testemonial</title>
        <link href="../css/portfoliostyle.css" rel="stylesheet">
        <link href="../css/jquery-ui.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="../js/validateTestemonial.js"></script>
        
    </head>
    <body>
        <header>
                <h1>Luis Ramirez</h1>
                <nav>
                    <a href="../html/index.html">Home</a>
                    <a href="../html/interests.html">Interests</a>
                    <a href="../html/projects.html">Projects</a>
                    <a href="../html/resume.html">Resume</a>
                    <a href="http://www.luisr.sgedu.site/portfolio/php/testemonials.php">Testemonials</a>
                </nav>
        </header>
        <main>
            <h2>Please fill out the form below to enter your own testemonial.</h2>
            <form id="testemonialForm" name="testemonialForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" novalidate onsubmit="return validateForm();">
                <div id="formElements">
                    <label for="name">Name</label>
                    <input type="text" class="textFields" id="name" name="name" placeholder="Name (Optional)">
                    <span class="errorMessage" id="nameError">Please enter a valid name.</span>
    
                    <label for="email">Email</label>
                    <input type="email" class="textFields" id="email" name="email" placeholder="Your email to say thanks (Optional). This will not be displayed">
                    <span class="errorMessage" id="emailError">Please enter a valid email.</span>
                    
                    <label for="phone">Phone Number (xxx-xxx-xxxx)</label>
                    <input type="text" class="textFields" id="phone" name="phone" placeholder="Your phone number to say thanks (Optional). This will not be displayed">
                    <span class="errorMessage" id="phoneError">Please enter a valid phone number in the following format: XXX-XXX-XXXX</span>
                    
                    <label for="Comments">Comments (Required)</label>
                    <input type="text" class="textFields" id="comments" name="comments" placeholder="Enter your kind words here..." required>
                    <span class="errorMessage" id="commentsError">Please enter a comment.</span>
                    <br>
                </div>
                    <input type="submit" id="submit" value="Submit">
            </form>
        </main>

        <hr>
        <footer>
            <p>Copyright &copy; Luis Ramirez</p>
        </footer>
    </body>
</html>

<?php   
    $post_name = $post_email = $post_phone = $post_comments = "";
    $hasError = false; 
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $post_name = "Anonymous";
            $hasError = false;
            echo '<style type="text/css">
                    #nameError {
                        display: none;
                    }
                    </style>';
        } else {
            $post_name = clean_data($_POST["name"]);
            if (!preg_match("/^[a-zA-Z]+$/", $post_name)) {
                $hasError = true; 
                echo '<style type="text/css">
                #nameError {
                    display: block;
                }
                </style>';
            }
        }
        
        if(empty($_POST["email"])) {
            $post_email = "";
            $hasError = false;
            echo '<style type="text/css">
            #emailError {
                display: none;
            }
            </style>';
        } else {
            $post_email = clean_data($_POST["email"]);
            if (!filter_var($post_email, FILTER_VALIDATE_EMAIL)) {
                $hasError = true; 
                echo '<style type="text/css">
                #emailError {
                    display: block;
                }
                </style>';
            }
        }
        
        if(empty($_POST["phone"])) {
            $post_phone = "";
            $hasError = false;
            echo '<style type="text/css">
            #phoneError {
                display: none;
            }
            </style>';
        } else {
            $post_phone = clean_data($_POST["phone"]);
            if(!preg_match("/\d{3}[\-]\d{3}[\-]\d{4}/", $post_phone)) {
                $hasError = true; 
                echo '<style type="text/css">
                #phoneError {
                    display: block;
                }
                </style>';
            }
        }

        if(empty($_POST["comments"])) {
            $hasError = true; 
            echo '<style type="text/css">
            #commentsError {
                display: block;
            }
            </style>';
        } else {
            $post_comments = clean_data($_POST["comments"]);
            $hasError = false;
            echo '<style type="text/css">
            #commentsError {
                display: none;
            }
            </style>';
        }

        if(!$hasError) {
            post_data();
        }
    }   

    function clean_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function post_data() {
        global $post_name, $post_phone, $post_email, $post_comments;
        require_once("mysql_connect.php");
        $statement = $conn->prepare("INSERT INTO testemonials (name, email, phone, comments) 
                    VALUES (?, ?, ?, ?)");
        $statement->bind_param("ssss", $post_name, $post_email, $post_phone, $post_comments);
        $statement->execute();
        $statement->close();
        $conn->close();
        header("Location: http://www.luisr.sgedu.site/portfolio/php/testemonials.php");
    }
?>