<?php
class logger
{

  public $db;
  public function __construct()
      {
          try {
              $this->db = new PDO("mysql:host=localhost;dbname=mp3", "root", "");
              }
              catch ( PDOException $e ){ print $e->getMessage();
                }
      }


    public function log()
    {
      $browser = $_SERVER['HTTP_USER_AGENT']; // Kullanıcı tarayıcı bilgilerini aldık.
      $ip = logger::GetIP(); // kullanıcı ip bilgisini aldık
      $referer = $_SERVER['HTTP_REFERER']; // kullanıcı nereden gelmiş ?
      $date = date("Y-m-d");
       $control = $this->db->query("select * from log where ip='$ip'")->rowcount();
       if($control==0)
       {
         $this->db->query("insert into log(browser,ip,referer,date) values('$browser','$ip','$referer','$date')");
       }
       else {
         echo " bu Log kayıtlımış";
            }
    }

    static function  GetIP()
    {
        if(getenv("HTTP_CLIENT_IP")) {
           $ip = getenv("HTTP_CLIENT_IP");
         } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
           $ip = getenv("HTTP_X_FORWARDED_FOR");
           if (strstr($ip, ',')) {
           $tmp = explode (',', $ip);
           $ip = trim($tmp[0]);
           }
         } else {
         $ip = getenv("REMOTE_ADDR");
         }
         return $ip;
        }
}
?>
