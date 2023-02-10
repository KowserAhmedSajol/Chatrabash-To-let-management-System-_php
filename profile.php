<?php
require('include/config.php');
session_start();
$and = "oye";
if (isset($_SESSION['USER_ID'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile - Chatrabash</title>
        <meta name="description" content="Online accommodation system for university students. Design by @Sazib.Gub">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dokdo&amp;display=swap">
        <link rel="stylesheet" href="assets/css/main.css">

    </head>

    <body>
        <?php
        include('include/navbar.php');
        ?>
        <section>
            <div class="container">
                <div style="margin-top: 10px;">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">User information</a></li>

                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "chatrabash");
                        if ($conn === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        $uid = $_SESSION['USER_ID'];
                        $sql = "SELECT * FROM users WHERE id=$uid";
                        $query = mysqli_query($conn, $sql);
                        $datauser = mysqli_fetch_assoc($query);
                        $user_type = $datauser['type'];
                        if ($user_type == "owner") {
                        ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Listing Posted</a>
                            </li>
                        <?php
                        }
                        ?>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" role="tabpanel" id="tab-1">
                            <h5 class="mb-4 text-info" id="nameeos" >User type: &nbsp;<?php echo $datauser['type']; ?></h5>

                            <h3 class="text-dark mb-4">Profile</h3>
                            <div class="row mb-3">
                                <div class="col-lg-4">

                                    <!------------------------------------->
                                    <!--./* Update profile photo Starts */.-->
                                    <!------------------------------------->

                                    <div class="card border-0 mb-3">
                                        <?php
                                        $conn = mysqli_connect("localhost", "root", "", "chatrabash");
                                        if ($conn === false) {
                                            die("ERROR: Could not connect. " . mysqli_connect_error());
                                        }
                                        $id = $_SESSION['USER_ID'];
                                        $q = "SELECT * FROM users WHERE id=$id";
                                        $query = mysqli_query($conn, $q);
                                        $data = mysqli_fetch_assoc($query);
                                        if ($data['photo']) {
                                            $profileName = $data['photo'];
                                        } else {
                                            $profileName = "ss.png";
                                        }
                                        ?>

                                        <div class="card-body text-center"><img class="bs-icon-rounded img-fluid shadow-sm mb-3 mt-4" src="imag/profiles/<?= $profileName ?>">

                                            <form method="post" action="profile.php" enctype="multipart/form-data">
                                                <input class="form-control-sm" type="file" id="image" name="image" accept=".jpg, .jpeg, .png" style="border: 1px dashed var(--ref-gray-300) ;"><br/>
                                                <div class="mb-3"><br/>
                                                    <input class="btn btn-primary btn-sm" type="submit" name="pchange" value="Change Photo&nbsp;">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_POST['pchange'])) {
                                    $imageName = $_FILES['image']['name'];
                                    $imageTmpName = $_FILES['image']['tmp_name'];
                                    $upLocation = "imag/profiles/" . $imageName;
                                    move_uploaded_file($imageTmpName, $upLocation);
                                    $sql = "UPDATE users SET photo=? WHERE id=?";
                                    $stmtinsert = $conn->prepare($sql);
                                    $result = $stmtinsert->execute([$imageName, $id]);
                                }
                                ?>

                                <!------------------------------------->
                                <!--./* Update profile photo ends */.-->
                                <!------------------------------------->

                            </div>

                            <div class="col-lg-8">

                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 fw-bold">User Settings</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="profile.php" enctype="application/x-www-form-urlencoded">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="first_name">
                                                                    <strong>First Name</strong></label><br/>
                                                                <p  style="border: .4px dashed #24285b;"><span class="text-muted">&nbsp;<?php echo $_SESSION['USER_F_NAME']; ?></span></p>
                                                            </div>
                                                            <div class="mb-3"><label class="form-label" for="last_name" ><strong>Last Name</strong></label><br/>
                                                                <p style="border: .4px dashed #24285b;"><span>&nbsp;<?php echo $_SESSION['USER_NAME'];?></span></p>
                                                            </div>
                                                            <div class="mb-3"><label class="form-label" for="email"><strong>Email Address</strong></label><br />
                                                                <p style="border: .4px dashed #24285b;"><span>&nbsp;<?php echo $_SESSION['EMAIL']; ?></span></p></div>
                                                            <div class="mb-3"><label class="form-label" for="username"><strong>Phone number</strong><br></label><br />
                                                                <p style="border: .4px dashed #24285b;"><span>&nbsp;<?php echo $_SESSION['PHONE']; ?></span></p></div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>


                                        <!---------------------------------->
                                        <!--./* Additional Data Ends */.-->
                                        <!---------------------------------->

                                        <!---------------------------------->
                                        <!--./* Update password start */.-->
                                        <!---------------------------------->
                                        <div class="card" style="margin-top: 10px;">
                                            <div class="card-header py-1">
                                                <p class="text-primary m-0 fw-bold">Update Password</p>
                                            </div>

                                            <div class="card-body">
                                                <form method="post" action="profile.php" enctype="application/x-www-form-urlencoded">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="p1"><strong>New Password&nbsp;</strong></label><br>
                                                                <input class="form-control" type="text" id="p1" placeholder="#45pass" name="npass"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="p2"><strong>Old Password&nbsp;</strong></label><br>
                                                                <input class="form-control" type="text" id="p-2" placeholder="#45pass" name="opass"></div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <input class="btn btn-primary btn-sm" type="submit" name="change" value="Confirmation&nbsp;">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_POST['change'])) {
                                    $newPass      = sha1($_POST['npass']);
                                    $oldPass      = sha1($_POST['opass']);
                                    $savedPass    = $_SESSION['PASSWORD'];
                                    $id           = $_SESSION['USER_ID'];
                                    if ($oldPass == $savedPass) {
                                        ?>
                                        <br />
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Password Changed Successfully</p>
                                        </div>
                                        <?php
                                        $conn = mysqli_connect("localhost", "root", "", "chatrabash");
                                        if ($conn === false) {
                                            die("ERROR: Could not connect. " . mysqli_connect_error());
                                        }
                                        $sql = "UPDATE users SET password=? WHERE id=?";
                                        $stmtinsert = $conn->prepare($sql);
                                        $result = $stmtinsert->execute([$newPass, $id]);
                                    } else {
                                        echo "not matched";
                                    }
                                } else {
                                }
                                ?>

                                <!---------------------------------->
                                <!--./* Update password end */.-->
                                <!---------------------------------->
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <div class="accordion" role="tablist" id="accordion-1">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed fw-light" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="false" aria-controls="accordion-1 .item-1">If you're a home owner than click here to join us</button></h2>
                                            <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#accordion-1">
                                                <div class="accordion-body">
                                                    <p class="mb-0">Basically we want verified home owner by our system for our customer.&nbsp;</p>
                                                    <div class="row g-0">
                                                        <div class="col-md-8 col-lg-12">
                                                            <div class="card" style="margin-top: 20px;">
                                                                <div class="card-header py-1">
                                                                    <p class="text-primary m-0 fw-bold">Contact Settings</p>
                                                                </div>
                                                                <div class="card-body">

                                                                        <?php
                                                                        $uid = $_SESSION['USER_ID'];
                                                                        $sql = "SELECT * FROM users WHERE id=$uid";
                                                                        $query = mysqli_query($conn, $sql);
                                                                        $datauser = mysqli_fetch_assoc($query);
                                                                        $user_type = $datauser['type'];
                                                                        if ($user_type == "owner") {
                                                                            ?>

                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="mb-3"><label class="form-label" for="first_name"><strong>NID NUMBER</strong></label><br />
                                                                                        <p style="border: .4px dashed #24285b;"><span>&nbsp;<?php echo $datauser['nid_number']; ?></span></p>
                                                                                    </div><br>
                                                                                    <div class="mb-3"><label class="form-label" for="last_name"><strong>ISSUE DATE</strong></label><br />
                                                                                        <p style="border: .4px dashed #24285b;"><span>&nbsp;<?php echo $datauser['issue_date']; ?></span></p>
                                                                                    </div><br>
                                                                                    <div class="mb-3"><label class="form-label" for="email"><strong>POSTAL CODE</strong></label><br />
                                                                                        <p style="border: .4px dashed #24285b;"><span>&nbsp;<?php echo $datauser['postal_code']; ?></span></p>
                                                                                    </div><br>
                                                                                </div>
                                                                            </div>

                                                                            <?php

                                                                        } else if ($user_type == "tennant") {
                                                                            ?>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label" for="address"><strong>NID Number</strong></label>
                                                                                        <input class="form-control" type="text" id="address" rows="1" placeholder="XXX XXX XXXX" name="nid_number"></input>
                                                                                    </div><br>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label" for="city"><strong>Issue Date</strong></label>
                                                                                        <input class="form-control" type="text" id="city" placeholder="EX : 10 jul 2020" name="issue_date">
                                                                                    </div><br>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label" for="country"><strong>Postal Code</strong></label>
                                                                                        <input class="form-control" type="text" id="country" placeholder="EX : 1411" name="postal_code">
                                                                                    </div><br>

                                                                                <div>
                                                                                    <label class="form-label"><strong>Send Nid</strong></label>
                                                                                    <input class="form-control" type="file" multiple="" accept="image/*" required="">
                                                                                </div><br>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <button class="btn btn-primary btn-sm" type="submit" name="extraSubmit">Save&nbsp;Settings</button>
                                                                            </div>

                                                                            <?php


                                                                            if (isset($_POST['extraSubmit'])) {
                                                                                $nid_number = $_POST['nid_number'];
                                                                                $issue_date = $_POST['issue_date'];
                                                                                $postal_code = $_POST['postal_code'];
                                                                                $id = $_SESSION['USER_ID'];
                                                                                $type = "owner";
                                                                                $conn = mysqli_connect("localhost", "root", "", "chatrabash");
                                                                                if ($conn === false) {
                                                                                    die("ERROR: Could not connect. " . mysqli_connect_error());
                                                                                }
                                                                                $sql = "UPDATE users SET nid_number=?, issue_date=?, postal_code=?, type=? WHERE id=?";
                                                                                $stmtinsert = $conn->prepare($sql);
                                                                                $result = $stmtinsert->execute([$nid_number, $issue_date, $postal_code, $type, $id]);
                                                                            }
                                                                        }

                                                                        ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" role="tabpanel" id="tab-2">
                    <div class="row g-0" style="margin-top: 10px;">
                        <div class="col">
                            <div>
                                <ul class="nav nav-pills nav-fill" role="tablist">
                                    <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="pill" href="#tab-3">My Property</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="pill" href="#tab-4">Submit New Property<br></a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="pill" href="#tab-5">My Packages</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="pill" href="#tab-6">View Contacts</a></li>
                                </ul>
                                <div class="tab-content">

                                    <!------------------------------>
                                    <!--./* My Property Starts */.-->
                                    <!------------------------------>

                                    <div class="tab-pane" role="tabpanel" id="tab-3">

                                        <?php
                                        require_once ('include/myproperty.php');
                                        ?>

                                        <!------------------------------>
                                        <!--./* My Property Ends */.-->
                                        <!------------------------------>
                                    </div>

                                    <div class="tab-pane" role="tabpanel" id="tab-4">
                                        <!------------------------------>
                                        <!--./* Submit New Property start */.-->
                                        <!------------------------------>

                                        <?php
                                        require_once('include/listing.php');
                                        ?>

                                    </div>
                                    <div class="tab-pane active" role="tabpanel" id="tab-5">
                                        <!-- package section by sazib -->
                                        <?php
                                        require_once('include/package.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="tab-6">
                                        <p>Content for tab 6.</p>
                                        <section>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Title</h4>
                                                    <h6 class="text-muted card-subtitle mb-2">Subtitle</h6>
                                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p><a class="card-link" href="#"><strong>Agreement</strong></a><a class="card-link" href="#"><strong>Disagree</strong></a>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <?php
        include('include/footer.php');
        ?>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/smart-forms.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="assets/js/ssmodern.js"></script>
        <script src="assets/js/all.js"></script>

    </body>

    </html>
<?php
} else {
    header("location:login.php");
}



?>