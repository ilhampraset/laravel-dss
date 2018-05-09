<?php
// Buat namespace sesuai folder
namespace App\Lib;
 
class ProfileMatching 
{ 
   public $a = '';
   public function gapMapping($value)
   {    
        // $a = array('5', '5', '5');
        for($i=0;$i<count($value);$i++){
            for($j=0;$j<count($value[$i]);$j++){
            $results= $value[$i][$j] -  $this->a[$j];
                
            echo $results.' ';   
            }
        }
   }


}