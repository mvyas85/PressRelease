<!DOCTYPE html>
<?php
require ('../Model/Press_release_Repository.php');

if(!isset($_POST['userEditing'])) //Edit Mode
{
   $view_choice = $_GET['view'];
}
else //Create New Release Mode
{
    $author = $_POST['userEditing'];
    $userRow = Press_release_Repository::getCityStateCountry($author);
    
    $city = $userRow[0];
    $state = $userRow[1];
    $country = $userRow[2];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="../style.css"/>
        <title>View Press Release</title>
    </head>
    <body>
        <header>
            <svg class="absolute-center" width='450' height='81'>
                <rect width='450' height='81'/>
            </svg>
            <h2>Press Release</h2>
        </header>
        
        <div id="press">
            
            <?php 
            $x=0;
           if(!isset($_POST['userEditing']))
           {
                
                $releases = Press_release_Repository::getViewPageReleaseInfoByID($view_choice);
            }
            else
           {
               $releases = array(0);
            }
            foreach ($releases as $release) :
            
            ?>
            <form method="post" action="../View/index.php" id="palinForm"> 
                <input type="hidden" name ="operation"value="<?php if(!isset($_POST['userEditing'])){echo 'update';}else { echo 'create_new';}?>"/>
                <input type="hidden" name ="currUser" value="<?php if(!isset($_POST['userEditing'])){echo $release->getUser();}  else {echo $author;}?>"/>
                
                <table id='editor'>
                    <tr>
                        <td>
                            <label>Press Release ID: <input type="text" name="id" size="3" value="<?php  if(!isset($_POST['userEditing'])){echo $view_choice; }else {echo Press_release_Repository::getNextID();}?>" readonly="true"/> </label>
                            <label>Author : <?php if(!isset($_POST['userEditing'])){echo $release->getUser();}  else {echo $author;}?></label>
                            <div style="padding-right: 30px;padding-left: 20px;"></div>
                        </td>
                        <td>
                            <label>Image : </label>
                            <input type="text" name="image_url" value = "<?php if(!isset($_POST['userEditing'])){echo $release->getRelease()->getImage();}?>"size="20px"/>
                        </td>
                    </tr>
                </table>
                    <?php echo '<hr />' ?>
                <h3>Headline : </h3>
                    <input type="text" name="headline" size="60" value="<?php if(!isset($_POST['userEditing'])){echo $release->getRelease()->getHeadline();}?>" required/>
                <br/><br/>
                <p>News Body : </p>
                <textarea cols="4" rows="10" name="newsbody" style="width: 480px;height: 175px;opacity: 0.5;"  required><?php if(!isset($_POST['userEditing'])){echo "\r\n".$release->getRelease()->getNews_body();}?></textarea>
                <br/>
                <p >Summary : </p>
                <input type="text" name="summary" size="80" value="<?php if(!isset($_POST['userEditing'])){echo $release->getRelease()->getSummary();}?>" required/>
                <br/><br/>                <table id="editor">
                    <tr>
                        <td>Company Name :</td>
                        <td>
                        <input type="text" name="company" size="30" style="text-align: left;" value="<?php if(!isset($_POST['userEditing'])){echo "\r\n".$release->getRelease()->getCompany();}?>" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td>
                            <input type="text" name="email" size="30" value="<?php if(!isset($_POST['userEditing'])){echo $release->getRelease()->getEmail();}?>" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>City : </td>
                        <td><input type="text" name="city" size="30" value="<?php if(!isset($_POST['userEditing'])){echo $release->getCity();}else{echo $city;}?>" disabled="true" required/></td>
                    </tr>
                    <tr>
                        <td>State : </td>
                        <td><input type="text" name="state"  size="30" value="<?php if(!isset($_POST['userEditing'])){echo $release->getState();}else{echo $state;}?>" disabled="true" required/></td>
                    </tr>
                    <tr>
                        <td>Country : </td>
                        <td><input type="text" name="country" size="30" value="<?php if(!isset($_POST['userEditing'])){echo $release->getCountry();}else{echo $country;}?>" disabled="true" required/></td>
                    </tr>
                    <tr>
                        <td>Release Date :</td>
                        <td><input type="text" name="date" size="30" value="<?php if(!isset($_POST['userEditing'])){echo $release->getRelease()->getRelease_date();}?>"  required/></td> 
                    </tr>
                    <tr>
                    <td></td>
                    <td><?php if(isset($_POST['userEditing'])){echo '(YYYY-MM-DD)';}?></td>
                    </tr>
                </table>
            
            <?php $x++;endforeach; ?> 
            <input type="submit" name="submit" id="submit" value="Submit"/>
            </form>
        </div>
        <p><a href= '../View/WelcomePage.php' >Press Release Home page</a></p>
    </body>
</html>
