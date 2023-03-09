<?php 
error_reporting(0);
require("connect.php");
require("function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <mata author="Vincent Ygbuhay" content="Web Developer, HTML, CSS, BOOTSTRAP, PHP">
    <title>C.R.U.D</title>
     <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JQUERY -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css"/>
</head>
<body>
<!-- NAVIGATION BAR-->
<?php 

require_once("./navigation/navindex.php");

?>
<!-- NAVIGATION BAR-->
<!-- MAIN SECTION -->
    <div style="min-height:640px;">
        <div class="container mt-3 mb-3">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- ALERT MESSAGE -->
                    <?php
                    echo successAlert();
                    echo deleteAlert();
                    ?>
                    <!-- ALERT MESSAGE -->
                    <div class="card border border-primary">
                        <div class="card-header border-primary d-flex">
                            <h2 class="text-start text-primary text-uppercase me-2 flex-fill">Basic c.r.u.d</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                                <!-- OPEN TABLE DISPLAYING THE DATA FROM USER TABLE -->
                                <table id="myTable" class="table table-secondary table-hover table-striped table-bordered shadow">
                                    <thead class="table-success text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Inspiring Word</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $pagex = $_GET['page'];
                                        if(!$pagex)
                                        {
                                            $pagex = 1;
                                        }
                                        $count = $num_per_page * ($pagex-1) + 1;
                                        $stmt = $conn->prepare("SELECT * FROM `user` ORDER BY `id` DESC");
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach($users as $user):?>
                                        <tr>
                                            <td><?php echo $count++;?></td>
                                                <td><?php echo $user['name'];?></td>
                                                <td><?php echo $user['email'];?></td>
                                                <td>
                                                    <?php 
                                                    if(strlen($user['message']) > 38)
                                                    {
                                                        $user['message'] = substr($user['message'], 0,38) . "...";
                                                    }
                                                    echo $user['message'];?>
                                                </td>
                                                <td><?php echo $user['inspiword'];?></td>
                                                <td><?php echo $user['date'];?></td>
                                                <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- EDIT BUTTON -->
                                                    <a href="edit.php?id=<?php echo $user['id'];?>" class="btn btn-outline-primary flex-fill me-2">Edit</a>
                                                    <!-- EDIT BUTTON -->
                                                    <!-- DELETE BUTTON WITH MODAL-->
                                                    <button type="button" class="btn btn-outline-danger flex-fill" data-bs-toggle="modal" data-bs-target="#delete<?php echo $user['id'];?>">Delete</button>
                                                    <!-- MODAL START -->
                                                    <div class="modal fade" id="delete<?php echo $user['id'];?>">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title text-danger">Delete</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <a href="delete.php?id=<?php echo $user['id'];?>" class="btn btn-outline-danger">Ok</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- DELETE BUTTON WITH MODAL-->
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- END TABLE DISPLAYING THE DATA FROM USER TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- MAIN SECTION -->
<!-- FOOTER -->
<?php

require_once("footer.php");

?>
<!-- END FOOTER -->
    
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- JQUERY -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search data",
                }
            });
        });
    </script>
</body>
</html>