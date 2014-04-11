<?php
require ('../Model/User.php');
require ('../Model/db_connect.php');
class Press_release_Repository 
{
    
    //To check users login before updating password
    public static function confirmLogIn($myusername,$mypassword) 
    {
        $db = DBConnect::getDB();
        $query ="SELECT * FROM user_Account WHERE user='$myusername' and pass='$mypassword'";
        $rows = $db->prepare($query);
        $rows->execute();

        $count = $rows->rowCount();
        return $count ;
    }
    //Create New User
    public static function createNewUser($newusername,$newpassword,$newcity,$newsate,$newcountry,$admin) 
    {
        $db = DBConnect::getDB();
        $query ="INSERT INTO `pressrelease`.`user_account` (
                `user` ,
                `pass` ,
                `city` ,
                `state` ,
                `country` ,
                `admin`)
                VALUES ('$newusername', '$newpassword', '$newcity', '$newsate', '$newcountry', '$admin');";
        
        $rows = $db->prepare($query);
        $rows->execute();

        $count = $rows->rowCount();
        return $count ;
    }
    //get max release id
    public static function getNextID()
    {
        $db = DBConnect::getDB();
        $query = "select max(`press_release`.`release_id`)as maxid from press_release;";
        
        $result = $db->query($query);
        $result = $result->fetch();
        $maxid = $result['maxid'] + 1;
        return $maxid;
    }
    //Create new Press release athe same time also Creating connection
    public static function createRelease($id,$headline,$summary,$newsbody,$company,$email,$date,$user,$image)
    {
        $db = DBConnect::getDB();
        $query1 ="INSERT INTO `pressrelease`.`press_release` (
                `release_id` ,
                `headline` ,
                `summary` ,
                `news_body` ,
                `company_name` ,
                `email` ,
                `release_date`,
                `image`,
                )
                VALUES (
                '$id', '$headline', '$summary', '$newsbody', '$company', '$email', '$date','$image');";
       
        $result = $db->exec($query1);
        
        $query2 = "INSERT INTO `pressrelease`.`user_conn_press` (`user`, `release_id`) VALUES ('$user', '$id');";
        
        $result = $db->exec($query2);
    }
    //update a press release
    public static function updateARelease($id,$headline,$newsbody,$summary,$company,$email,$date,$image) 
    {
        $db = DBConnect::getDB();
        $query = "UPDATE `pressrelease`.`press_release` SET 
                `headline` = '$headline',
                `summary` = '$summary',
                `news_body` = '$newsbody',
                `company_name` = '$company',
                `email` = '$email',
                `release_date` = '$date', 
                `image` = '$image' WHERE `press_release`.`release_id` =$id;";
        
        $result = $db->exec($query);
        echo $query;
        return $result;
    }
    //Provides Combine table info
    public static function updatePassword($user,$newPass) 
    {
        $db = DBConnect::getDB();
        $query = " UPDATE `pressrelease`.`user_account` SET `pass` = '$newPass' WHERE `user_account`.`user` = '$user';;";
        
        $result = $db->exec($query);
        return $result;
    }
    //Provides Combine table info
    public static function deleteAPressRelease($release_id) 
    {
        $db = DBConnect::getDB();
        $query = "delete from press_release where release_id = $release_id ;";
        
        $result = $db->exec($query);
        return $result;
    }
    //Provides Combine table info
    public static function getViewPageReleaseInfo() 
    {
        $db = DBConnect::getDB();
        $query = " select * from user_account u,press_release p,user_conn_press c where p.release_id = c.release_id and c.user=u.user ORDER BY p.release_id;";
        
        $result = $db->query($query);
        
        $releases_user = array();
        foreach ($result as $row) 
        {    
            $user = new User($row['user'],$row['pass'],$row['city'],$row['state'],$row['country'],$row['admin'],$row['release_id'],$row['headline'],$row['summary'],$row['news_body'],$row['company_name'],$row['email'],$row['release_date'],$row['image']);          
            $releases_user[] = $user;
        }
        return $releases_user;
    }
    //ViewOfRelease page need to show a press release using press_ID   
    public static function  getViewPageReleaseInfoByID($press_Id) 
    {
        $db = DBConnect::getDB();
        $query = " select * from user_account u,press_release p,user_conn_press c where p.release_id = c.release_id and c.user=u.user and p.release_id=$press_Id;";
            
       
        $result = $db->query($query);
        $releases_user = array();
        foreach ($result as $row) 
        {          
            $user = new User($row['user'],$row['pass'],$row['city'],$row['state'],$row['country'],$row['admin'],$row['release_id'],$row['headline'],$row['summary'],$row['news_body'],$row['company_name'],$row['email'],$row['release_date'],$row['image']);          
            $releases_user[] = $user; 
        }
        return $releases_user;
    }
    //Check to see if user is ADMINISTRATOR
    public static function checkUserISAdmin($user)
    {
        $db = DBConnect::getDB();
        $query = " select admin from user_account where user ='$user';";

        $result = $db->query($query);
        $result = $result->fetch();
        
        return $result['admin'];
    }
    //to Show User his/her own  Releases only in user_Account
    public static function getAllRelease_ByUser($user) 
    {
         $db = DBConnect::getDB();
         
         $query = " select * from user_account u,press_release p,user_conn_press c where p.release_id = c.release_id and c.user=u.user and u.user='$user';";
         
         $result= $db->query($query);
         $releases_user = array();
        foreach ($result as $row) 
        {       
         $user = new User($row['user'],$row['pass'],$row['city'],$row['state'],$row['country'],$row['admin'],$row['release_id'],$row['headline'],$row['summary'],$row['news_body'],$row['company_name'],$row['email'],$row['release_date'],$row['image']);          
        
         $releases_user[] = $user; 
        }
       
        return $releases_user;
    }
    //To Sort the Press releases by $sort_by column
    
    public static function getAllRelease_SortBy($sort_by) 
    { 
        $db = DBConnect::getDB();
        $query = " select * from user_account u,press_release p,user_conn_press c where p.release_id = c.release_id and c.user=u.user ORDER BY $sort_by;";
        
        $result = $db->query($query);
        $releases_user = array();
        foreach ($result as $row) 
        {     
            $user = new User($row['user'],$row['pass'],$row['city'],$row['state'],$row['country'],$row['admin'],$row['release_id'],$row['headline'],$row['summary'],$row['news_body'],$row['company_name'],$row['email'],$row['release_date'],$row['image']);          
            $releases_user[] = $user;
        }
        return $releases_user;
    }   
    //To use to Search_text in search_by column
    public static function getAllRelease_SearchBy($search_by,$search_text) 
    { 
        $db = DBConnect::getDB();
        $query = " select * from user_account u,press_release p,user_conn_press c where p.release_id = c.release_id and c.user=u.user AND $search_by LIKE '%$search_text%'";
        
        $result = $db->query($query);
        $releases_user = array();
        foreach ($result as $row) 
        {     
            $user = new User($row['user'],$row['pass'],$row['city'],$row['state'],$row['country'],$row['admin'],$row['release_id'],$row['headline'],$row['summary'],$row['news_body'],$row['company_name'],$row['email'],$row['release_date'],$row['image']);          
            $releases_user[] = $user;
        }
        return $releases_user;
    }
    public static function getCityStateCountry($user)
    {
        $db = DBConnect::getDB();
        $query ="SELECT city,state,country FROM user_Account WHERE user='$user'";
          
        $result = $db->query($query);
        $result = $result->fetch();
        $csc = array($result['city'],$result['state'],$result['country']);
        return $csc;
    }
}
?>