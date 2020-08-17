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


echo '<table>' . "\n";

for ($row = 24; $row <= $highestRow; ++$row) {
    echo '<tr>' . PHP_EOL;

    for ($col = 2; $col <= $highestColumnIndex; ++$col) {
        $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
        if($row > 24 && $col === 2){
            if($value != $worksheet->getCellByColumnAndRow($col, $row - 1)->getValue() + 1){
                goto end;
            }
        }
        $prevValue = $value;
        echo '<td>' . $value . '</td>' . PHP_EOL;
    }
    echo '</tr>' . PHP_EOL;
}
end:
echo '</table>' . PHP_EOL;

return json_encode(['response' => $parsedArray]);

