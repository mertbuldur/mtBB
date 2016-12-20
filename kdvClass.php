<?php 
class kdv 
{
  static function kdvekle($tutar,$kdv)
   {
     $kdv = $tutar * ($kdv/ 100);
     $tutar = $tutar + $kdv;
     return $tutar;

   }


   static function kdvcikar($tutar,$kdv)
   {
    $tutar= $tutar / (1 + ($kdv/100));
    return $tutar

   }


}
