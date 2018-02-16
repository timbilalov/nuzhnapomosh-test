<?
$formSubmitted = count($_POST) > 0;
$formAntispamError = $formSubmitted ? SpamProtection::check() : false;

// Это спам, который не прошёл защиту.
// При желании - можно что-нибудь с этим сделать.
// Как вариант - отсылать на какой-нибудь служебный адрес, чтобы проверить,
// действительно ли это спам, или, вдруг, произошла какая-то ошибка.
if ($formSubmitted && $formAntispamError):
    ?>
    <div class="js-form-errors form__antispam">
        Не пройдена антиспам-проверка.
    </div>
    <?

// Это случай, когда всё заполнено правильно, все проверки на спам пройдены.
// В данном примере выводится сообщение, но на продакте должно быть
// что-то нормально, оправка письма или типа того.
elseif ($formSubmitted && !$formAntispamError):
    echo "Форма отправлена!";

// Это случай, когда форма ещё не отправлена, а только выводится в вёрстку,
// либо отправлена, но не пройдено одно из двух условий
else:
    ?>
    <form class="form js-form-validate" data-ajax-submit="true" name="ask-question" action="#" method="POST"
          onsubmit="console.log('onsubmit event fired. remove it on production!');"
          data-parsley-required-message="Пожалуйста, заполните поле">
        <?= SpamProtection::getField(); ?>

        <div class="g-relative--full-sized">
            <div class="form__state form__state--1">
                <h2 class="form__title">Обратная связь</h2>

                <div class="form__sections">
                    <div class="form__sect">
                        <label class="form__label" for="lastname">Фамилия</label>
                        <div class="form__input-wrapper">
                            <input type="text" id="lastname" name="lastname" value="<?= isset($_POST["lastname"]) ? $_POST["lastname"] : '' ?>" placeholder="Введите вашу фамилию" required>
                        </div>
                    </div>

                    <div class="form__sect">
                        <label class="form__label" for="firstname">Имя</label>
                        <div class="form__input-wrapper">
                            <input type="text" id="firstname" name="firstname" value="<?= isset($_POST["firstname"]) ? $_POST["firstname"] : '' ?>" placeholder="Введите ваше имя" required>
                        </div>
                    </div>

                    <div class="form__sect">
                        <label class="form__label" for="middlename">Отчество</label>
                        <div class="form__input-wrapper">
                            <input type="text" id="middlename" name="middlename" value="<?= isset($_POST["middlename"]) ? $_POST["middlename"] : '' ?>" placeholder="Введите ваше отчество" required>
                        </div>
                    </div>

                    <div class="form__sect">
                        <label class="form__label" for="email">Электронный адрес</label>
                        <div class="form__input-wrapper">
                            <input type="email" id="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : '' ?>" placeholder="Введите ваш E-mail" required data-parsley-type-message="Укажите корректный электронный адрес">
                        </div>
                    </div>

                    <div class="form__sect">
                        <label class="form__label" for="tel">Контактный телефон</label>
                        <div class="form__input-wrapper">
                            <input type="tel" id="tel" name="tel" value="<?= isset($_POST["tel"]) ? $_POST["tel"] : '' ?>" placeholder="+7" required>
                        </div>
                    </div>

                    <div class="form__sect">
                        <label class="form__label" for="message">Сообщение</label>
                        <div class="form__input-wrapper">
                            <textarea name="message" id="message" placeholder="Введите ваше сообщение" minlength="5" required data-parsley-minlength-message="Не менее 5 символов"><?= isset($_POST["message"]) ? $_POST["message"] : '' ?></textarea>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Отправить" class="form__submit btn btn--block btn--orange">
            </div>

            <div class="form__state form__state--2">
                <div class="form__thanks">
                    <div class="form__thank-title">Спасибо!</div>
                    <div class="form__thank-subtitle">Ваше сообщение отправлено</div>
                </div>
            </div>
        </div>
    </form>
<? endif; ?>