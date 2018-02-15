<?
// Some project options
$projectName = 'nuzhnapomosh-test';

// Debugging options
$unitTests = $_GET['unit'] == '1';
$serverName = $_SERVER['SERVER_NAME'];
$debug = $serverName == $projectName ? true : ($_COOKIE['debug'] == '1' || $_GET['debug'] == '1');
if ($_GET['debug'] == '0') { $debug = false; }

// Check for local server
$isLocal = ($serverName == $projectName) || (strpos($serverName, "localhost") !== false) || (strpos($serverName, "192.168") !== false) || (strpos($serverName, "10.42") !== false);

// Typograph
$useTypograph = true;

if ($debug) {
    $useTypograph = false;
}

// Set assets build path
if ($debug) {
    $buildDest = "/assets/build/dev/";
} else {
    $buildDest = "/assets/build/prod/";
}

require_once "functions.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/SpamProtection.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><? if ($debug) { echo "[debug] ";} ?><?=$projectName?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lte IE 8]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Web fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic" rel="stylesheet">

    <? // Main styles ?>
    <? if ($debug) { ?>
    <link rel="stylesheet" href="<?=$buildDest?>project.dev.css?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].$buildDest.'project.dev.css'); ?>" media="all" />
    <? } else { ?>
    <link rel="stylesheet" href="<?=$buildDest?>project.min.css?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].$buildDest.'project.min.css'); ?>" media="all" />
    <? } ?>


    <? if ($unitTests) { ?>
    <link rel="stylesheet" href="/assets/scripts/unit-tests/mocha-2.1.0.min.css" media="all" />
    <? } ?>
</head>

