<!DOCTYPE html>
 <?php
require('../Model/Press_release_Repository.php');

if(isset($_GET['sort_by']))
{
    $sort_by = $_GET['sort_by'];
    $releases = Press_release_Repository::getAllRelease_SortBy($sort_by);
}
else 
{
    $releases = Press_release_Repository::getViewPageReleaseInfo();
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
            <h2>View Press Release</h2>
        </header>
        <form method="GET" action="ViewRelease.php">
            <label for="search" style="display: inline;text-align: left">Sort by : </label>
            
            <select name="sort_by" elected-Inted="-1" required>
                <option value="">---</option>
                <option value="release_date">Date</option>
                <option value="u.user">Author</option>
                <option value="city">City</option>
            </select>
            <input type="Submit" name="view" value="View List" id="formet" />
            
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="55%">Headline</th>
                        <th width="15%">Release Date</th>
                        <th width="13%">Author</th>
                        <th width="12%">City</th>
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
                    </tr>
                    <?php $x++;endforeach; ?>                    
                </tbody>
            </table>
        </form>
        <br/>
        <p><a href= '../View/WelcomePage.php' >Press Release Home page</a></p>
    </body>
</html>
