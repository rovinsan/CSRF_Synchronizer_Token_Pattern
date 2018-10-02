<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
        $(document).ready(function(){
                swal("Failed", "Your message was attacked, Token Failed", "error")
        });
</script>
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
</body>
</html>