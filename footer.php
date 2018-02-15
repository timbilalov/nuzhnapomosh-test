            <? if (!$rawContainer) { ?>
            </div><? // end of .l-container ?>
            <? } ?>
        </div><? // end of .l-content ?>

        <footer class="l-footer page-footer <? if ($rawContainer || $noMargins) echo 'page-footer--no-margin'; ?>">
            <div class="l-container page-footer__content">
                <div class="page-footer__block page-footer__copyright">
                    &copy;&nbsp;2017
                    Проект Благотворительного фонда "Нужна помощь"
                </div>

                <div class="page-footer__block page-footer__creators">
                    Все права защищены
                </div>
            </div>
        </footer>

        <?
        // TODO: Типограф всё-таки очень долго работает... Эх...
        // Решить бы с ним что-нибудь.
        if ($useTypograph) {
            $content = ob_get_contents();
            ob_end_clean();

            $typograph->set_text($content);
            $contentTypographed = $typograph->apply();
            echo $contentTypographed ? $contentTypographed : $content;
        }
        ?>

        <? // SVG icons ?>
        <div id="svg-container" class="g-hidden"></div>

        <?
        if ($isLocal) { ?>
        <div class="g-hidden" id="js-server-local"></div>
        <? } ?>

        <?
        if ($debug) { ?>
        <div class="g-hidden" id="js-server-debug"></div>
        <? } ?>

        <?
        // Load unit tests library
        if ($unitTests) { ?>
        <div class="g-hidden" id="js-unit-tests"></div>
        <div id="mocha"></div>
        <script src="/assets/scripts/unit-tests/chai-2.1.1.min.js"></script>
        <script src="/assets/scripts/unit-tests/mocha-2.2.1.min.js"></script>
        <script src="/assets/scripts/unit-tests/mocha-clean-0.3.0.js"></script>
        <script>
            mocha.setup('bdd');
            mocha.traceIgnores = ['mocha-2.2.1.min.js', 'chai-2.1.1.min.js'];
            expect = chai.expect;
        </script>
        <? } ?>

        <?
        // Load scripts for debug
        if ($debug) { ?>
        <script src="/assets/build/dev/svg-sprite.js?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/build/dev/svg-sprite.js'); ?>"></script>
        <script src="/assets/scripts/debug-flag-enabled.js"></script>
        <script src="/assets/scripts/app.js?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/scripts/app.js'); ?>"></script>

        <?
        // Iterator method.
        // Because glob with GLOB_BRACE doesn't work properly on Windows
        $docRoot = rtrim($_SERVER["DOCUMENT_ROOT"], "/");
        $Directory = new RecursiveDirectoryIterator($docRoot.'/assets/scripts/modules/');
        $Iterator = new RecursiveIteratorIterator($Directory);
        $Regex = new RegexIterator($Iterator, '/^.+\.js$/i', RecursiveRegexIterator::GET_MATCH);
        foreach ($Regex as $path) {
            $realPath = realpath($path[0]);
            $realPath = str_replace('\\', '/', $realPath);
            $assetPath = substr($realPath, strlen($docRoot));
            echo '<script src="'.$assetPath.'?'.filemtime($realPath).'"></script>';
        }
        ?>

        <?
        // Production scripts
        } else { ?>
        <script src="<?=$buildDest?>project.min.js?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].$buildDest.'project.min.js'); ?>" defer></script>
        <? } ?>

    </div><? // end of .l-wrapper ?>
    <?
    // Main content ends here
    // ----------------------
    ?>
</body>
</html>