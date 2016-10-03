<?php

abstract class Users {
   function getRole(){
     }
abstract function uploadFile();
abstract function viewUploadFiles();
}

class admin extends Users {
    function uploadFile(){
        return true;
    }
    function viewUploadFiles (){
        return true;
    }
}

class frontendUser extends Users {
    function uploadFile(){
        return false;
    }
    function viewUploadFiles (){
        return true;
    }
}