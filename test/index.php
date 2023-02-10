<?php
require('include/db.php');
if(isset($_GET['page'])){
  $page=$_GET['page'];
}else{
  $page=1;
}

$post_per_page=5;
$result=($page-1)*$post_per_page;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../rent/assets/img/icons8-home-96.png" type="image/gif" sizes="16x16">
    <title>Blog - Chatrabasah</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/animated-services.css">
    <link rel="stylesheet" href="assets/css/Banner-Heading-Image-images.css">
    <link rel="stylesheet" href="assets/css/Bold-BS4-Animated-Back-To-Top.css">
    <link rel="stylesheet" href="assets/css/Features-Cards.css">
    <link rel="stylesheet" href="assets/css/Filter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Latest-Events.css">
    <link rel="stylesheet" href="assets/css/Responsive-Client-Two.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Testimonial-Slider-BS5.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dokdo&amp;display=swap">
    <link rel="stylesheet" href="assets/css/User-rating.css">
</head>
<body>
    <?php include_Once('include/navbar.php'); ?>
<div>
    <div class="container m-auto mt-3 row">
        <div class="col-8">
        <?php
        if(isset($_GET['search'])){
          $keyword= $_GET['search'];
          $postQuery="SELECT * FROM posts WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $result,$post_per_page";
        }else{
          $postQuery="SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_page";
        }
          $runPQ=mysqli_query($db,$postQuery);
          while($post=mysqli_fetch_assoc($runPQ)){
            ?>
        <div class="card mb-3" style="max-width: 800px;">
        <a href="post.php?id=<?=$post['id']?>" style="text-decoration:none; color:black">
            <div class="row g-0">
              <div class="col-md-5" style="background-image: url('images/<?=getPostThumb($db,$post['id'])?>');background-size: cover">
                <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title"><b><?=$post['title']?></b></h5><hr>
                  <p class="text-truncate"><?=$post['content']?></p>
                  <p class="card-text"><small class="text-muted">updated on <?=date('F jS,Y',strtotime($post['created_at']))?></small></p>
                </div>
                
              </div>
            </div>
            </a>
          </div>
<?php
          }
          ?>
    </div>
    <?php include_Once('include/sidebar.php'); ?>
    </div>
    <?php
    if(isset($_GET['search'])){
      $keyword=$_GET['search'];
      $q="SELECT * FROM posts WHERE title LIKE '%$keyword%'";

    }else{
      $q="SELECT * FROM posts";

    }
          $r=mysqli_query($db,$q);
          $total_posts=mysqli_num_rows($r);
          $total_pages=ceil($total_posts/$post_per_page);
        ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php
          if($page>1){
            $switch="";
          }else{
            $switch="disabled";
          }
          if($page<$total_pages){
            $nswitch="";
          }else{
            $nswitch="disabled";
          }
          ?>
          <li class="page-item <?=$switch?>">
            <a class="page-link"  href="?<?php if(isset($_GET['search'])){ echo"search=$keyword%";} ?>page=<?=$page-1?>" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <?php
          for($opage=1;$opage<=$total_pages;$opage++){
            ?>
            <li class="page-item"><a class="page-link" href="?<?php if(isset($_GET['search'])){ echo"search=$keyword%";} ?>page=<?=$opage?>"><?=$opage?></a></li>


            <?php
          }

          ?>
          <li class="page-item <?=$nswitch?>">
            <a class="page-link" href="?<?php if(isset($_GET['search'])){ echo"search=$keyword%";} ?>page=<?=$page+1?>">Next</a>
          </li>
        </ul>
      </nav>
      
    <?php include_Once('include/footer.php'); ?>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Bold-BS4-Animated-Back-To-Top.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>   
</body>
</html>