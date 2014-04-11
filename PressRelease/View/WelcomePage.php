<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" href="../style.css" rel="stylesheet"/>
        <title>Welcome</title>
        
    </head>
    <body>
        <header>
            <svg class="absolute-center" width='450' height='81'>
                <rect width='450' height='81'/>
            </svg>
            <h2>Welcome to World Wide Press Release</h2>
            
        </header>
            <p><?php
                if(!session_id()) 
                {
                    session_start();
                    session_cache_expire (21900);
                }?>
            </p>
        <form method="post" action='' name="form1" >
           <?php
            if(isset($_SESSION['myusername']))
                {
                    Echo "Welcome " . $_SESSION['myusername'].'!';
                    ?><br/>
                    <table id="editor" >
                <tr>
                    <td style="text-align: left;"><a href="user_account.php">My Account</a></td>
                    <td style="text-align: right;"><a href="../View/index.php?logout='logout'">Logout</a></td>
                </tr>
            </table>
                    <?php
                }?>
            <input type="image" id="facBut" name="search" value="Search Release"  src="../Images/search.png" onclick="form1.action='../View/SearchRelease.php'"/>
            <input type="image" id="facBut" name="view" value="View Release" src="../Images/press_release.png" onclick="form1.action='../View/ViewRelease.php'"/>
            <input type="image" id="facBut" name="login" value="Login"  src="../Images/Login.png" onclick="form1.action='../View/Login.php'" />
        </form>
        <?php
            
        ?>
    </body>
</html>
