<?php require '../src/template/header.php'?>

<div class="form-wrapper">
    <form name="addPattern">
        <label for="pattern">Паттерн</label>
        <input type="text" id="pattern" name="pattern" placeholder="Введите паттерн..." required>

        <label for="productName">Название товара в бизнес.ру</label>
        <input type="text" id="productName" name="productName" placeholder="Введите название товара..." required>

        <label for="seller">Производитель</label>
        <select id="seller" name="seller">
            <option value="DoctorStil">Доктор стиль</option>
            <option value="DoctorBig">Докто Биг</option>
            <option value="IridaMed">Ирида Мед</option>
        </select>

        <input type="submit" value="Сохранить">
    </form>
</div>

<?php require '../src/template/footer.php'?>

