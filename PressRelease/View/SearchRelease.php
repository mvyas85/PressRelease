<!DOCTYPE html>
<?php
require '../Model/Press_release_Repository.php';
if(isset($_GET['search_type']) )
{
    $search_type = $_GET['search_type'];
    $search_text = $_GET['search_text'];
    $releases = Press_release_Repository::getAllRelease_SearchBy($search_type,$search_text);
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
        <title>Search Press Release</title>
    </head>
    <body>
        <header>
            <svg class="absolute-center" width='450' height='81'>
                <rect width='450' height='81'/>
            </svg>
            <h2>Search Press Release</h2>
        </header>
        <form method="GET" action="SearchRelease.php">
            <label for="search" style="display: inline;text-align: left">Search Press Release: </label>
            <input type="text" name="search_text" id="formet" size="33"required/>
            <input type="Submit" name="view" value="Search" id="formet" />

            <select name="search_type" elected-Inted="-1" required>
                <option value="news_body">News Body</option>
                <option value="city">City</option>
                <option value="state">State</option>
                <option value="country">Country</option>
            </select>
            <br/><br/>
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
        <p><a href= '../View/WelcomePage.php' >Press Release Home page</a></p>
    </body>
</html>
