<?php
include('../Model/Press_release.php');
class User {
    private $user,$pass,$city,$state,$country,$admin;
    private $release; //aggregation
    
    public function __construct($user,$pass,$city,$state,$country,$admin,$press_id,$headline,$summary,$news_body,$company,$email,$release_date,$image) {
        $this->user=$user;
        $this->pass=$pass;
        $this->city=$city;
        $this->state=$state;
        $this->country=$country;
        $this->admin=$admin;
        $this->release=new Press_release($press_id,$headline,$summary,$news_body,$company,$email,$release_date,$image);
    }
    
    public function getUser(){ return $this->user;}
    public function getPass(){ return $this->pass;}
    public function getCity(){ return $this->city;}
    public function getState(){ return $this->state;}
    public function getCountry(){ return $this->country;}
    public function getAdmin(){ return $this->admin;}
    public function getRelease(){ return $this->release;}
    
    public function setUser($user)
    {
        $this->user=$user;
    }
    public function setPass($pass)
    { 
        $this->pass=$pass;
    }
    public function setCity($city)
    { 
        $this->city=$city;
    }
    public function setState($state)
    { 
        $this->state=$state;
    }
    public function setCountry($country)
    { 
        $this->country=$country;
    }
    public function setAdmin($relase_date)
    { 
        $this->admin=$admin;    
    }
}
?>
