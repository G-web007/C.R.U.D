<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once "connect.php";
require_once "function.php";

// DEFINING VARIABLE TO EMPTY
$nameErr = $emailErr = $commentErr = $inspirationWord = "";
$name = $email = $comment = $inspirationWord = "";
if(isset($_POST["submit"]))
{
    $name = data_validation(ucfirst($_POST["name"]));
    $email = data_validation($_POST["email"]);
    $comment = data_validation(ucfirst($_POST["comment"]));
    $inspirationWord = data_validation(ucfirst($_POST["inspiWord"]));

    //TIME
    date_default_timezone_set("Asia/Manila");
    $currentTime = time();
    $dateTimeFormat = strftime("%b-%d-%y %I:%M:%S", $currentTime);

    if(!empty($name) && !empty($email) && !empty($comment) && !empty($inspirationWord))
    {

        $sql = "INSERT INTO `user`(`name`, `email`, `message`, `inspiword`, `date`) VALUES (:username,:useremail, :usercomment, :userinspiword, :userdate)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $name);
        $stmt->bindParam(":useremail", $email);
        $stmt->bindParam(":usercomment", $comment);
        $stmt->bindParam(":userinspiword", $inspirationWord);
        $stmt->bindParam(":userdate", $dateTimeFormat);
        $execute = $stmt->execute();

        if($execute)
        {
            $_SESSION["successMessage"] = "Data is inserted";
            header("Location: index.php");
        } else {
            header("Location: addSection.php");
        }
    } else {
        $nameErr = $emailErr = $commentErr = $inspirationWordErr = "* Field is required!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <mata author="Vincent Ygbuhay" content="Web Developer, HTML, CSS, BOOTSTRAP, PHP">
    <title>basic CRUD</title>
     <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- NAVIGATION BAR-->
    <?php 
    
    require_once("./navigation/navadd.php");
    
    ?>
    <!-- NAVIGATION BAR-->
    
    <!-- MAIN SECTION -->
    <div style="min-height:640px;">
        <div class="container mt-3 mb-3">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border border-primary">
                        <div class="card-body">
                            <h3 class="card-title text-center text-primary">Message</h3>
                            <hr class="text-primary">
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                                    <span class="text-danger"><?php echo $nameErr;?></span>
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label mt-2">Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                    <span class="text-danger"><?php echo $emailErr;?></span>
                                </div>
                                <div class="mb-2">
                                    <label for="comment" class="form-label mt-2">Message:</label>
                                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                                    <span class="text-danger"><?php echo $commentErr;?></span>
                                </div>
                                <label for="inspirationWord" class="form-label text-warning">Motivational phrases: </label> <span class="text-danger"><?php echo $inspirationWordErr;?></span><br>
                                <div class="d-inline-flex">
                                    <div class="form-check">
                                        <input type="radio" name="inspiWord" class="form-check-input" value="blessed"> Blessed
                                        <label class="form-check-label" for="Blessed"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="inspiWord" class="form-check-input" value="thankful"> Thankful
                                        <label class="form-check-label" for="Thankful"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="inspiWord" class="form-check-input" value="grateful"> Grateful
                                        <label class="form-check-label" for="Grateful"></label>
                                    </div>
                                </div>
                                <hr class="text-primary">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-outline-primary btn-block" name="submit">Submit Data</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <?php
    
    require_once("footer.php");
    
    ?>
    <!-- END FOOTER -->
    
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>