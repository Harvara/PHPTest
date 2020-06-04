<?php
echo "Hello World";

$anwser = myFunc("Hello World") ? "yes" :  "no";
echo $anwser;

function myFunc($val){
    if ($val==="Hello World"){
        return true;
    }
    return  false;
}