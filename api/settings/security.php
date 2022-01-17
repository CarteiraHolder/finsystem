<?php
// use Kreait\Firebase\Factory;
// use Firebase\Auth\Token\Exception\InvalidToken;

class Security {
    function __construct() {}

    public function CheckHttpOrigin(){
        // echo $_SERVER['PHP_AUTH_USER'];
        // echo $_SERVER['PHP_AUTH_PW'];
        // $NewPost = base64_decode($_SERVER['PHP_AUTH_PW']);
        // $array = explode('&',$NewPost);
        // foreach ($array as $key => $value) {
        //     $explode = explode('=',$value);
        //     // $MyPost[$explode[0]] = $explode[1];
        //     echo $_POST[$explode[0]] . " - " . $explode[1] . "<br>";
        // }
        // print_r($MyPost);
        // if(!isset($_SERVER['HTTP_ORIGIN'])) return false;
        // print_r($_SERVER['PHP_AUTH_PW']);die;
        // if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) && count($_POST) > 0) return false;
        if(count($_POST) == 0) return true;
        $MyNewPost = [];
        $Valid = true;
        parse_str($_SERVER['PHP_AUTH_PW'], $MyNewPost);
        foreach ($MyNewPost as $key => $value) {
            if (!array_key_exists($key, $_POST)) $Valid = false;
            else if($value != $_POST[$key]) $Valid = false;
        }
        if(count($MyNewPost) != count($_POST) ) $Valid = false;
        if($Valid == true && md5(ACCESSTOKEN . $_SERVER['PHP_AUTH_PW']) != $_SERVER['PHP_AUTH_USER'] ) $Valid = false;

        // //Criar um Array com os HTTP_ORIGIN permitidos
        // $AuthLocalhost = $_SERVER['HTTP_ORIGIN'] == 'http://localhost:8080';
        // $HostPHP = $_SERVER['HTTP_HOST'] == 'api.carteiraholder.com.br';
        // $AuthServer = $_SERVER['HTTP_ORIGIN'] == 'https://app.carteiraholder.com.br';
        // if(!(($AuthLocalhost && !$HostPHP ) || $AuthServer)) return false;
        
        return $Valid;
    }

    public function FirebaseAuth(){
        // return FireBase::FirebaseAuth();
    }
}