<?php
require '../../../vendor/autoload.php';

use App\Classes\Parser;

$parser = new Parser();
$parsedArray = $parser->parseFile();

return json_encode(['response' => $parsedArray]);

