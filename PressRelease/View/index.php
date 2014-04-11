<?php
require('../Model/Press_release_Repository.php');
    //delete account
    if(isset($_GET['del']))
    {
        Press_release_Repository::deleteAPressRelease($_GET['del']);
        include '../View/user_account.php';
    }
    //Change Password
   if(isset($_POST['username'])  && isset($_POST['password']) && isset($_POST['newpassword']) && isset($_POST['confirmnewpassword']))
    {
       $username = $_POST['username'];
       $password = $_POST['password'];
       $newpassword = $_POST['newpassword'];
       $confirmpassword = $_POST['confirmnewpassword'];
       
       $count = Press_release_Repository::confirmLogIn($username, $password);
       // If result matched $myusername and $mypassword, table row must be 1 row
       if($count==1)
       {
           if($newpassword == $confirmpassword)
           {
               $match = 'match';
               Press_release_Repository::updatePassword($username, $newpassword);
               include '../View/user_account.php';
           }
           else
           {
               $match = 'notmatch';
               include '../View/user_account.php';
           }
       }  
       else
       {
           $currpass = 'incorrect';
           include '../View/user_account.php';
       }
    }
    //Create A User Account
    if(isset($_POST['create_user']))
    {
        if($_POST['newusername'] && $_POST['newpassword'] && $_POST['confirmnewpassword'] && $_POST['newcity'] && $_POST['newsate']) 
        {
            $newusername = $_POST['newusername'];
            $newpassword = $_POST['newpassword'] ;
            $confirmpassword = $_POST['confirmnewpassword'];
            $newcity = $_POST['newcity'];
            $newsate = $_POST['newsate'];
            if(isset($_POST['admin'])){$newcountry = $_POST['newcountry'];} else { $newcountry='U.S.A'; } //Default country
            if(isset($_POST['admin'])){$admin = $_POST['admin'];} else { $admin=0; }//By default Admin = No

            if($newpassword != $confirmpassword)
            {
                $passwordDonotMatch = 'Password and Confirm Password Do not Match !';
                include '../View/Login.php';
            }
            else
            {
                Press_release_Repository::createNewUser($newusername,$newpassword,$newcity,$newsate,$newcountry,$admin );
                
                
                $lifetime = 60 * 60 ;//1 hour in seconds
                $path = '/';
                $domain = 'localhost/PressRelease/';
                $secure = true;
                $httponly = false;
                session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);

                session_start();

                // Register $myusername, $mypassword and redirect to file "login_success.php"
                $_SESSION['myusername'] = $newusername;
                $_SESSION['mypassword'] = $newpassword; 
                header('Location: ../View/WelcomePage.php');
            } 
        }
    }
    //user trying to update or Create a Press Release
    if(isset($_POST['operation']))
    {
        $operation = $_POST['operation'];
        
        $id = $_POST['id'];
        $headline = $_POST['headline'];
        $newsbody = $_POST['newsbody'];
        $summary = $_POST['summary'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $date = $_POST['date'];  
        $image_url = $_POST['image_url'];
        if($operation =='update')
        {   
            Press_release_Repository::updateARelease($id,$headline,$newsbody,$summary,$company,$email,$date,$image_url);
            $view = $id;
            include '../View/ViewOfRelease.php';
        }
        elseif($operation == 'create_new')
        {
            $user = $_POST['currUser']; 
            Press_release_Repository::createRelease($id,$headline,$summary,$newsbody,$company,$email,$date,$user,$image_url);
            $view = $id;
            include '../View/ViewOfRelease.php';
        }
    }
    //Loging in 
    if(isset($_POST['loggingin']))
    {
        if(isset($_POST['myusername'])  && isset($_POST['mypassword']))
        {
            $myusername=$_POST['myusername']; 
            $mypassword=$_POST['mypassword']; 

            // To protect MySQL injection 
            $myusername = stripslashes($myusername);
            $mypassword = stripslashes($mypassword);
            $myusername = mysql_real_escape_string($myusername);
            $mypassword = mysql_real_escape_string($mypassword);

            $count = Press_release_Repository::confirmLogIn($myusername, $mypassword);
            // If result matched $myusername and $mypassword, table row must be 1 row
            if($count==1)
            {
                $lifetime = 60 * 60 ;//1 hour in seconds
                $path = '/';
                $domain = 'localhost/PressRelease/';
                $secure = true;
                $httponly = false;
                session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);

                session_start();

                // Register $myusername, $mypassword and redirect to file "login_success.php"
                $_SESSION['myusername'] = $myusername;
                $_SESSION['mypassword'] = $mypassword; 
                header('Location: ../View/WelcomePage.php');
            }
            else
            {
                echo "Wrong Username or Password";
                include '../View/Login.php';
            }
        }
    }
    //Logout
    if(isset($_GET['logout']))
    {
        session_start();
        session_destroy();
        header("Location: ../View/WelcomePage.php");
    }
    

?>
