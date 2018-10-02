<?php


session_start();

    function logout() {

        // unset all cookies and sessions belongs to that user
        unset($_COOKIE['CSRF_SESSIO_COOKIE']);
        setcookie('CSRF_SESSIO_COOKIE', null, -1, '/');
        unset($_SESSION);

        // redirect to login page
        header("location:index.php");
    }


    if(isset($_POST['logout'])){

        logout();

    } elseif (isset($_POST['csrf_request'])){

        if($_POST['csrf_request'] == $_COOKIE['CSRF_SESSIO_COOKIE']){

            // echo generateCSRFToken($_COOKIE['CSRF_SESSIO_COOKIE']);
            echo $_SESSION['csrf_token_string'];

        }else { 
            echo "nullstring"; 
        }

    } else if (isset($_POST['verify'])){

        if($_POST['csrf_token'] == $_SESSION['csrf_token_string']){
            header("location:success.php");
        }else {
            header("location:error.php");
        }
    }

?>