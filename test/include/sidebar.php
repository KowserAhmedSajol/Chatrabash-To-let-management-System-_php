<div class="col-4">
        

          <?php
          if(isset($_GET['id'])){
            ?>
            <div class="card mb-3">
            <h5 class="card-header"><b>Comments</b></h5>
            <?php
            $comments= getComments($db,$post_id);
            if(count($comments)<1){
              echo '<div class="card-body"><p class="card-text text-center">No comments..</p></div>';
            }
            foreach($comments as $comment){
              ?>
                <div class="card-body">
                  <h5 class="card-title text-capitalize" style="margin-bottom:0;"><b><?=$comment['name']?></b></h5>
                  <span class="text-secondary"><small><?=date('F jS,Y',strtotime($comment['created_at']))?></small></span>
                  <p class="card-text"><?=$comment['comment']?></p>
                </div><hr>
              <?php
            }

            ?>



          </div>


            <?php
          }
          ?>
          
          
    </div>