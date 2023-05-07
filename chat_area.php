<?php
  session_start();
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>\
<style>
  .modalCenter{
    top:50% !important;
    transform: translateY(-50%) !important;
    width: 350px;
  }
  .modalCenter .btn{
    background: #333;
  }
  .modal-dialog{
    top:50% !important;
    transform: translateY(-50%) !important;
    width: 350px;
  }
</style>
  <body>
    <div class="wrapper">
      <section class="chat_area" >
        <header>
          <?php
              include_once "php/config.php";
              $user_id = mysqli_real_escape_string($conn , $_GET['user_id']);
              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
              if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
              }
          ?>
          <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="container">
            <span><?php echo $row['fname']." ".$row['lname']; ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
          <button id="decrypt" class="decrypt" data-title="Decryption"class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" ><i class="fa fa-unlock"></i></button>
        </header>
        <div class="chat-box">
          
        </div>
        <div class="container">

  <!-- Button to Open the Modal -->
  

  <!-- The Modal -->
  
  <div class="modal" id="myModal">
    <div class="modal-dialog modalCenter">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">!Note it!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p id="rand"></p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
  
</div>
<form method="post" action="php/decrypt.php">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Decrypt it</h5>
        <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Message:</label>
            <input type="text" name="dec=messs" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Key:</label>
            <input class="form-control" name="key" id="message-text">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Decrypt:</label>
            <p id="ans"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="decr" class="btn btn-primary">Decrypt</button>
      </div>
    </div>
  </div>
</div>
</form>
        <form method="post" action="#" class="typing-input" autocomplete="off">
          <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'] ;?>" hidden>
          <input type="text" name="incoming_id" value="<?php echo $user_id;?>" hidden>
          <input type="text" id="fname" class="input-field" name="message" placeholder="Type a message here...">
          <button name="enc-btn" class="encrypt-button" data-title="Encryption"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock" id="lock"></i></button>
          <button class="send-button"><i class="material-icons">&#xe163;</i></button>
        </form>
      </section>
    </div>
    <script src="javascript/chat_area.js"></script>
  </body>
</html>
