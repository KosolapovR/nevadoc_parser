<?php require '../src/template/header.php'?>

<div class="form-wrapper">
    <form name="addPattern">
        <label for="seller">Поставщик</label>
        <select id="seller" name="seller">
            <option hidden disabled value selected></option>
            <option value="DoctorStil">Доктор стиль</option>
            <option value="DoctorBig">Докто Биг</option>
            <option value="IridaMed">Ирида Мед</option>
        </select>

        <label for="pattern">Паттерн</label>
        <input type="text" id="pattern" name="pattern" placeholder="Введите паттерн..." required>

        <label for="productName">Название товара в бизнес.ру</label>
        <input type="text" id="productName" name="productName" placeholder="Введите название товара..." required>
        <div class="autocomplete">
            <ul class="autocomplete__list"></ul>
        </div>
        <label for="size">Размер</label>
        <select id="size" name="size">
            <option hidden disabled value selected></option>
            <option value="38">38</option>
            <option value="40">40</option>
            <option value="42">42</option>
            <option value="44">44</option>
            <option value="46">46</option>
            <option value="48">48</option>
            <option value="50">50</option>
            <option value="52">52</option>
            <option value="54">54</option>
            <option value="56">56</option>
            <option value="58">58</option>
            <option value="60">60</option>
            <option value="62">62</option>
            <option value="64">64</option>
            <option value="66">66</option>
            <option value="68">68</option>
            <option value="70">70</option>
        </select>

        <label for="color">Цвет</label>
        <select id="color" name="color">
            <option hidden disabled value selected></option>
            <option value="африка">африка</option>
            <option value="баклаж.">баклаж.</option>
            <option value="бел.">бел.</option>
            <option value="бел./т.син.">бел./т.син.</option>
            <option value="бел./фиол.">бел./фиол.</option>
            <option value="бел./коралл">бел./коралл</option>
            <option value="бел./бирюза">бел./бирюза</option>
            <option value="бел./гол.">бел./гол.</option>
            <option value="бел./сирень">бел./сирень</option>
            <option value="бирюз.">бирюз.</option>
            <option value="блю марин">блю марин</option>
            <option value="бордо">бордо</option>
            <option value="вас.">вас.</option>
            <option value="вас./бел.">вас./бел.</option>
            <option value="вас./бир.">вас./бир.</option>
            <option value="гол.">гол.</option>
            <option value="графит">графит</option>
            <option value="желт.">желт.</option>
            <option value="жемч.">жемч.</option>
            <option value="зел.">зел.</option>
            <option value="зел.лист">зел.лист</option>
            <option value="красн.">красн.</option>
            <option value="крем.">крем.</option>
            <option value="лаванда">лаванда</option>
            <option value="лазур.">лазур.</option>
            <option value="малина">малина</option>
            <option value="морс.волн.">морс.волн.</option>
            <option value="молекула">молекула</option>
            <option value="мята">мята</option>
            <option value="настур.">настур.</option>
            <option value="опал">опал</option>
            <option value="роз.">роз.</option>
            <option value="салат.">салат.</option>
            <option value="сер.">сер.</option>
            <option value="сер./гол.">сер./гол.</option>
            <option value="сер./син.">сер./син.</option>
            <option value="син.">син.</option>
            <option value="син./зел.">син./зел.</option>
            <option value="т.син.">т.син.</option>
            <option value="т.син./малина">т.син./малина</option>
            <option value="т.син./роз.">т.син./роз.</option>
            <option value="фиолет.">фиолет.</option>
            <option value="фиолет./сир.">фиолет./сир.</option>
            <option value="фиолет./сир.">фиолет./сир.</option>
            <option value="фиолет./роз.">фиолет./роз.</option>
            <option value="фукс.">фукс.</option>
            <option value="черн.">черн.</option>
            <option value="черн./бел.">черн./бел.</option>
            <option value="черника">черника</option>
            <option value="черника/бирюза">черника/бирюза</option>
            <option value="черника/з.ябл.">черника/з.ябл.</option>
            <option value="черника/коралл">черника/коралл</option>
            <option value="черника/лайм.">черника/лайм</option>
        </select>

        <label for="material">Материал</label>
        <select id="material" name="material">
            <option hidden disabled value selected></option>
            <option value="сатори">сатори</option>
            <option value="т/с">т/с</option>
            <option value="трикотаж">трикотаж</option>
            <option value="сат. лайт">сат. лайт</option>
            <option value="стрейч">стрейч</option>
            <option value="терикотон">терикотон</option>
        </select>

        <label for="sleeve">Рукав</label>
        <select id="sleeve" name="sleeve">
            <option hidden disabled value selected></option>
            <option value="к. рук.">к. рук.</option>
            <option value="3/4">3/4</option>
            <option value="дл. рук.">дл. рук.</option>
        </select>

        <label for="print">Принт</label>
        <select id="print" name="print">
            <option hidden disabled value selected></option>
            <option value="мишки">мишки</option>
            <option value="девочки">девочки</option>
            <option value="микки">микки</option>
            <option value="красный крест">красный крест</option>
            <option value="коты">коты</option>
            <option value="совы">совы</option>
            <option value="кошки">кошки</option>
            <option value="сердце">сердце</option>
            <option value="кардиограмма">кардиограмма</option>
            <option value="бэтмэн">бэтмэн</option>
            <option value="зубик">зубик</option>
            <option value="б.коровка">б.коровка</option>
            <option value="карандаш">карандаш</option>
            <option value="бабочки">бабочки</option>
            <option value="заяц">заяц</option>
        </select>

        <input type="submit" value="Сохранить">
    </form>
</div>

<?php require '../src/template/footer.php'?>

