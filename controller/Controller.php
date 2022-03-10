<?php
namespace Pre\Controller;

use Pre\Core\DatabseConnection;
use Pre\Core\Session\SessionManaged;

class Controller{
    private $dbc;
    private $data = [];
    private $session;

    public function __construct(DatabseConnection $dbc){
        $this->dbc = $dbc;
    }

    public function setSession(SessionManaged $session){
        $this->session = $session;
    }

   public function getSession():SessionManaged{
       return $this->session;
   }

  
  
    public function getConnection(){
        return $this->dbc->getConnectionSing();
    }

    protected function set(string $dataName, $value){
        if(preg_match("|^[a-z][a-z0-9]+([A-Z][a-z0-9]+)*$|", $dataName)){
            $this->data[$dataName] = $value;
            return true;
        }
        return false;
    }

    public function getData(){
        return $this->data;
    }

    public function rol(){

    }

    public function redirect($path, int $code=302){
        ob_clean();
        header("Location: " . $path, true, $code);
        exit;
    }
}
