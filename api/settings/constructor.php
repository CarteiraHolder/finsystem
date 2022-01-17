<?php
include_once './settings/security.php';

class Constructor extends Security {
    protected $FriendlyUrl;
    protected $Class = '';
	protected $Method = '';
	protected $Value = '';
	protected $Object;

    function __construct($GET) {	
        parent::__construct();
        $this->FriendlyUrl = isset($GET) ? $GET["url"]: null;
	}

    public function Init(){
        if($this->FriendlyUrl == null) return $this->setError(404);
        $this->setClassAttributes();

        if($this->Class == '') return $this->setError(404);
        if(!file_exists('application/' . $this->Class . '.php')) return $this->setError(404);
        
        $this->Object = new $this->Class;
        if($this->Method == '') return $this->setError(405);
        if(!method_exists($this->Object, $this->Method)) return $this->setError(400);
        
        // if($this->Class != "mercadopago" && strtoupper($this->Method) != strtoupper("UpdatePricesBD") && strtoupper($this->Method) != strtoupper("GetAll") ){
        //     if(!$this->CheckHttpOrigin()) return $this->setError(401);
        // } 

        return $this->Object->{$this->Method}($this->Value);
    }

    public function setClassAttributes(){
        $Path = explode("/", $this->FriendlyUrl);
        if(isset($Path[0])) $this->Class = strtolower($Path[0]);
        if(isset($Path[1])) $this->Method = strtolower($Path[1]);
        if(isset($Path[2])) $this->Value = strtolower($Path[2]);
    }

    function setError($NumberError){
        http_response_code($NumberError);
    }

}
