<?php
include('include/function.php');

?>
<!DOCTYPE html>
<html lang="en">


<nav class="navbar navbar-light navbar-expand-md navbar-shrink py-3" id="mainNav">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="index.php"><span>
                    <picture><img class="img-fluid" src="../chatrabash/assets/img/all/icons8.png"" loading="auto" style="height: 32.4px;width: 32.4px;" width="32" height="32"></picture>
                </span><span>&nbsp;Chatrabash</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="btn btn-outline-secondary" role="button" href="../chatrabash/listing.php" style="border-style: none;">Listing</a></li>
                <li class="nav-item"><a class="nav-link" href="../chatrabash/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../chatrabash/rents.php">Rent</a></li>
                <li class="nav-item"><a class="nav-link" href="../chatrabash/../test">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="../chatrabash/cmp.php">Compare</a></li>
                <li class="nav-item"><a class="nav-link" href="../chatrabash/contacts.php">Contacts</a>
                </li>

                <?php
                if(!isset($_SESSION['USER_ID'])) {?>
                    <li class="nav-item"><a class="nav-link" href="../chatrabash/login.php">Log in</a></li>
                    <li class="nav-item"><a class="nav-link" href="../chatrabash/signup.php">Sign up</a></li>

                    <?php
                } else {?>

                    <li class="nav-item dropdown" style="border-bottom-style: none;">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <?php echo $_SESSION['USER_NAME'];?>  </a>
                        <div class="dropdown-menu" style="border-style: none;">
                            <a class="dropdown-item" href="../chatrabash/profile.php"> <i class="fa-solid fa-user"></i> &nbsp;Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item link-danger" href="../chatrabash/logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<script src="../assets/js/all.js"></script>


