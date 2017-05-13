<?php
namespace Dframe;
use Dframe\Session;

/**
 * DframeFramework
 * Copyright (c) Sławomir Kaleta
 * @license https://github.com/dusta/Dframe/blob/master/LICENCE
 * Original @author Paweł Łopyta
 *
 */

class Token
{

    protected $session;
    protected $token = array();
    protected $time = array();

    // Tylko dla obiektu \Dframe\Session
    public function __construct(Session $session) {
        $this->session = $session;
        
        $token = $this->session->get('token');
        if(!empty($token))
            $this->token = $token;

        $timeToken = $this->session->get('timeToken');

        if(!empty($timeToken))
            $this->time = $timeToken;
    }
    
    public function generate($name) {
        $this->setToken($name, md5(uniqid(rand(), true)));
        $this->setTime($name, time() + 3600);
        return $this;
    }
    
    public function setToken($name, $token) {
        $this->token[$name] = $token;
        $this->session->set('token', $this->token);
        return $this;
    }
    
    public function getToken($name) {
        if(isset($this->token[$name]) AND $this->getTime($name) >= time())
            return $this->token[$name];

        return $this->generate($name)->token[$name];
    }
    
    public function remove($name) {
        if(isset($this->token[$name]))
            unset($this->token[$name]);
        
        if(isset($this->time[$name]))
            unset($this->time[$name]);
            
        $this->session->set('token', $this->token);
        $this->session->set('timeToken', $this->time);
    }
    
    public function setTime($name, $time) {
        if(isset($this->token[$name])){
            $this->time[$name] = intval($time);
            $this->session->set('timeToken', $this->time);
        }

        return $this;
    }
    
    public function getTime($name) {
        return isset($this->time[$name]) ? $this->time[$name] : null;
    }
    
    public function isValid($name, $token, $remove = false) {
    	$getToken = $this->getToken($name);

        if($remove == true)
            $this->remove($name);

        if($getToken == $token)
            return true;
        
        return false;
    }  
}