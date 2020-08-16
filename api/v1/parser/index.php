<?php
require '../../../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');

use App\Classes\Parser;

$parser = new Parser();
$parsedArray = $parser->parseFile();

return json_encode(['response' => $parsedArray]);

