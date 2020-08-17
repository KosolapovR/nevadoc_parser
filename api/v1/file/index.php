<?php
require '../../../vendor/autoload.php';

$files = glob($_SERVER['DOCUMENT_ROOT'] . '/uploads/*');
foreach ($files as $file) {
    if (is_file($file))
        unlink($file);
}

$uploaded_file = $_FILES['excelTable'];
$tmp_name = $uploaded_file["tmp_name"];
$fileName = $uploaded_file['name'];

$result = move_uploaded_file($_FILES['excelTable']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/uploads/data.xls');

if (!is_writable($_SERVER['DOCUMENT_ROOT'] . '/uploads')) {
    echo json_encode(['res' => "error in dir"]);
    die();
}

echo json_encode(['res' => $result]);