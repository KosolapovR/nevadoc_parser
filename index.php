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

    <label for="seller">Склад</label>
    <select id="stock" name="stock">
        <option hidden disabled value selected></option>
        <option value="Narva">Нарва</option>
        <option value="Oka">Ока</option>
    </select>
</div>

<div class="widget">
    <button id="parsingButton" type="submit">Спарсить файл</button>
</div>

<p>Сумма = <span id="sum"></span></p>
<table id="parsedDataTable" cellspacing="5" cellpadding="10" border="1" width="100%" style="margin-top: 10px"></table>
<?php require 'src/template/footer.php' ?>


