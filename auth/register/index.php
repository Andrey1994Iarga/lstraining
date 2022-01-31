<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
    <div class="login__form">
        <form action="<?=SITE_TEMPLATE_PATH?>/ajax/reg.php" class="regform">
            <h2>Регистрация в системе</h2>
            <p class="error"></p>
            <label>
                <input type="text" name="mail" placeholder="E-mail*">
            </label>
            <label>
                <input type="text" name="name" placeholder="Имя">
            </label>
            <label>
                <input type="text" name="last_name" placeholder="Фамилия">
            </label>
            <label>
                <input type="text" name='password' placeholder="Пароль*">
            </label>
            <label>
                <input type="text" name='confirm_password' placeholder="Повторите пароль">
            </label>
            <label>
                <input name="checkbox" type="checkbox">
                <p>Подтверждаю согласие c <a href="#">Пользовательским соглашением</a> и <a href="#">Политикой конфиденциальности</a></p>
            </label>
            <button class="btn btn-secondary"><span>Зарегистрироваться</span></button>
            <hr>
            <p>Уже зарегистрировались? <a href="/auth/">Перейти к авторизации</a></p>
        </form>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>