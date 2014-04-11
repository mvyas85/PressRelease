<?php
class Press_release {
    private $press_id,$headline,$summary,$news_body,$company,$email,$release_date,$image;
    
    public function __construct($press_id,$headline,$summary,$news_body,$company,$email,$release_date,$image) {
        $this->press_id=$press_id;
        $this->headline=$headline;
        $this->summary=$summary;
        $this->news_body=$news_body;
        $this->company=$company;
        $this->email=$email;
        $this->release_date=$release_date;
        $this->image = $image;
    }
    
    public function getPress_id(){ return $this->press_id;}
    public function getHeadline(){ return $this->headline;}
    public function getSummary(){ return $this->summary;}
    public function getNews_body(){ return $this->news_body;}
    public function getCompany(){ return $this->company;}
    public function getEmail(){ return $this->email;}
    public function getRelease_date(){ return $this->release_date;}
    public function getImage(){ return $this->image;}
    
    public function setPress_id($press_id)
    {
        $this->press_id=$press_id;
    }
    public function setHeadline($headline)
    { 
        $this->headline=$headline;
    }
    public function setSummary($summary)
    { 
        $this->summary=$summary;
    }
    public function setNews_body($news_body)
    {
        $this->news_body=$news_body;
    }
    public function setCompany($company)
    { 
        $this->company=$company;
    }
    public function setEmail($email)
    { 
        $this->email=$email;
    }
    public function setImage($image)
    { 
        $this->image=$image;
    }
    public function setRelease_date($relase_date)
    { 
        $this->release_date=$$relase_date;    
    }
}
?>
