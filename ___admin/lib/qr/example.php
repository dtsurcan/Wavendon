<?php

include("qrcode.php");

$qr = new qrcode();

$str = "1-я Минская птицефабрика, ОАО Минская обл. - 223043, Минский р-н, а/г Большевик +375 (17) 504-82-39-приёмная., 504-85-89-директор. Директор - Бохан Владимир Владимирович ".urlencode("sales@znatnoe.by")."  молоко - мясо птицы - продукция молочная - сметана - сыры рассольные - яйца";
  
//$str = iconv(  'utf-8', 'windows-1251', $str);

$qr->text($str);

echo "<p>UTF8 text</p>";
echo "<p><img src='".$qr->get_link()."' border='0' width='200' height='200'/></p>";


?>