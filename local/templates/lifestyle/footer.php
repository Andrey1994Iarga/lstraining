<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
IncludeTemplateLangFile(__FILE__);
global $cont;
?>
</main>
<?if(!CSite::InDir("/auth/")):?>
    <footer>
        <p>© 2014–<?=date ( 'Y' );?> «Lifestyle Education»</p><a href="#">Политика конфиденциальности</a><a href="#">Пользовательское соглашение</a><a href="#">Сделано в Affetta</a>
    </footer>
<?endif;?>
<div class="quiz__modal--overlay">
    <div class="quiz__modal">
        <div class="close">&#215;</div>
        <div class="quiz__modal--wrapper active">
            <div class="quiz__modal--header"><span>вопрос 1 / 15</span>
                <h3>Какой главный показатель эффективности работы контакт-центра?</h3>
            </div>
            <div class="quiz__modal--body">
                <form class="quiz__form">
                    <fieldset class="quiz__form--image">
                        <label>
                            <input type="radio" name="img">
                            <div class="image"><img src="assets/images/quiz-form.jpg">
                                <p>Среднее время ожидание ответа</p>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="img">
                            <div class="image"><img src="assets/images/quiz-form.jpg">
                                <p>Среднее время ожидание ответа</p>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="img">
                            <div class="image"><img src="assets/images/quiz-form.jpg">
                                <p>Среднее время ожидание ответа</p>
                            </div>
                        </label>
                        <label>
                            <input type="radio" name="img">
                            <div class="image"><img src="assets/images/quiz-form.jpg">
                                <p>Среднее время ожидание ответа</p>
                            </div>
                        </label>
                    </fieldset>
                    <button class="btn btn-primary" disabled="disabled"><span>Отправить</span></button>
                </form>
            </div>
        </div>
        <div class="quiz__modal--wrapper">
            <div class="quiz__modal--header"><span>вопрос 1 / 15</span>
                <h3>Какой главный показатель эффективности работы контакт-центра?</h3>
            </div>
            <div class="quiz__modal--body">
                <form class="quiz__form">
                    <fieldset class="quiz__form--text">
                        <label>
                            <input type="text" name="text">
                        </label>
                    </fieldset>
                    <button class="btn btn-primary" disabled="disabled"><span>Отправить</span></button>
                </form>
            </div>
        </div>
        <div class="quiz__modal--wrapper">
            <div class="quiz__modal--header"><span>вопрос 1 / 15</span>
                <h3>Какой главный показатель эффективности работы контакт-центра?</h3><img src="assets/images/quiz-header.jpg">
            </div>
            <div class="quiz__modal--body">
                <form class="quiz__form">
                    <fieldset class="quiz__form--checkbox">
                        <label>
                            <input type="checkbox" name="check">
                            <p>Среднее время ожидание ответа</p>
                        </label>
                        <label>
                            <input type="checkbox" name="check">
                            <p>Процент приема обращений</p>
                        </label>
                        <label>
                            <input type="checkbox" name="check">
                            <p>Среднее время разговора</p>
                        </label>
                        <label>
                            <input type="checkbox" name="check">
                            <p>Показатель жалоб на операторов</p>
                        </label>
                    </fieldset>
                    <button class="btn btn-primary" disabled="disabled"><span>Завершить</span></button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>