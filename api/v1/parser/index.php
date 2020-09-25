<?php
require '../../../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 4));
$dotenv->load();

use App\Classes\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT'] . '/uploads/data.xls');

$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row and column numbers referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

$parsedArray = [];

$parsedArray[0] = [
    'name' => 'Наименование',
    'size' => 'Размер',
    'color' => 'Цвет',
    'material' => 'Ткань',
    'sleeve' => 'Рукав',
    'print' => 'Принт',
    'quantity' => 'Количество',
    'price' => 'Цена',
    'stock' => 'Склад',
];

$startRow = 1;
$startCol = 1;
$nameColumn = 2;
$quantityColumn = 3;
$priceColumn = 4;
$discountColumn = 5;
$totalSumColumn = 6;

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$stock = '';

if (isset($data['stock']) && !empty($data['stock']))
    switch ($data['stock']){
        case 'Narva': {
            $stock = 'ТЦ "Нарва"';
            break;
        }
        case 'Oka': {
            $stock = 'ТЦ "Ока" Колпино';
            break;
        }
        default: break;
    }

//установка параметров таблицы
if (isset($data['seller']) && !empty($data['seller']))
    switch ($data['seller']) {
        case 'DoctorBig':
        {
            $startRow = 23;
            $startCol = 2;
            $nameColumn = 4;
            $quantityColumn = 16;
            $totalSumColumn = 34;
            break;
        }
        case 'DoctorStil':
        {
            $startRow = 24;
            $startCol = 2;
            $nameColumn = 7;
            $quantityColumn = 15;
            $totalSumColumn = 35;
            break;
        }
        case 'IridaMed': {
            $startRow = 25;
            $startCol = 2;
            $nameColumn = 4;
//            $quantityColumn = 21;
//            $priceColumn = 28;
//            $discountColumn = 33;
            $quantityColumn = 26;
            $priceColumn = 31;
            $discountColumn = 35;
            break;
        }
        default: {
            echo json_encode(['response' => 'Unknown seller']);
            die();
        }
    }


for ($row = $startRow, $i = 1; $row <= $highestRow; ++$row, ++$i) {
    $index = $worksheet->getCellByColumnAndRow($startCol, $row)->getValue();
    if ($row > $startRow && $index != $worksheet->getCellByColumnAndRow($startCol, $row - 1)->getValue() + 1) {
        break;
    }

    $value = $worksheet->getCellByColumnAndRow($nameColumn, $row)->getValue();

    $db = new DB();
    $product = $db->getProductByPattern($value);

    $product['quantity'] = $worksheet->getCellByColumnAndRow($quantityColumn, $row)->getValue();

    $totalSum = $worksheet->getCellByColumnAndRow($totalSumColumn, $row)->getValue();
    $quantity = $worksheet->getCellByColumnAndRow($quantityColumn, $row)->getValue();
    $product['price'] = round($totalSum / $quantity, 2);

    if($data['seller'] === 'IridaMed')
    {
        $basePrice = (float)($worksheet->getCellByColumnAndRow($priceColumn, $row)->getValue());
        $spreadsheet->getActiveSheet()->getStyle("AG25")
            ->getNumberFormat()
            ->setFormatCode(
                \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00
            );
        if($discountColumn){
            $discount = $worksheet->getCellByColumnAndRow($discountColumn, $row)->getValue();
            $discount = floatval(
                str_replace(',', '.', str_replace('.', '', $discount))
                / $product['quantity']
            );
            $discount = round($discount, 2);
            $product['price'] = $basePrice - $discount;
        }else{
            $product['price'] = $basePrice;
        }

    }

    $product['stock'] = $stock;

    $parsedArray[$i] = $product;
}

//Запись в файл
$resultWorksheet = $spreadsheet->createSheet();
$resultWorksheet->fromArray(
    $parsedArray,  // The data to set
    NULL,        // Array values with this value will not be set
    'A1');

$writer = new Xls($spreadsheet);
try {
    $spreadsheet->setActiveSheetIndex(1);
} catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
    //TODO
}
$writer->save($_SERVER['DOCUMENT_ROOT'] . "/uploads/result.xls");


echo json_encode(['response' => $parsedArray], 2);

