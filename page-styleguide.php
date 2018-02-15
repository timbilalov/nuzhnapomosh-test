<?
require_once ('header.php');
?>

<h1>Welcome to unfriend's html5 boilerplate</h1>
<p>"Эдиториум.ру" - сайт, созданный по материалам сборника "О редактировании и редакторах" Аркадия Эммануиловича Мильчина, который с 1944 года коллекционировал выдержки из статей, рассказов, фельетонов, пародий, писем и книг, где так или иначе затрагивается тема редакторской работы. Эта коллекция легла в основу обширной антологии, представляющей историю и природу редактирования в первоисточниках.</p>
<p>Если в абзаце выше вы видите кавычки-ёлочки, длинные тире и правильно расставленные переносы слов, то, значит, включен типограф. При необходимости его можно отключить в настройках проекта, в файле <span class="g-nobr">header.php</span></p>
<p>Далее представлены типовые элементы, основные блоки и то, из чего может состоять сайт. Для типографики используется normalize.css, а дополнительные стили прописаны по-минимуму (так как для каждого проекта они будут разные).</p>

<section>
    <hr>

    <h1>Heading 1</h1>
    <h2>Heading 2</h2>
    <h3>Heading 3</h3>
    <h4>Heading 4</h4>
    <h5>Heading 5</h5>
    <h6>Heading 6</h6>
</section>

<section>
    <hr>

    <h5>Иконки</h5>

    <p>
        <strong>Важно!</strong>
        <br/>
        Данные иконки отрисованы на размере холста (он же - атрибут viewport у svg) 200x200 px. Для векторных иконок, отрисованных линиями (svg-icon--stroke), очень важно сохранять одинаковый размер холста. Договаривайтесь с дизайнерами, чтобы они рисовали иконки на холсте одного и того же размера - тогда толщина линий будет одинаковая.
        <br/><br/>
    </p>

    <p>Обычный размер, обычные иконки</p>
    <div>
        <svg class="svg-icon svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-45">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-temp-eye"></use>
        </svg>
    </div>

    <p>Увеличенный размер</p>
    <div style="font-size: 3em;">
        <svg class="svg-icon svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-45">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-temp-eye"></use>
        </svg>
    </div>

    <p>C обводкой</p>
    <div>
        <svg class="svg-icon svg-icon--border svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke svg-icon--rotate-45">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--border svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--border">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-temp-eye"></use>
        </svg>
    </div>

    <p>C заливкой</p>
    <div>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke svg-icon--rotate-45">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-right"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke svg-icon--rotate-90">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke svg-icon--rotate-180">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill svg-icon--stroke svg-icon--rotate-270">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arr-down"></use>
        </svg>
        <svg class="svg-icon svg-icon--fill">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-temp-eye"></use>
        </svg>
    </div>

    <p>Меню</p>
    <div>
        <div class="burger svg-icon svg-icon--stroke">
            <?
            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/svg/sprite/menu.svg');
            ?>
        </div>

        <div class="burger svg-icon svg-icon--stroke svg-icon--border">
            <?
            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/svg/sprite/menu.svg');
            ?>
        </div>

        <div class="burger svg-icon svg-icon--stroke svg-icon--fill">
            <?
            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/svg/sprite/menu.svg');
            ?>
        </div>

        <script>
            // Этот скрипт только для примера
            (function() {
                var btns = document.querySelectorAll(".burger");
                var activeClass = "is-active";
                var btnClick = function() {
                    this.classList.toggle(activeClass);
                };

                for (var i = btns.length - 1; i >= 0; i--) {
                    btns[i].addEventListener("click", btnClick, false);
                }

                return;
            })();
        </script>
    </div>
</section>

