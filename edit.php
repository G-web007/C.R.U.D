<?php
session_start();
error_reporting (0);
require_once "connect.php";
require_once "function.php";

$id = $_GET["id"];
if(isset($_POST["submit"]))
{
    $name = data_validation(ucfirst($_POST["name"]));
    $email = data_validation(($_POST["email"]));
    $message = data_validation(ucfirst($_POST["comment"]));
    $inspiWord = data_validation(ucfirst($_POST["inspiWord"]));

    // TIME
    date_default_timezone_set("Asia/Manila");
    $current = time();
    $format = strftime("%b-%d-%y %I:%M:%S", $current);

    if(!empty($name) && !empty($email) && !empty($message) && !empty($inspiWord))
    {
        $sql = "UPDATE `user` SET `name`=:username,`email`=:useremail,`message`=:usermessage,`inspiword`=:userinspiWord,`date`=:userformat WHERE `id`=:userid";
        $stmt = $conn->prepare($sql);
        $execute = $stmt->execute(array(":username"=>$name, ":useremail"=>$email, ":usermessage"=>$message, ":userinspiWord"=>$inspiWord, ":userformat"=>$format, ":userid"=>$id));
        
        if($execute)
        {
            $_SESSION["successMessage"] = "Data is successfully updated";
        }
        
    } else {
        $_SESSION["requiredMessage"] = "Data is required";
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
                <?php
                    echo requiredAlert();
                    echo successAlert();
                    ?>
                    <div class="card border border-primary">
                        <div class="card-body">
                            <h3 class="card-title text-center text-primary">Edit Message</h3>
                            <hr class="text-primary">
                            <!-- FETCHING ALL DATA FROM USER TABLE -->
                            <?php
                            
                            global $conn;
                            $sql = "SELECT * FROM `user` WHERE `id` = $id";
                            $stmt = $conn->query($sql);
                            while($fetch = $stmt->fetch())
                            {
                                $name = $fetch["name"];
                                $email = $fetch["email"];
                                $message = $fetch["message"];
                                $inspiringWord = $fetch["inspiword"];
                            
                            ?>
                            <!-- FETCHING ALL DATA FROM USER TABLE -->
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label mt-2">Email:</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $email;?>">
                                </div>
                                <div class="mb-2">
                                    <label for="comment" class="form-label mt-2">Message:</label>
                                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"><?php echo $message;?></textarea>
                                </div>
                                <label for="inspirationWord" class="form-label text-warning">Motivational phrases: </label> <span class="text-danger"></span><br>
                                <div class="d-inline-flex">
                                    <div class="form-check">
                                        <input type="radio" name="inspiWord" <?php if(isset($inspiringWord) && $inspiringWord == "Blessed") echo "checked";?> class="form-check-input" value="Blessed"> Blessed
                                        <label class="form-check-label" for="blessed"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="inspiWord" <?php if(isset($inspiringWord) && $inspiringWord == "Thankful") echo "checked";?> class="form-check-input" value="Thankful"> Thankful
                                        <label class="form-check-label" for="thankful"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="inspiWord" <?php if(isset($inspiringWord) && $inspiringWord == "Grateful") echo "checked";?> class="form-check-input" value="Grateful"> Grateful
                                        <label class="form-check-label" for="thankful"></label>
                                    </div>
                                </div>
                                <hr class="text-primary">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-outline-primary btn-block" name="submit">Update Data</button>
                                </div>
                            </form> 
                            <!-- CLOSING WHILE LOOP -->
                            <?php 
                            }
                            ?>
                            <!-- CLOSING WHILE LOOP -->
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