<?php
/**
 * Эта вьюха помогает добавлять картинки
 * Пример подключения <? view('img', array('picture' => $arItem['PREVIEW_PICTURE'], 'extra' => array('class' => 'some class', 'slide' =>'1'))); ?>
 */
$string = '';
if(isset($extra) && $extra){
    $string = [];
    foreach ($extra as $attr => $value) {
        $string [] = "$attr=\"$value\"";
    }
    $string = implode(' ', $string);
}
?>
<img src="<?= $picture['SRC'] ?>" width="<?= $picture['WIDTH'] ?>" height="<?= $picture['HEIGHT'] ?>" alt="<?= $picture['ALT'] ?>" <?= $string; ?>" >



