<?php
  
function gmp_shiftl($x,$n) { // shift left 
  return(gmp_mul($x,gmp_pow(2,$n))); 
} 

function gmp_shiftr($x,$n) { // shift right 
  return(gmp_div($x,gmp_pow(2,$n))); 
} 