<section>
    <hr>

    <h5>Абзац с типовыми (inline) ссылками, разной длины. Для оформления ссылок мы отказались от обычного text-decoration в пользу других методов.</h5>
    <p>Lorem <a href="#">ipsum</a> dolor sit amet, consectetur adipisicing elit. <a href="#">Numquam maiores assumenda at!</a> Distinctio perspiciatis aspernatur iste totam eius neque, adipisci, quibusdam omnis quia autem voluptate officiis, dolor! Inventore atque, deleniti vero aliquid culpa ipsum ea, repellendus eaque maiores sit, rerum quibusdam modi omnis debitis magnam. Assumenda, inventore. At veritatis voluptatibus labore delectus, aliquid eaque. <a href="#">Aspernatur, a voluptatibus excepturi! Eveniet, laboriosam omnis quasi natus vero facere consequuntur cumque, veniam rerum explicabo ipsum. Maxime beatae minus, fugit saepe sunt esse pariatur eligendi inventore magnam omnis.</a> Voluptatem earum animi voluptas. Omnis molestiae nisi, illo veritatis repudiandae nobis rem odio quis. Similique, voluptas, <a href="#">enim</a>!</p>
</section>

<section>
    <hr>

    <h5>Таблица без дополнительных стилей</h5>
    <p>Для таблиц предусмотрена адаптивность следующего вида. При уменьшении размера экрана, таблица превращается в блоки, где каждый ряд значений представлен отдельным элементом. Столбцы и строки при этом транспонируются. Данный способ основан на следующей технике: <a href="http://codepen.io/anon/pen/QwPVNW" target="_blank" rel="nofollow">http://codepen.io/anon/pen/QwPVNW</a></p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, nostrum a optio itaque iusto reprehenderit nulla, natus dolor repellat ex!</p>
    <table>
        <thead>
            <tr>
                <th>Name 1</th>
                <th>Name 2</th>
                <th>Name 3</th>
                <th>Name 4</th>
                <th>Name 5</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Value 1.1</td>
                <td>Value 1.2</td>
                <td>Value 1.3</td>
                <td>Value 1.4</td>
                <td>Value 1.5</td>
            </tr>
            <tr>
                <td>Value 2.1</td>
                <td>Value 2.2</td>
                <td>Value 2.3</td>
                <td>Value 2.4</td>
                <td>Value 2.5</td>
            </tr>
            <tr>
                <td>Value 3.1</td>
                <td>Value 3.2</td>
                <td>Value 3.3</td>
                <td>Value 3.4</td>
                <td>Value 3.5</td>
            </tr>
            <tr>
                <td>Value 4.1</td>
                <td>Value 4.2</td>
                <td>Value 4.3</td>
                <td>Value 4.4</td>
                <td>Value 4.5</td>
            </tr>
        </tbody>
    </table>


    <h5>Пример таблицы, свёрстанной неверно (напр., через визивик), у которой отсутствует thead и\или tbody</h5>
    <table>
        <tbody>
            <tr>
                <td>Name 1</td>
                <td>Name 2</td>
                <td>Name 3</td>
                <td>Name 4</td>
                <td>Name 5</td>
            </tr>
            <tr>
                <td>Value 1.1</td>
                <td>Value 1.2</td>
                <td>Value 1.3</td>
                <td>Value 1.4</td>
                <td>Value 1.5</td>
            </tr>
            <tr>
                <td>Value 2.1</td>
                <td>Value 2.2</td>
                <td>Value 2.3</td>
                <td>Value 2.4</td>
                <td>Value 2.5</td>
            </tr>
            <tr>
                <td>Value 3.1</td>
                <td>Value 3.2</td>
                <td>Value 3.3</td>
                <td>Value 3.4</td>
                <td>Value 3.5</td>
            </tr>
            <tr>
                <td>Value 4.1</td>
                <td>Value 4.2</td>
                <td>Value 4.3</td>
                <td>Value 4.4</td>
                <td>Value 4.5</td>
            </tr>
        </tbody>
    </table>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus unde veritatis dolore architecto explicabo totam inventore earum, sit natus id.</p>
