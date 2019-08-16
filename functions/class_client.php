<?php

require_once "class_base.php";
require_once 'class_DB.php';

class Client extends Base
{
    public $cid;
    public $signatura;

    function __construct() {
        $this->LoadClient();
    }

   private function NewClient($signature=false)
   {
       global $user;
       if ($signature) {
           if (!$user->localuser && $user->id) {
               $data['uid'] = $user->id;
           } else {
               $data['uid'] = "";
           }
           $query
               = "
                    INSERT
                        `xx_clients`
                    SET
                        `uid` = ?,
                        `signatura` = ?,
                        `created` = ?,
                        `modified` = ?,
                        `city_id_po_ip` = ?,
                        `ip` = ?,
                        `roistat` = ?
                ";
           $params = array(
               $data['uid'],
               $signature,
               time(),
               time(),
               $this->GetCityIdPoIp(),
               $_SERVER["REMOTE_ADDR"],
               $_COOKIE["roistat_visit"]
           );
           if (DB::query($query, $params)) {
               $this->SetLog("«аписали клиента в базу");
               $this->cid = DB::instance()->lastInsertId();
               return $this->cid;
           }
    }
   }


   private function LoadClient(){
        if(!$this->CheckClient()){
            if (isset($_COOKIE["signature"]) && $_COOKIE["signature"]!=""){
                $this->SetLog("Ќовый клиент с готовой сигнатурой - создаем его в базе ");
                $this->GetSignatura($_COOKIE["PHPSESSID"]);
                $this->cid= $_SESSION["cid"]  = $this->NewClient($_COOKIE["signature"]);
                setcookie("cid", $this->cid, time()+10*360*24*60*60, "/");
                return $this->cid;
            }else{
                $this->SetLog("јбсолютно новый клиент - создаем устанавливаем ему куки");
                $this->SetSignatura($_COOKIE["PHPSESSID"]);
            }
        }else{
            $this->SetLog("√отовый клиент - ничего не надо далать");
            return $this->cid;
        }
   }
   private function CheckClient(){
        if($this->cid = $this->GetClientID()){
            $this->signatura = $this->GetSignatura();
            return $this->cid;
        }
   }



   public function GetClientID(){
       if(isset($_SESSION["cid"])) {
           return $_SESSION["cid"];
       }
       elseif (isset($_COOKIE["cid"])){
           $_SESSION["cid"]=$_COOKIE["cid"];
           return $_SESSION["cid"];
       }
   }


   private function GetCityIdPoIp(){
        global $user_city;
        if (is_object($user_city)) {
            return $user_city->id_po_ip;
        }

   }

   public function ClearClient(){
       unset($_SESSION["cid"]);
       setcookie("cid", "", time() - 3600, "/");
       unset($_SESSION["signature"]);
       setcookie("signature", "", time() - 3600, "/");

   }
}