<?php
require '../../../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 4));
$dotenv->load();

use App\Classes\DB;
use App\Classes\Pattern;

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$db = new DB();


switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':{

        if(isset($data['pattern']) && isset($data['productName'])){
            $pattern = new Pattern($data['pattern'], $data['productName'], $data['seller']);

            $res = $db->addPattern($pattern);
            echo json_encode(['res' => $res], true);
        }

        break;
    }
    case 'GET':{
        echo json_encode(['res' => 'method Get'], true);
        break;
    }
}