</section>

<?
require_once 'pages-list.php';
?>


<section>
    <hr>

    <h5>Всплывашки на сайте</h5>
    <p>Была проделана работа по изучению разных способов инициализации всплывашек и возможности отмены скролла у страницы в то время, как всплывашка открыта. Идеальных вариантов не существует, но мы к нему приблизились ;)</p>
    <p class="g-tac">
        <button class="js-open-popup" data-popup-selector="#tst">normal popup</button>
        <button class="js-open-popup" data-popup-selector="#tst-2">popup without BG close</button>
    </p>
    <p>Для того, чтобы открыть всплывашку, достаточно прописать доп. класс и data-атрибут любому элементу. Сам код всплывашки часто бывает удобно писать там же, где и расположена кнопка, её открывающая. Но при этом с т. з. вёрстки лучше, чтобы все всплывахи были в конце тега body. Здесь такая возможность предусмотрена (с помощью js).</p>

    <div class="popup g-hidden" id="tst">
        <div class="popup__content">
            <a role="button" class="popup__close js-close-popup" title="Закрыть">
                <svg class="svg-icon svg-icon--stroke svg-icon--contain svg-icon--rotate-45">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
                </svg>
            </a>

            <h2>Modal winow (normal)</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, quidem distinctio. Quos debitis temporibus maxime voluptatibus! Deleniti nesciunt atque inventore ut voluptatibus deserunt. Tempora ut unde blanditiis natus id commodi.
            </p>
        </div>
    </div>

    <div class="popup g-hidden" id="tst-2" data-bg-close="false">
        <div class="popup__content">
            <a role="button" class="popup__close js-close-popup" title="Закрыть">
                <svg class="svg-icon svg-icon--stroke svg-icon--contain svg-icon--rotate-45">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
                </svg>
            </a>

            <h2>Modal winow (without close on background click)</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, quidem distinctio. Quos debitis temporibus maxime voluptatibus! Deleniti nesciunt atque inventore ut voluptatibus deserunt. Tempora ut unde blanditiis natus id commodi.
            </p>
        </div>
    </div>
</section>


<section>
    <hr>

    <h5>Нумерованный список</h5>

    <ol>
        <li>Item first level 1</li>
        <li>
            Item first level 2
            <ol>
                <li>Item first level 2 second level 1</li>
                <li>Item first level 2 second level 2</li>
                <li>
                    Item first level 2 second level 3
                    <ol>
                        <li>First 2, second 3, third 1</li>
                        <li>First 2, second 3, third 2</li>
                    </ol>
                </li>
            </ol>
        </li>
        <li>Item first level 3</li>
        <li>
            Item first level 4
            <ul>
                <li>Marked item 1</li>
                <li>Marked item 2</li>
                <li>Marked item 3</li>
            </ul>
        </li>
        <li>Item first level 5</li>
    </ol>


    <h5>Маркированный список</h5>

    <ul>
        <li>Item first level 1</li>
        <li>
            Item first level 2
            <ul>
                <li>Item first level 2 second level 1</li>
                <li>Item first level 2 second level 2</li>
                <li>
                    Item first level 2 second level 3
                    <ul>
                        <li>First 2, second 3, third 1</li>
                        <li>First 2, second 3, third 2</li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Item first level 3</li>
        <li>
            Item first level 4
            <ol>
                <li>Numered item 1</li>
                <li>Numered item 2</li>
                <li>Numered item 3</li>
            </ol>
        </li>
        <li>Item first level 5</li>
    </ul>
</section>


<section class="g-preparing is-preparing">
    <hr class="g-show-preparing">

    <h5 class="g-show-preparing">Пример блока с анимацией загрузки</h5>

    <div style="height: 200px"></div>
</section>


