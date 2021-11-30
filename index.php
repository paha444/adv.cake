<?php

function str_split_unicode($str, $l = 0) {
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}



function revertCharacters($string){
    
    $words = explode(' ',$string); // разбиваем строку на слова
    
    $words_new = [];
    $words_new_reverse = [];
    
    $special_chars = ['!','.']; // спецсимволы в словах
    
    
    
    foreach($words as $word){
         
        $w = str_split_unicode($word); // разбиваем слово на буквы
        $words_new[] = $w;
        
            $w_r=[];
            $i=count($w)-1;
            while($i>=0){ // делаем реверс слов и переводим в нижний регистр
                $w_r[] = mb_strtolower($w[$i]);
                $i--;
            }
            
            foreach($w_r as $key=>$value){   // ищем спецсимволы и переносим их в конец слов
                if(in_array($value,$special_chars)){
                    unset($w_r[$key]);
                    $w_r[] = $value;                
                }
            }
            
            $w_r = array_values($w_r);
            
            foreach($w_r as $key=>$value){ // ищем в словах символы в верхнем регистре и присваиваем верхний регистр в новом слове реверса 
                preg_match('/[A-ZА-Я]/u',$w[$key],$out);
                if($out[0]){
                  $w_r[$key] = mb_strtoupper($w_r[$key]); //($value);  
                }
            }            
            
            $words_new_reverse[] = $w_r;    
    }
    
    $result = '';
    foreach($words_new_reverse as $key=>$word){
            if($key>0) $result .= ' '; 
            foreach($word as $key2=>$value) $result .= $value;
                
    }
    
    return $result;
    
    //print_r($words_new);
    //print_r($words_new_reverse);
    
}



$result = revertCharacters("Привет! Давно не виделись.");
echo $result; // Тевирп! Онвад ен ьсиледив.

?>
















