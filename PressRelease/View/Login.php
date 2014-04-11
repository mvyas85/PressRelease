<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="../style.css"/>
        <title>Login</title>
    </head>
    <body>
        <header>
            <svg class="absolute-center" width='350' height='81'>
                <rect width='350' height='81'/>
            </svg>
            <h2>Login Page</h2>
        </header>
        <div class="bluesquare">
            <?php if(isset($passwordDonotMatch))
            {
                echo $passwordDonotMatch;                
            }?>
            <table id="editor" style="padding-left:0px;"  >
                <tr >
                    <td style="padding-right:30px;"> <fieldset>
                            
                        <legend>Login</legend>
                        <form name="form1" method="post" action="../View/index.php" id="palinForm">
                        <input type='hidden' name='loggingin'  value='loggingin'/>

                        <table id="editor" style="padding-left:0px;" >
                            <tr>
                                <td>UserName*:</td>
                                <td><input type='text' name='myusername' id='username'  value="manisha"maxlength="50" /></td>
                            </tr>
                            <tr>
                                <td>Password*:</td>
                                <td><input type='password' name='mypassword' id='password' value="vyas" maxlength="50" /></td>
                            </tr>
                        </table>
                        <input type='submit' name='Submit' value='Login'  id='submit' />
                        </form>
                    </fieldset>
                    </td>
                    <td>
                        <fieldset>
                            <legend>Create New User</legend>
                            <form name="form1" method="post" action="../View/index.php"  id="palinForm">
                            <input type='hidden' name='create_user' value='create_user'/>

                            <table id="editor" style="padding-left:0px;" >
                                <tr>
                                    <td>UserName*:</td>
                                    <td><input type='text' name='newusername'   value="manisha"maxlength="50" required/></td>
                                </tr>
                                <tr>
                                    <td>Password*:</td>
                                    <td><input type='password' name='newpassword'  value="vyas" maxlength="50" required/></td>
                                </tr>
                                <tr>
                                    <td>Confirm Password*:</td>
                                    <td><input type='password' name='confirmnewpassword'  value="vyas" maxlength="50" required/></td>
                                </tr>
                                <tr>
                                    <td>City*:</td>
                                    <td><input type='text' name='newcity' id='password' value="vyas" maxlength="50" required/></td>
                                </tr>
                                <tr>
                                    <td>State*:</td>
                                    <td><input type='text' name='newsate' value="vyas" maxlength="50" required/></td>
                                </tr>
                                <tr>
                                    <td>Country:</td>
                                    <td><input type='text' name='newcountry'  value="vyas" maxlength="50"/></td>
                                </tr>
                                <tr>
                                    <td>Admin : </td>
                                    <td>
                                        <input type="radio" name="admin" value='1'>Yes
                                        <input type="radio" name="admin"value="0">No  
                                    </td>
                                </tr>
                            </table>
                            <input type='submit' name='Submit' value='Create Account'  id='submit' />
                            </form>
                        </fieldset>
                    </td>
                </tr>
            </table>
          </div>
        <p><a href= '../View/WelcomePage.php' >Press Release Home page</a></p>
    </body>
</html>