<section>
    <hr>

    <h2>Forms</h2>

    <form>
        <fieldset>
            <legend>Inputs as descendents of labels (form legend)</legend>
            <p><label>Text input <input type="text" value="value"></label></p>
            <p><label>Text input (required) <input type="text" required></label></p>
            <p><label>Text input (with pattern requirement and placeholder) <input type="text" pattern="\d{5}(-\d{4})?" title="a US Zip code, with or without the +4 exension" placeholder="12345-6789"></label></p>
            <p><label>Email input <input type="email"></label></p>
            <p><label>Search input <input type="search"></label></p>
            <p><label>Tel input <input type="tel"></label></p>
            <p><label>URL input <input type="url" placeholder="http://"></label></p>
            <p><label>Password input <input type="password" value="password"></label></p>
            <p><label>File input <input type="file"></label></p>

            <p><label>Radio input <input type="radio" name="rad"></label></p>
            <p><label>Checkbox input <input type="checkbox"></label></p>
            <p><label><input type="radio" name="rad"> Radio input</label></p>
            <p><label><input type="checkbox"> Checkbox input</label></p>

            <p><label>Select field <select><option>Option 01</option><option>Option 02</option></select></label></p>
            <p><label>Textarea <textarea cols="30" rows="5" >Textarea text</textarea></label></p>
        </fieldset>

        <fieldset>
            <legend>Inputs as siblings of labels</legend>
            <p><label for="ic">Color input</label> <input type="color" id="ic"></p>
            <p><label for="in">Number input</label> <input type="number" id="in" min="0" max="10"></p>
            <p><label for="ir">Range input</label> <input type="range" id="ir"></p>
            <p><label for="idd">Date input</label> <input type="date" id="idd"></p>
            <p><label for="idm">Month input</label> <input type="month" id="idm"></p>
            <p><label for="idw">Week input</label> <input type="week" id="idw"></p>
            <p><label for="idtl">Datetime-local input</label> <input type="datetime-local" id="idtl"></p>

            <p><label for="irb">Radio input</label> <input type="radio" id="irb" name="rad"></p>
            <p><label for="icb">Checkbox input</label> <input type="checkbox" id="icb"></p>
            <p><input type="radio" id="irb2" name="rad"> <label for="irb2">Radio input</label></p>
            <p><input type="checkbox" id="icb2"> <label for="icb2">Checkbox input</label></p>

            <p><label for="s">Select field</label> <select id="s"><option>Option 01</option><option>Option 02</option></select></p>
            <p><label for="t">Textarea</label> <textarea id="t" cols="30" rows="5" >Textarea text</textarea></p>
        </fieldset>

        <fieldset>
            <legend>Clickable inputs and buttons</legend>
            <p><input type="image" src="/media/images/simple-image-example-2.jpg" alt="Image (input)"></p>
            <p><input type="reset" value="Reset (input)"></p>
            <p><input type="button" value="Button (input)"></p>
            <p><input type="submit" value="Submit (input)"></p>

            <p><button type="reset">Reset (button)</button></p>
            <p><button type="button">Button (button)</button></p>
            <p><button type="submit">Submit (button)</button></p>
        </fieldset>
    </form>


    <hr>
    <h5>Пример реальной формы (типовая, "Задать вопрос")</h5>
    <?
    require($_SERVER["DOCUMENT_ROOT"] . "/include/feedback-form-example.php");
    ?>
</section>



<section>
    <hr>
    <h5>Пример небольшой статьи или врезки (тег &lt;article&gt;)</h5>

    <article>
        <h4>Article Heading 2</h4>
        <address>Address: somewhere, world</address>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m.</p>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m.</p>
    </article>
</section>


