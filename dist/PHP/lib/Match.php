<?php
namespace Lib\Matchs;

class Matchs{
    public $progress = 0;
    private $ABC = [
            ['а','a'], ['б','b'], ['в','v'], ['г','g'], ['д','d'], ['е','e'], 
            ['ё','e'],['ж','zh'], ['з','z'] ,['и', 'i',], ['й','i'], ['к','k'], 
            ['л','l'], ['м','m'], ['н','n'], ['о','o'], ['п','p'], ['р','r'],
            ['с','c','s'], ['т','t'], ['у','u'], ['ф','f'], ['х','ch' ,'h','kh'], 
            ['ц','tc'], ['ц','c'], ['ч','ch'], ['ш','sch','sh', 'ch'],['щ','shch'], 
            ['ы','y'], ['э','e'], ['ю','iu','y'], ['я','ia','a']
    ];

    private $ABC_exc = ['x'=> ['ks']];

    public function verifiString(string $strOne, string $strTwo){
        $strOne = explode(" ", mb_strtolower($strOne));
        
        $strTwo = mb_strtolower(trim($strTwo));
      

       $control  = 0;
        $resultt = 0;

       foreach($strOne as $i =>$str){
         if(str_contains( $strTwo, $str)){
            $strTwo = str_replace($str,'', $strTwo);
            $control++;
            if($i == 0) $resultt += 50;
            if($i == 1) $resultt += 30;
            if($i == 2) $resultt += 20;
         }
         
       }

        $strTwo = explode(" ", trim($strTwo));
        
        foreach($strTwo as $two){

            foreach($strOne as $i => $one){
                if($two == '' || $one == '') continue;

                if(mb_detect_encoding($two) == 'ASCII' && mb_detect_encoding($one) == 'UTF-8'){
                   
                    if($this->latExString($one, $two) >= 50){
                        if($i == 0) $resultt += 50;
                        if($i == 1) $resultt += 20;
                        if($i == 2) $resultt += 10;
                        // print_r(gettype($resultt));
                    }
                    
                }
            
            }
        }
            // print_r($resultt);
        return round($resultt);
    }



    public function latExString(string $strOne, string $strTwo){
        $result = [$strTwo];

        foreach($this->ABC_exc as $k => $exc){
           foreach($exc as $e){

               if(str_contains($strTwo, $k)){
                $result[] = str_replace($k, $e, $strTwo);
               }

           }
        }

        $pr = 0;
        // print_r($result);
        foreach($result as $res){
          $i =  $this->latString($strOne, $res);
          if($i > $pr) $pr = $i;
        }

        return $pr;
    }



   public function latString(string $strOne, string $strTwo){
    //    print_r(mb_strtolower($strOne));

           $strOne = mb_str_split(mb_strtolower($strOne));
           $strTwo = mb_str_split(mb_strtolower($strTwo));
           $strlenOne = count($strOne);
           
           $count = count($strTwo);
        //    print_r('<br> One (len): '.$strlenOne.'<br>');
        //    print_r('Two (len): '.$count . '<br>');

           $delta = 100 / $count;

           $t = 0;
           $result = 0;

           foreach($strOne as $i => $b){

                $abc = $this->SearchABC($b);

                    if(count($abc) > 1){

                        $control = false;

                        foreach($abc as $lm => $a){

                            $s = mb_str_split(mb_strtolower($a));
                            $forc = 0;
                       
                            foreach($s as $lms => $ls){

                                
                                if($t+1 < count($strTwo)  ){
                                    if($ls == $strTwo[$t + $forc] ) $forc++;
                                    // var_dump($strTwo[$t + $forc] == $ls);
                                    // print_r($strTwo[$t + $forc].' == '.$ls.'<br>');
                                        // print_r($ls.' '. $strTwo[$t + $forc].' '.(string) $forc.'<br> ');
                                        
                                    }
                                }



                                // print_r($forc);
                                if($forc == count($s)){
                                        $t += $forc;
                                        $result += ($delta*$forc);
                                        $control = true;
                                    break;
                                }
                        }
                        // $t++;
                        if(!$control) $t++;
                    }else{
                        if(array_key_exists($t, $strTwo)){
                            // var_dump($strTwo[$t] == $abc[0]);
                            // print_r($strTwo[$t].' == '.$abc[0] . '<br>');
                            if(empty($abc[0]) && $strTwo[$t] == $abc[0]){
                                $result += $delta;
                            // $t++;
                            }
                        }
                            $t++;
                        // if($strlenOne == $count) $t++;

                        
                    }
                }

                return $result;
           }
        
   




 function SearchABC(string $b){

        $ABC = [];
        foreach($this->ABC as $arrs){
            if($arrs[0] == $b){
                $sl = array_slice($arrs, 1);
                $ABC = $sl;
            }
        }
        return  $ABC;
    }

}



// $m = new Matchs();



// echo mb_detect_encoding('Skip Tyler');
// print_r($m->verifiString("Лашин Александр Александрович", "Александр Петров"));
// echo  "<br> Оксана == Oxana ". strval($m->verifiString("Милена", "Mylena")).' % <br>';



// echo  "<br> Макс == Max " . strval($m->latExString("Макс", "Max")) . ' % <br>';
// echo  "<br> Александр == Alex " . strval($m->latExString("Александра", "Alex")) . ' % <br>';
// echo  " Макс == Max " . strval($m->latString("Макс", "Max")) . ' % <br>';
// echo  "  Михаил== Michail " . strval($m->latString("михаил", "Michail")) . ' % <br>';
// echo  " Карагачева == Karagacheva " . strval($m->latString("Карагачева", "Karagacheva")) . ' % <br>';
// echo  " пронина == pronina " . strval($m->latString("пронина ", "pronina")) . ' % <br>';
// echo  " Юлия == Ylia" . strval($m->latString("Юлия", "Ylia")) . ' % <br>';

// print_r($m->SearchABC('ш'))


?>