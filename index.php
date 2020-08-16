<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>

<h3>Добавление паттерна</h3>

<div class="form-wrapper">
    <form>
        <label for="pattern">Паттерн</label>
        <input type="text" id="pattern" name="pattern" placeholder="Введите паттерн...">

        <label for="productName">Название товара в бизнес.ру</label>
        <input type="text" id="productName" name="productName" placeholder="Введите название товара...">

        <label for="seller">Производитель</label>
        <select id="seller" name="seller">
            <option value="DoctorStil">Доктор стиль</option>
            <option value="DoctorBig">Докто Биг</option>
            <option value="IridaMed">Ирида Мед</option>
        </select>

        <input type="submit" value="Сохранить">
    </form>
</div>

</body>