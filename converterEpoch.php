<?php

if(!empty($_POST['epoch'])){
    
    $_POST['epoch'] = intval(preg_replace('/[^\d.]/', '', $_POST['epoch']));
    $epoch =  htmlentities($_POST['epoch']);
    // The date returned by the GeckoApi (phpversion) has 3 char more than needed for an actual unix date for our actual period of time, we'll have to get rid of it
    $epoch2 = substr($epoch, 0, -3); //used to get rid of the 3 last char // later we'll try to test out js code to modify this visually since a foreach into a foreach would 
    $dt = new DateTime("@$epoch2");
}
//significally reduce the performance and global SEO of the website
// modify array with this formula to end up with a human redable date with (Y-m-d H:i:s') format (year month day hour minute Second)
include 'converterEpoch.phtml';

?>