<section>
    <hr>

    <h5>Text-level semantics</h5>

    <p>
        The <a href="#">a element</a> example<br>
        The <abbr title="Title text">abbr element</abbr> example<br>
        The <b>b element</b> example<br>
        The <cite>cite element</cite> example<br>
        The <code>code element</code> example<br>
        The <del>del element</del> example<br>
        The <dfn>dfn element</dfn> example<br>
        The <em>em element</em> example<br>
        The <i>i element</i> example<br>
        The img element <img src="/media/images/simple-image-example-2.jpg" width="16" height="16" alt=""> example<br>
        The <ins>ins element</ins> example<br>
        The <kbd>kbd element</kbd> example<br>
        The <mark>mark element</mark> example<br>
        The <q>q element <q>inside</q> a q element</q> example<br>
        The <s>s element</s> example<br>
        The <samp>samp element</samp> example<br>
        The <small>small element</small> example<br>
        The <span>span element</span> example<br>
        The <strong>strong element</strong> example<br>
        The <sub>sub element</sub> example<br>
        The <sup>sup element</sup> example<br>
        The <var>var element</var> example<br>
        The <u>u element</u> example
    </p>
</section>



<section>
    <hr>


    <h5>Grouping content</h5>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m.</p>

    <h5>pre</h5>
    <pre>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et me.</pre>

    <h5>code</h5>
    <pre>
        <code>
&lt;html&gt;
&lt;head&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;div class="main"&gt; &lt;div&gt;
&lt;/body&gt;
&lt;/html&gt;
        </code>
    </pre>
    <pre>
        <code>
#import &lt;UIKit/UIKit.h&gt;
#import "Dependency.h"

@protocol WorldDataSource
@optional
- (NSString*)worldName;
@required
- (BOOL)allowsToLive;
@end

@property (nonatomic, readonly) NSString *title;
- (IBAction) show;
@end
        </code>
    </pre>

    <h5>blockquote</h5>
    <blockquote>
        <p>Some sort of famous witty quote marked up with a &lt;blockquote> and a child &lt;p> element.</p>
    </blockquote>
    <blockquote>Even better philosophical quote marked up with just a &lt;blockquote> element.</blockquote>
</section>


<section>
    <hr>

    <h3>description list</h3>

    <dl>
        <dt>Description name</dt>
        <dd>Description value</dd>
        <dt>Description name</dt>
        <dd>Description value</dd>
        <dd>Description value</dd>
        <dt>Description name</dt>
        <dt>Description name</dt>
        <dd>Description value</dd>
    </dl>
</section>


<section>
    <hr>

    <h5>Произвольное большое изображение</h5>
    <p>На мобилках не должно вылезать за пределы экрана</p>

    <img src="/media/images/simple-image-example.jpg" width="1400" height="400" alt="Тестовое изображение">
</section>


<section>
    <hr>

    <h3>figure</h3>

    <figure>
        <img src="/media/images/simple-image-example-2.jpg" width="400" height="400" alt="Тестовое изображение 2">
        <figcaption>Figcaption content</figcaption>
    </figure>
</section>


<section>
    <hr>
    <p>Пример вывода частей верстки через функцию view()</p>

    <?
    // Дефолтный вывод подлючаемой части.
    // Настройки по-умолчанию заданы в файле /include/views/heading.php
    view('heading');

    // Подключение с параметрами, массив будет преобразован
    // в переменные $h=3 и $text='Heading 3' в подключаемой части.
    view('heading', array('h' => '3', 'text' => 'Heading 3'));

    // То же, что в примере выше, но с другими значениями.
    view('heading', array('h' => '4', 'text' => 'Heading 4'));

    // Подключение с параметрами. compact преобразует
    // переменные h и text в массив
    // array('h' => '5', 'text' => 'Heading 5'),
    // а дальше так же как в примерах выше.
    $h = 5;
    $text = 'Heading 5';
    view('heading', compact('h', 'text'));

    // Снова дефолтный вывод подлючаемой части,
    // переменные $h = 5 и $text = 'Heading 5',
    // объявленные выше, не передадутся в подлючаемую часть,
    // т. к. в функции view локальная область видимости.
    view('heading');
    ?>
</section>


<?
require ('footer.php');
?>