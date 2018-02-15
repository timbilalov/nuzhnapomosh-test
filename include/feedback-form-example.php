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
                <h2 class="form__title">Задайте вопрос</h2>

                <div class="form__sections">
                    <div class="form__sect cf">
                        <div class="form__col">
                            <div class="form__input-wrapper">
                                <input type="text" name="name" value="<?= isset($_POST["name"]) ? $_POST["name"] : '' ?>" placeholder="ФИО" required>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__input-wrapper">
                                <input type="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : '' ?>" placeholder="E-mail"
                                       required data-parsley-type-message="Укажите E-mail в правильном формате">
                            </div>
                        </div>
                    </div>

                    <div class="form__sect">
                        <div class="form__input-wrapper">
                            <textarea name="question" placeholder="Вопрос" minlength="5"
                                      required><?= isset($_POST["question"]) ? $_POST["question"] : '' ?></textarea>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Отправить" class="form__submit btn btn--big">
            </div>

            <div class="form__state form__state--2">
                <div class="form__thanks">
                    <div class="form__thank-title">Спасибо!</div>
                    <div class="form__thank-subtitle">Ваш вопрос отправлен</div>
                </div>
            </div>
        </div>
    </form>
<? endif; ?>