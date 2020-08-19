<?php require 'src/template/header.php' ?>

<input type="file" id="fileUpload"/>

<div style="width: 200px; margin-top: 10px">
    <label for="seller">Поставщик</label>
    <select id="seller" name="seller">
        <option hidden disabled value selected></option>
        <option value="DoctorStil">Доктор стиль</option>
        <option value="DoctorBig">Докто Биг</option>
        <option value="IridaMed">Ирида Мед</option>
    </select>
</div>
<button id="parsingButton" style="display: block; margin-top: 20px" type="submit">Спарсить файл</button>

<table id="parsedDataTable" cellspacing="5" cellpadding="10" border="1" width="100%" style="margin-top: 10px"></table>
<?php require 'src/template/footer.php' ?>


