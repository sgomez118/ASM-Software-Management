<?php
/* Part of the Lynda PHP tutorial about displaying text and numbers  */ 
$firstName = 'Alan';
$lastName = 'Turing';
$age = 31; 
$accountTotal = 2400.31415;
/* stored values in variables, but did not display them yet */
/* use echo or print */ 
// use double quotes to output the variable
   /* echo "first name = $firstName
          last name = $lastName
          age = $age
          account total = $accountTotal"; */
   echo "This spans\nmultiple lines. The newlines will be\noutput as well."; // no they won't; the php tutorial documentation thing is just flat out wrong here
   // what the hell is going on?  maybe older versions of PHP?  
   echo "Escaping characters is done \"Like this\".";
   echo ' line break
   test test
   test
   test test test ';
?>



