<!DOCTYPE html>
<?php 
if(!session_id()) 
{
    session_start();
    session_cache_expire (21900);
}
$loggedin_user = $_SESSION['myusername'];
if(!isset($_SESSION['myusername']))
{
    header('Location:../View/Login.php');
}

require_once ('../Model/Press_release_Repository.php');

//Checking if $loggedin_user is ADMIN then he should be able to see all releases
$admin = Press_release_Repository::checkUserISAdmin($loggedin_user);
if($admin)
{
    $releases = Press_release_Repository::getViewPageReleaseInfo();
}
else //if he is not ADMIN then he will be able to see only releases he published
{
    $releases = Press_release_Repository::getAllRelease_ByUser($loggedin_user);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" href="../style.css" rel="stylesheet"/>
        <title>My Account</title>
        <script src="../tabcontent.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <svg class="absolute-center" width='450' height='81'>
                <rect width='450' height='81'/>
            </svg>
            <h2><?php echo $loggedin_user."'s Account Info";?> </h2>
            
        </header>   
        <div class="bluesquare">
            <p>
                <?php 
                    if(isset($currpass) &&($currpass = 'incorrect'))
                    {
                        echo 'Current Password is incorrect !!';
                    }
                    elseif(isset($match) && ($match ==  'notmatch'))
                    {
                        echo 'New Password & Confirm New Password do not match !';
                    }
                    elseif(isset($match) && $match = 'match')
                    {
                        echo 'Password is updated Sucessfully!';
                    }
                ?>
            </p>
            <p><?php if($admin) { ?>Administrator Account<?php } else {?>Personal Account<?php }?></p>
        <div style="width: 800px; margin: 0 auto; padding: 20px 0 40px;">
            <ul class="tabs" data-persist="true">
                <li><a href="#view1">Change Password</a></li>
                <li><a href="#view2">My Press Releases</a></li>
                <li><a href="#view3">Create new Press Release</a></li>
            </ul>
            <div class="tabcontents">
                <div id="view1">
                    <form name="form1" style="width: 500px; background: #dedede;"method="POST" action='../View/index.php'>
                        <table style="width: 500px;">
                            <tr>
                                <td>Enter your UserName</td>
                                <td><input type="username" size="15" name="username" required></td>
                            </tr>
                            <tr>
                                <td>Enter your existing password:</td>
                                <td><input type="password" size="15" name="password" required></td>
                            </tr>
                            <tr>
                                <td>Enter your new password:</td>
                                <td><input type="password" size="15" name="newpassword" required></td>
                            </tr>
                            <tr>
                                <td>Re-enter your new password:</td>
                                <td><input type="password" size="15" name="confirmnewpassword" required></td>
                            </tr>
                        </table>
                        <br/>
                        <p><input type="submit" value="Update Password">
                     </form>
                </div>
                <div id="view2">
                    <form name="form2" style="width: 700px; background: #dedede;"method="POST" action=''>
                    <table style="width: 700px;">
                <thead>
                    <tr>
                        <th width="4%">ID</th>
                        <th width="37%">Headline</th>
                        <th width="17%">Release Date</th>
                        <th width="11%">Author</th>
                        <th width="20%">City</th>
                        <th width="3%">Del</th>
                        <th width="3%">Edit</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php 
                    $x=0;
                    foreach ($releases as $release) :
                    ?>
                    <tr>
                        <td><a href="ViewOfRelease.php?view=<?php echo $release->getRelease()->getPress_id();?>" action=""/><?php echo $release->getRelease()->getPress_id()?></td>
                        <td><?php echo $release->getRelease()->getHeadline(); ?></td>
                        <td><?php echo $release->getRelease()->getRelease_date(); ?></td>
                        <td><?php echo $release->getUser()?></td>
                        <td><?php echo $release->getCity()?></td>
                        <td><input type="image" value="delete" name="del"src="../Images/Delete_Icon.png" 
                                   width="20px" height="20px" 
                                   onclick="form2.action='../View/index.php?del=<?php echo $release->getRelease()->getPress_id(); ?>'"/></td>
                        <!--return confirm('Do you want to Delete this press Release ?');-->
                        <td><input type="image" value="Edit" name="edit"src="../Images/edit.png" 
                                   width="20px" height="20px"
                                   onclick="form2.action='../View/EditRelease.php?view=<?php echo $release->getRelease()->getPress_id(); ?>'"/>
                        </td>
                    </tr>
                    <?php $x++;endforeach; ?>                    
                </tbody>
            </table>        
            </form>
                </div>
                 <div id="view3">
                    <form name="form3" style="width: 500px; background: #dedede;"method="POST" action='../View/index.php'>
                        <input type="hidden" name="userEditing" value="<?php echo $loggedin_user;?>"/>
                        <p><input type="submit" value="Create New Press Release" onclick="form3.action='../View/EditRelease.php'">
                     </form>
                </div>
            </div>
        </div>
        </div>
        <p><a href= '../View/WelcomePage.php' >Press Release Home page</a></p>
    </body>
</html>
