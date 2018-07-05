<?php
  
function dmy_hi_to_unix($date,$ddeli = '/', $tdeli = ':'){    
   return date_timestamp_get(date_create_from_format('d'.$ddeli.'m'.$ddeli.'Y H'.$tdeli.'i', $date));
}
function dmy_hi_to_unix_short($date,$ddeli = '/', $tdeli = ':'){    
   return date_timestamp_get(date_create_from_format('d'.$ddeli.'m'.$ddeli.'Y H'.$tdeli.'i', $date.' 00:00'));
}