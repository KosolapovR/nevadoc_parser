<?php
require '../../../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT'] . '/uploads/data.xls');

$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row and column numbers referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

$parsedArray = [];

for ($row = 24, $i = 0; $row <= $highestRow; ++$row, ++$i) {

    for ($col = 2, $j = 0; $col <= $highestColumnIndex; ++$col, ++$j) {
        $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
        if ($row > 24 && $col === 2) {
            if ($value != $worksheet->getCellByColumnAndRow($col, $row - 1)->getValue() + 1) {
                goto end;
            }
        }

        if($col === 3){

        }

        $prevValue = $value;

        if (!empty($value))
            $parsedArray[$i][] = $value;
    }
}
end:

echo json_encode(['response' => $parsedArray]);