<body>
    <?
    // Dev only!
    // Перелинковка страниц
    // + некоторые отладочные функции
    if ($debug) { ?>
        <a role="button" class="pg-list js-open-popup" data-popup-selector="#pages" title="Перелинковка страниц">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACwElEQVRIS6WVy4uOURyAjftlg40o7Eju17JhZaGkbBUGITZuud+GGbeJIokJ4zP+BElmQ8mC3AlZuEWWZOXO80y/M52m7/2+b3Lq6Zz3fc/53X/nretR+5jP1rPwB9ZAey1H62rYNJg9J2BZCPdIT7gAm+BrJRnVFCzgcAuMgJewIoS3Mo+BD7AarhUpKVIwhAMnYQn8gmPQAN9D0ADmJtgQCkvMG+FLV0XlFCxkk7EeDk/C6vsFFs7m/UUYCx/B3FzN9+YKhvLhFCyGn3AQDsW6QH7H6/7hjR6Ym8uwHj77MSlYxPoMDIN7YfXTSlLLfMu9+RTeXFHBJVgK36ABjPfvbgpP2/XmAGwOb9pUYBi2wQ/YB8f/Q0E/zjaGgr/MTSlEc3hog9FwB5bDi256MTOiMY75DViBt5OCufFRBQ7LUW9qCVff2GsUesX5t8yG/ZYKDsNWMER71QrnQUvuhjfPC7yZGoZNZH4Gq0Bj90MfaFaBXWlITHLKQe9Yb2E24R5ojrW6PLwLdkIy0sZzr8Yqx3y0pBB5kXkljIQ8B9N5tpG00PKtB2vdytP6R2Gc8/jYay7egVdIezkFWpjnQIHJWisjDS0+At6uudV+fx8KrqvAW9FLzBAZkldwDkZBnoNJPNuMClwLxlyrSzADXsNKmAWWvglvVYGWbAevh5SDQaytIJOmN11zYI6sGovCfJwOGV6MqQ80pDGFSAuM9QTIczCPZytKb1IOPKPV5sd61/ubkPfBY54tnIf5ZWc97wlLrIbUBwPDG5NmKTu02nDlN4BrrTY8XpRGpPOyi3Md0zTQG2Oe50BvrDSFGLobkPeBlVQPWt85in44WrgbdoTASn2gMPNow3ZYXYuCtGcKixJMhnJ98ID3xtofU9lR7Z/sIb2xY+2FvA+8lo+ClVM4alGQDqc+sADWgX1QdfwDuwq0dIjwkZIAAAAASUVORK5CYII=" alt="">
        </a>

        <div class="popup g-hidden" id="pages">
            <div class="popup__content popup__content--wide">
                <a role="button" class="popup__close js-close-popup" title="Закрыть">
                    <svg class="svg-icon svg-icon--stroke svg-icon--contain svg-icon--rotate-45">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
                    </svg>
                </a>

                <?
                require 'pages-list.php';
                ?>
            </div>
        </div>

        <a role="button" class="pg-list pg-list--2 js-toggle-styles" title="Показать без стилей">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACY0lEQVRIS2NkoDFgpLH5DHAL7MKzNBmZWCz+//1PkaX/mBn////z+9jR1dNvghwPNszRL0b9k4rf8V8yZoL///+j0FOMDKzPTr0VvLbOfN/2lXfBFtj7RtZ9krGvZeQW+Euh6WDtzN/fMXE/OlR7YPOKTrAFLo6OUcGhoUtNTc2oYT7DyZMnGNZv2BC+Z8+eVWALnB0cIgpLSpd7eHhQxYKtW7cyTJw4IWzfvn2rh5EFRaXUDaIJE9CCCGKBJ5XiYAsD0Rb8//+fgZGRkQFEJyUmMEyfMZOBnZ0dLIYLbN2KwwJPT4QPnj59yrBh/XqwwTm5uQzPnj1jaG9rY5g8ZQpDHpBva2fHAFLPw8ODYc+WLXgsuHDhAsPaNWsYzp49y2BpackQHBLCoKWlxbBz506GRw8fMqSmpTHs2rWLYSvQkHv37jG4u7szBAYFMUhLS8MtwmtBTHQ0w8+fPxlqamsZ9PX14Zp6e3vBFlpZWYHFQD5bt3Ytw6xZs8CWFBUXE7KgbDnIyyBXbdy4gWHvnj0MKioqDDExsQwmpqbg8J84aTIDLy8vw+rVqxk2AdX8+PGDwc/Pj8Hbx5dBSEgIzYJ+1IxWXAaxAAY+f/7MsH3bNobv378z+AINKS8rY5g9Zw5YurKigsHRyYnB0dGRgZWVFWsc9PcTsABZ1/lz5xguXrrEkJCQQFQyBsUBigWuTk6xhSUli5B9QJRJOBRBLYgClkXLwYnZy8tLgpube4uAgAAXJQbD9H54+/brxy9fvIGp7RU8tzg4OEgAFfyhhgXMQLB3796XILMoqh6JcczQtwAAqGNBKNrASpwAAAAASUVORK5CYII=" alt="">
        </a>

        <a role="button" class="pg-list pg-list--3 js-toggle-images" title="Показать без изображений">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAABFUlEQVQ4T2NkoDJgpLJ5DDQxcCfQldxUculHkAsPALEDlQw8gGxgG9BQLyAuBeLdZFoAN9AfaMAHqCEgw9woNRDk5TVA7A3E6UC8CIeBdVDxJhzyKF4m5KggoIK1UEVhQHo1Fg1EGygH1HwBiAWhhnwE0gZA/ADNUKwGsgEV9QDxfCA+D8QsQHwQiK3QNJ8E8m2A+A+SOFYD+4AKCqG2g1xRBsRVOMKjCyhejs9AUKRsBmJYDjoBZJsBMRMOA/8DxT2AeBdUHsWFUkDBi0AsgkMzLuFXQAl9IH4BxHADnYCcvUDsQKJhMOV7gAxQ2t0PyyklQE4KmYbBtM0EMvpBBm4FYn4KDYNpf0eT4otKjoMYQ3UXAgDbKTd827WhZAAAAABJRU5ErkJggg==" alt="">
        </a>
    <? } ?>

    <div class="l-wrapper">
        <?
        if ($useTypograph) {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/typograph/EMT.php');
            $typograph = new EMTypograph();

            // настройки
            $options = array(
                'Text.paragraphs'=>'off',
                'Text.breakline'=>'off',
                'OptAlign.oa_oquote'=>'off',

                'Nobr.phone_builder'=>'off',
                'Number.thinsp_between_no_and_number'=>'off',
                'Number.thinsp_between_number_triads'=>'off',
                'Nobr.spaces_nobr_in_surname_abbr'=>'off',

                'Symbol.arrows_symbols'=> 'off',
            );
            $typograph->setup($options);

            ob_start();
        }
        ?>

        <?php
        // Warning bar for users with disabled JS
        ?>
        <noscript class="noscript-bar">
            <!--<noindex>-->
                <input type="checkbox" id="noscript-checkbox" class="noscript-bar__checkbox">
                <div class="noscript-bar__content">
                    <div class="l-container">
                        <div class="noscript-bar__cols">
                            <div class="noscript-bar__col">Для наиболее комфортного просмотра сайта, включите, пожалуйста, JavaScript в настройках браузера</div>
                            <div class="noscript-bar__col">
                                <label for="noscript-checkbox" title="Закрыть">
                                    <?
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/svg/sprite/close.svg');
                                    ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            <!--</noindex>-->
        </noscript>


        <header class="l-header page-header js-mobmenu">
            <div class="page-header__container">
                <div class="page-header__content">
                    <div class="page-header__top-row">
                        <a <? if ($page != "main") echo 'href="/"'; ?> class="page-header__block page-header__logo">
                            <span class="page-header__logo-img"></span>
                        </a>


                        <a role="button" class="page-header__burger burger js-mobmenu-toggle svg-icon svg-icon--stroke">
                            <?
                            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/svg/sprite/menu.svg');
                            ?>
                        </a>
                    </div>

                    <div class="page-header__block page-header__nav js-mobmenu-expand">
                        <nav class="main-menu">
                            <a href="#" class="main-menu__item">Каталог</a>
                            <a href="#" class="main-menu__item">Новости</a>
                            <a href="#" class="main-menu__item">О нас</a>
                            <a href="#" class="main-menu__item">Контакты</a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <div class="l-content">
            <? if (!$rawContainer) { ?>
            <div class="l-container">
            <? } ?>