<?php 
  
  session_start();

  if(!isset($_COOKIE['CSRF_SESSIO_COOKIE']) || !isset($_SESSION['CSRF_SESSION'])){
      header("location:index.php");
  }

?>

<!DOCTYPE html>
  <html>
    <head>
      <title>Page Title</title>
          <!-- <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/form-validation.css" rel="stylesheet">
          <script src="js/jquery-3.3.1.min.js"></script> -->
          <!-- <script src="js/getToken.js"></script> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>
    <body style="background-color:black">

          <div class="header" style="overflow: hidden; background-color: black; padding: 20px 10px;">
              <div class="header-right" style="float:right">

                   <?php
                  if(isset($_COOKIE['CSRF_SESSIO_COOKIE'])){
                      echo 
                          '<li class="nav-item">
                              <form class="nav-link" method="POST" action="valid.php">
                                  <button class="btn btn-link" type="submit" value="Logout" name="logout">Logout</button>
                              </form>
                          </li>';
                  }
              ?>

              </div>
          </div>

        
          <div class="container">
            <div class="row">
                 <!-- Sign in block -->
                <div class="col-md-4 mx-auto order-12">
                        <h4 class="text-center" style="padding-top:60px;"><span class="text-success">Successfully Logged In</span></h4>
                            <div class="card my-5 p-3 shadow" style="background-color:gray">
                              <div class="card-body">
                                <h5 class="card-title text-center">Fill it</h5>
                                <form class="mt-5 mb-3" action="valid.php" method="POST">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required autofocus/>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <input type="text" class="form-control" id="messsage" name="message" required/>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                    <input type="hidden" id="csrf_token" name="csrf_token" value="" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mt-5" name="verify">Send</button>
                                </form>
                      
                              </div>
                            </div>
                  </div>
                </div>
              </div>
         


   <!-- CSRF Token retrieve | ajax call to the service.php -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>

        $(document).ready(function () {
            $.ajax({
                url: 'valid.php',
                type: 'post',
                async: false,
                data: {
                    'csrf_request': '<?php echo $_COOKIE['CSRF_SESSIO_COOKIE'] ?>'
                },
                success: function (data) {
                    document.getElementById("csrf_token").value = data;
                    $("#csrf_token_string").text(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log("Error on Ajax call :: " + xhr.responseText);
                }
            });
        });

      //  $(document).ready(function(){
      //       $("verify").click(function(){
      //           swal("Success Message Title", "Well done, you pressed a button", "success")
      //       });
      //   });

   
   </script>
</body>
</html>
