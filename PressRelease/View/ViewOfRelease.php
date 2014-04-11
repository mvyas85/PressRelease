<!DOCTYPE html>
<?php
if(isset($_GET['view']))
{
    $view_choice = $_GET['view'];
}
 else
{
    $view_choice = $id;
}
require_once ('../Model/Press_release_Repository.php');
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
            $releases = Press_release_Repository::getViewPageReleaseInfoByID($view_choice);
            
            foreach ($releases as $release) :
            ?>
            <table id='editor'>
                <tr>
                    <td>
                        <label>Press Release ID: <?php echo $view_choice; ?> </label>
                        <label>Author : <?php echo $release->getUser();?></label>
                        <div style="padding-right: 30px;padding-left: 20px;"></div>
                    </td>
                    <td>
                        <input type="image" src="<?php echo $release->getRelease()->getImage();?>" value="" width="80px" height="80px"/>
                    </td>
                </tr>
            </table>
            <hr style="padding-right: 20px;"/>
            <?php echo '<hr />' ?>
            <h3>Headline : <?php echo "\r\n".$release->getRelease()->getHeadline();?></h3>
            <p style="text-align: left;"><?php echo "\r\n".$release->getRelease()->getNews_body();?></p>
            <br/>
            <p style="text-align: left;">Summary : <?php echo "\r\n".$release->getRelease()->getSummary();?></p>
            <br/>
            <br/>
            
            <p style="text-align: left;"><?php echo "\r\n".$release->getRelease()->getCompany();?></p>
            <p style="text-align: left;"><?php echo "\r\n".$release->getRelease()->getEmail();?></p>
            <p style="text-align: left;"><?php echo $release->getCity(); echo ' ,'.$release->getState(); ?></p>
            <p style="text-align: left;"><?php echo $release->getCountry(); ?></p>
            <p style="text-align: left;"><?php echo "\r\n".$release->getRelease()->getRelease_date();?></p>
          
            <?php $x++;endforeach; ?> 
        </div>
        <br/>
        <p><a href= '../View/WelcomePage.php' >Press Release Home page</a></p>
    </body>
</html>
