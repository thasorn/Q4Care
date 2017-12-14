<?php
function label( $label ){
   $ci = & get_instance();
   $rs = $ci->lang->line( $label );
   if( $rs ){
     return $rs;
   }else{
     return $label;
   }
}

function getTextLang( $text ){
   if( $text == "thailand" ){
     return "ข่าวภาษาไทย";
   }else if( $text == "english" ){
     return "ข่าวภาษาอังกฤษ";
   }else{
     return $text;
   }
}
function changeDateNews( $date ){

    $date =  str_replace(" ","-",$date );
    $date_ar = explode("-", $date);
    $month[ "english" ] = array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    //print_r( $date_ar );
    $day = $date_ar[2];
    /*if( intval($date_ar[1]) < 10 ){
      $month_use = "0".$date_ar[1];
    }else{
      $month_use = $date_ar[1];
    }*/
    //$month_use = $date_ar[1];
    $month_use = $month[ "english" ][intval($date_ar[1])];
    $date = $day." ".$month_use."" ;

    return $date;

}
function changeDate( $date, $lang ){

    $month = array();
    $month[ "thailand" ] = array("","มกราคม","กุมพาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $month[ "english" ] = array("","Janusry","February","March","April","May","June","July","August","September","October","November","December");
    $date =  str_replace(" ","-",$date );
    $date_ar = explode("-", $date);
    //print_r( $date_ar );
    $day = $date_ar[2];
    $month_use = $month[ $lang ][intval($date_ar[1])];
    $year = $lang == "thailand" ? intval( $date_ar[0] )+ 543 : $date_ar[0];

    $date = $day." ".$month_use." ". $year ;

    return $date;

}
function getCatTitle( $cats ){
  $ids = explode(",",$cats);
  $id = $ids[0];
  $cat_title = array("","food","exercise","mood","talkwithdoc","news","video");
  return $cat_title[ $id ];
}

function getCatText( $cats ){
  $cat_text = array("food" => "อาหาร...ดีต่อใจ","exercise" => "ออกกำลังกาย...ดีต่อใจ","mood" => "อารมณ์...ดีต่อใจ","talkwithdoc","events","video");
  return $cat_text[ $cats ];
}

function checkStrLength( $str , $limit){
  if( strlen( $str ) > intval( $limit ) ){
    $str = iconv_substr( $str, 0, $limit, "UTF-8")."...";
  }
  return $str;
}

 ?>
