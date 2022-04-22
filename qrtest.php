<?php

require_once "vendor/autoload.php";

// instantiate the barcode class
$barcode = new \Com\Tecnick\Barcode\Barcode();

// generate a barcode
$bobj = $barcode->getBarcodeObj(
    'QRCODE,H',                     // barcode type and additional comma-separated parameters
    'https://www.google.co.jp',          // data string to encode
    -4,                             // bar width (use absolute or negative value as multiplication factor)
    -4,                             // bar height (use absolute or negative value as multiplication factor)
    '#CCCCCC',                        // foreground color
    array(-2, -2, -2, -2)           // padding (use absolute or negative values as multiplication factors)
)->setBackgroundColor('#EFEFEF'); // background color

// output the barcode as HTML div (see other output formats in the documentation and examples)
$bobj->getHtmlDiv();

echo $bobj->getHtmlDiv();