<?php 

// saving CSRF Token in a seperate file
function saveCSRFTokenString($csrfToken){

    $myfile = fopen("CSRFToken.txt", "a") or die("Unable to open file!");
    $string = "CSRF TOKEN : ".$csrfToken."\n";
    fwrite($myfile, $string);
    fclose($myfile);

}

    function generateCSRFToken($session, $length = 30){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $_SESSION['csrf_token_string'] = $randomString;
        saveCSRFTokenString($randomString);

        return $randomString;
    }


    if ($_SESSION['loggedIn']){
        header('location:form.php');
    }else{
        if (count($_POST)>0) {
            if ($_POST['uname'] != "" || $_POST['pwd'] != "") {
                if ($_POST['uname'] == "admin" && $_POST['pwd'] == "admin") {
                    
                    session_start();
                    
                    // set a session variable
                    $_SESSION['CSRF_SESSION'] = "CSRF-SESSION-VALUE";

                    // regenerate an id for session and store it in a cookie
                    session_regenerate_id();
                    setcookie("CSRF_SESSIO_COOKIE", session_id(), (time() + (3600)), "/");

                    // generateToken( $_POST['uname'] );
                    generateCSRFToken(session_id());

                    $_SESSION['loggedIn'] = true;
                    header('Location:form.php');
                }
                
            } else {
                header('Location:index.php');
            }
        }
    }


?>


<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        </head>
        <body style="background-color:black">

        <div class="container">
            <div class="row">
                 <!-- Sign in block -->
                <div class="col-md-4 mx-auto order-12">
                        <h4 class="text-center" style="padding-top:60px; color:white">CSRF - Synchronizer Token Pattern</h4>
                                <div class="card my-5 p-3 shadow" style="background-color:gray">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Sign In</h5>

                                        <!-- Sign in Form -->
                                        <form class="mt-5 mb-3" action="index.php" method="POST">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="uname" value="admin" required autofocus/>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="pwd" value="admin" required/>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mt-5" name="login">Login</button>
                                        </form>
                                        <!-- End Sign in Form -->

                                    </div>
                                </div>
                    </div>
                        <!-- End Sign in block -->
            </div>
        </div>
           


        </body>
    </html>


