<?php
namespace App\Lib;
 
class ProfileMatching 
{ 

   private $cf = 0;
   private $sf = 0; 
   private $data = []; 

   public function __construct(float $cf = 0.0, float $sf = 0.0)
   {
        $this->cf = $cf;
        $this->sf = $sf;
   }

   private function gapMapping($reference , $candidate)
   {    
        for($i=0;$i<count($candidate);$i++){
            for($j=0;$j<count($candidate[$i]);$j++){
             $val =  $candidate[$i][$j] -  $reference[$j];
             //$results[$i][$j]= ["nilai" => $val, "bobot" =>$this->nilaiBobot($val)];
             $results[$i][]= $this->weightValue($val); 
            }   
        }
        return $results;
   }


   protected function weightValue($nilai)  {

      if ($nilai == 0 ) {

        $n = 5;
      }
      elseif ($nilai == 1) {
        
        $n = 4.5;
      }
      elseif ($nilai == -1) {
        
        $n = 4;
      } 
      elseif ($nilai == 2) {
        
        $n = 3.5;
      } 
      elseif ($nilai == -2) {
        
        $n = 3;
      }
      elseif ($nilai == 3) {
        
        $n = 2.5;
      }
      elseif ($nilai == -3) {
        
        $n = 2;
      }
      elseif ($nilai == 4) {
        
        $n = 1.5;
      }
      elseif ($nilai == -4) {

        $n = 1;
      }
      return $n;
    }

    private function totalValue($cfValue, $sfValue) {

      $total = ($this->cf * $cfValue) + ($this->sf * $sfValue);

      return $total;
    }
    private function getCoreFactor($data) 
    {
       return array_sum($data) / count($data) ;
        	
    }
    private function getCoreFactor($data) 
    {
       return array_sum($data) / count($data) ;
        	
    }
    private function groupCoreFactor($data) 
    {
       return array_sum($data) / count($data) ;
        	
    }
    private function groupSecondarayFactor($data) 
    {
         return array_sum($data) / count($data) ;
    }
    public function proces($reference, $candidate) {
      $gapMapping = $this->gapMapping($reference, $candidate);
      $length = count($gapMapping);
      for($i=0;$i<$length;$i++)
      {
        for($j=0;$j<count($gapMapping[$i]);$j++)
        {
          $cfValue = [$gapMapping[$i][0], $gapMapping[$i][3]];
          $sfValue = [$gapMapping[$i][1], $gapMapping[$i][2]];
        }
        $result[]= ['cf' => $cfValue, 'sf' => $sfValue];
      }
      return  $result ;
    }

}