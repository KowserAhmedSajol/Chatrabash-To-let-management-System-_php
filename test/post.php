<?php
require('include/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../rent/assets/img/icons8-home-96.png" type="image/gif" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Posts - Chatrabasah</title>
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
    <link rel="stylesheet" href="assets/css/User-rating.css">
</head>
<body>
<?php include_Once('include/navbar.php'); ?>   
<div>
    <div class="container m-auto mt-3 row">
    <?php
          $post_id=$_GET['id'];
          $postQuery="SELECT * FROM posts WHERE id=$post_id";
          $runPQ=mysqli_query($db,$postQuery);
          $post=mysqli_fetch_assoc($runPQ);
    ?>
        <div class="col-8">
            <div class="card mb-3">
                
                <div class="card-body">
                  <h5 class="card-title"><b><?=$post['title']?></b></h5>
                  <span class="badge bg-primary ">updated on <?=date('F jS,Y',strtotime($post['created_at']))?></span>
                  <span class="badge bg-danger"><?=getCategory($db,$post['category_id'])?></span>
                  <div class="border-bottom mt-3"></div>

                  <?php
                  $post_images=getImagesByPost($db,$post['id']);

                  ?>


    <?php
   
    foreach($post_images as $image){
     
      ?> 
      <img src="images/<?=$image['image']?>" class="d-block w-100" alt="...">
    

      <?php
  
    }

    ?>





                  <p class="card-text"><?=$post['content']?></p>
                  <div class="addthis_inline_share_toolbox"></div>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Comment on this
                  </button>

                </div>
              </div>
 
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment your thoughts.</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="include/add_comment.php" method="post">
  <div class="form-group">
    <?php
    if(isset($_SESSION['USER_ID'])){
      ?>
          <p><b><?php
          $stateOfBtn="";
      $fullname = $_SESSION['USER_F_NAME']." ".$_SESSION['USER_NAME'];
      echo $fullname;
    ?></b>, Please leave your comment...</p>

      <?php 

    }else {
      $stateOfBtn="disabled";
      ?>
      <p style="background:#F2DEDE; color:#A94442; padding:10px; ">It seems like you are not logged in. Please log in to make a Comment.</p>

  <?php 

    }
    
    ?>





  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Comment...</label>
    <input type="text" class="form-control" name="comment" id="exampleInputPassword1" placeholder="Comment...">
  </div>
  
<input type="hidden" name="post_id" value="<?=$post_id?>"><br>

  <button type="submit" name="addcomment" class="btn btn-primary" <?php echo $stateOfBtn;?>>Add Comment</button>
</form>
      </div>
 
    </div>
  </div>
</div>












              <div>
                  <h4>Related Posts</h4>
                  <?php
                  $pquery= "SELECT * FROM posts WHERE category_id={$post['category_id']} ORDER BY id DESC";
                  $prun= mysqli_query($db,$pquery);
                  while($rpost=mysqli_fetch_assoc($prun)){
                    if($rpost['id']==$post_id){
                      continue;
                    }
                    ?>
                    <a href="post.php?id=<?=$rpost['id']?>" style="text-decoration:none; color:black">
<div class="card mb-3" style="max-width: 700px;">
                    <div class="row g-0">
                      <div class="col-md-5" style="background-image: url('images/<?=getPostThumb($db,$rpost['id'])?>');background-size: cover">
                        <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
                      </div>
                      <div class="col-md-7">
                        <div class="card-body">
                          <h5 class="card-title"><b?><?=$rpost['title']?></b></h5><hr>
                          <p class="card-text text-truncate"><?=$rpost['content']?></p>
                          <p class="card-text"><small class="text-muted">updated on <?=date('F jS,Y',strtotime($rpost['created_at']))?></small></p>
                        </div>
                      </div>
                    </div>
                  </div>  
                  </a>
                    <?php
                  }

                  ?>





              </div>


        
    </div>
    <?php include_Once('include/sidebar.php'); ?>
    </div>

  
      
      
    <?php include_Once('include/footer.php'); ?>
         
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-613b9bb93f854d8c"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Bold-BS4-Animated-Back-To-Top.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
  </body>
</html>