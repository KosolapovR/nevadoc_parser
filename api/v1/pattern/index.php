<?php
require '../../../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 4));
$dotenv->load();

use App\Classes\DB;
use App\Classes\Pattern;

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$db = new DB();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
    {

        if (isset($data['pattern']) &&
            !empty($data['pattern']) &&
            isset($data['productName']) &&
            !empty($data['productName'])
        ) {
            $pattern = new Pattern();

            $pattern
                ->setPattern($data['pattern'])
                ->setProductName($data['productName'])
                ->setSeller($data['seller'])
                ->setSize($data['size'])
                ->setColor($data['color'])
                ->setMaterial($data['material'])
                ->setSleeve($data['sleeve'])
                ->setPrint($data['print']);

            $res = $db->addPattern($pattern);
            echo json_encode(['res' => $res, 'message' => 'product with same pattern already exist'], true);
        }

        break;
    }
    case 'GET':
    {
        if (isset($_GET['productName']) && !empty($_GET['productName'])) {

            $name = htmlspecialchars($_GET["productName"]);
            if (!preg_match('//u', $name)) {
                $name = iconv("cp1251", "UTF-8", $name);
            }
            $product = $db->findProduct($name);
            if (!empty($product)) {
                echo json_encode(['success' => true, 'products' => $product], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['success' => false, 'message' => 'product not founded'], true);
            }

        } else {
            echo json_encode(['success' => false, 'message' => 'empty productName'], true);
        }

        break;
    }
}

