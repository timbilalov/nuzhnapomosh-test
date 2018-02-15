<?php

/**
 * Created by PhpStorm.
 * User: web
 * Date: 27.01.2017
 * Time: 17:25
 */
class SpamProtection
{
    public static $antispamSalt = "K3jPjmYPmVcwhLHp";//задайте соль здесь

    public static $antispam2Salt = "5d41402abc4b2a76b9719d911017c592";//не трогать эти соли!
    public static $antispam3Salt = "7d793037a0760186574b0282f2f435e7";//не трогать эти соли!


    /**
     * Генерирует токен для поле с капчей
     *
     * @return string
     */
    public static function getToken()
    {
        // Генерим UTC метку времени.
        $utcStr = gmdate("M d Y H:i:s", time());
        $utcTimestamp = strtotime($utcStr);
        $antispamIpAddress = $_SERVER['REMOTE_ADDR'];
        if(!self::$antispamSalt){
            die('Задайте соль для капчи в SpamProtection::11');
        }
        // Выводим скрытое поле
        $md5 = md5(self::$antispamSalt.$antispamIpAddress.$utcTimestamp);
        $antispamGeneratedValue = base64_encode($antispamIpAddress."-".$utcTimestamp).".".$md5;

        return $antispamGeneratedValue;
    }

    /**
     * Генерирует input с токеном
     *
     * @return string
     */
    public static function getField()
    {
        $html = '<input type="hidden" name="antispam" value="' . self::getToken() . '">';

        // Если это скрытое поле будет заполнено - значит заполнил бот
        $html .= '<input type="text" name="last_name" style="display: none;">';

        echo $html;
    }


    /**
     * Проверка на ботов,
     * включающая в себя различные критерии:
     * как на стороне сервера, так и на стороне клиента.
     *
     * @param int $timeDeltaMin минимальное время заполнения формы
     * @param int $timeDeltaMax максимальное время заполнения формы
     * @return string возвращает строку с ошибками
     */
    public static function check($timeDeltaMin = 7, $timeDeltaMax = 7200)
    {
        if (!self::$antispamSalt || !self::$antispam2Salt || !self::$antispam3Salt){
            die("Задайте соль для капчи");
        }

        $formParams = self::getReceivedParams();
        $antispam = $formParams["antispam"];
        $antispam2 = $formParams["antispam2"];
        $antispam3 = $formParams["antispam3"];
        $lastName = $formParams["lastName"];

        $errorsDescriptions = array(
            "1" => "Не заполнено основное антиспам-поле (php)",
            "2.1" => "Не заполнено поле, которое выводится спустя короткое время после загрузки страницы (js)",
            "2.2" => "Поле, которое выводится спустя короткое время после загрузки страницы, заполнено неверно (js)",
            "3.1" => "Не заполнено поле, которое выводится после определённого действия пользователя на странице (js)",
            "3.2" => "Поле, которое выводится после определённого действия пользователя на странице, заполнено неверно (js)",
            "4" => "Заполнено поле, которое скрыто через style=\"display: none;\" (css)",
            "5.1" => "Форма заполнена слишком быстро (php)",
            "5.2" => "Форма заполнена слишком долго (php)",
            "6" => "Не совпадает хэш от первоначальной метки времени",
        );

        // Если не заполнено основное антиспам-поле,
        // которые выводится вместе с вёрсткой самой формы.
        if (is_null($antispam)) {
            $errors[] = "1";
        }

        // Если не заполнено поле, которые выводится с помощью js
        // спустя пару секунд после загрузки страницы.
        if (is_null($antispam2)) {
            $errors[] = "2.1";
        }

        // Если поле, которые выводится с помощью js
        // спустя пару секунд после загрузки страницы,
        // заполнено неверно.
        if (!is_null($antispam2) && strpos(base64_decode($antispam2), self::$antispam2Salt) == false) {
            $errors[] = "2.2";
        }

        // Если не заполнено поле, которые выводится с помощью js
        // при совершении пользователем некоторого действия,
        // например, фокус на одном из полей формы.
        if (is_null($antispam3)) {
            $errors[] = "3.1";
        }

        // Если поле, которые выводится с помощью js
        // при совершении пользователем некоторого действия,
        // например, фокус на одном из полей формы,
        // заполнено неверно.
        if (!is_null($antispam3) && strpos(base64_decode($antispam3), self::$antispam3Salt) == false) {
            $errors[] = "3.2";
        }

        // Если заполнено поле, скрытое через style="display: none;"
        // (обычным пользователем не должно быть заполнено).
        if ($lastName != "") {
            $errors[] = "4";
        }

        // Генерим UTC метку времени.
        $utcStr = gmdate("M d Y H:i:s", time());
        $utcTimestamp = strtotime($utcStr);

        // Высчитываем разницу во времени
        // между выводом формы и её отправкой.
        $utcTimestampReceived = $ipReceived = base64_decode(substr($antispam, 0, strpos($antispam, ".")));
        $utcTimestampReceived = substr($utcTimestampReceived, strpos($utcTimestampReceived, "-") + 1);
        $ipReceived = str_replace("-$utcTimestampReceived", '', $ipReceived);
        $timestampsDelta = $utcTimestamp - $utcTimestampReceived;

        // Предполагаем, что пользователь заполняет форму не меньше $timeDeltaMin секунд
        if ($timestampsDelta < $timeDeltaMin) {
            $errors[] = "5.1";
        }

        // Предполагаем, что пользователь заполняет форму не дольше, чем $timeDeltaMax сек
        if ($timestampsDelta > $timeDeltaMax) {
            $errors[] = "5.2";
        }

        // Также проверяем хэш от первоначальной метки времени.
        $antispamIpAddress = $_SERVER["REMOTE_ADDR"];
        $recievedStrMd5 = substr($antispam, strpos($antispam, ".") + 1);

        $ipNotMatch='';
        if($ipReceived != $antispamIpAddress){
            $ipNotMatch = ' IP not match!';
        }elseif (md5(self::$antispamSalt . $antispamIpAddress . $utcTimestampReceived) != $recievedStrMd5) {
            $errors[] = "6";
        }


        // Как при определении бота,
        // так и при прохождении всех проверок,
        // отправляем сообщение в логгер, со всей необходимой
        // дополнительной информацией.
        // Разница будет лишь в заголовках сообщений и их статусе.
        $extra = array(
            "ip" => $antispamIpAddress,
            "timeDeltaMin" => $timeDeltaMin,
            "timeDeltaMax" => $timeDeltaMax,
            "timestampsDelta" => $timestampsDelta,
            "lastName" => $lastName,
        );
        require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/sentry/lib/Raven/Autoloader.php";
        Raven_Autoloader::register();
        $sentryClient = new Raven_Client('https://4b8183ec9ad54b2791b63192ce1bc854:8de643982ce54f83a99e8a4c4626f378@sentry.io/286501');

        // Если хотя бы одна проверка сработала,
        // то фиксируем бота.
        if (count($errors) > 0) {
            $loggerMessageTitle = "[antispam] bot detected. triggers: " . implode(", ", $errors);
            foreach ($errors as $value) {
                $extra["trigger " . $value] = $errorsDescriptions[$value];
            }
            $sentryClient->captureMessage($loggerMessageTitle, array("level" => "warning"), array(
                "extra" => $extra
            ));


            // Необходимо вернуть значение true,
            // т. к. в дальнейшем это используется примерно так:
            // $formAntispamError = $formSubmitted ? SpamProtection::check() : false;
            return true;


        // Если все проверки пройдены,
        // то фиксируем настоящего пользователя,
        // производим отправку формы.
        } else {
            $loggerMessageTitle = "[antispam] normal user detected" . $ipNotMatch;
            $sentryClient->captureMessage($loggerMessageTitle, array("level" => "info"), array(
                "level" => "info",
                "extra" => $extra,
            ));
        }

        return false;
    }

    /**
     * Возвращает массив
     * с полученными параметрами из формы.
     *
     * @return array
     */
    public static function getReceivedParams()
    {
        if (isset($_POST["antispam"])) {
            $antispam = $_POST["antispam"];
        } elseif (isset($_GET["antispam"])) {
            $antispam = $_GET["antispam"];
        } else {
            $antispam = null;
        }

        if (isset($_POST["antispam2"])) {
            $antispam2 = $_POST["antispam2"];
        } elseif (isset($_GET["antispam2"])) {
            $antispam2 = $_GET["antispam2"];
        } else {
            $antispam2 = null;
        }

        if (isset($_POST["antispam3"])) {
            $antispam3 = $_POST["antispam3"];
        } elseif (isset($_GET["antispam3"])) {
            $antispam3 = $_GET["antispam3"];
        } else {
            $antispam3 = null;
        }

        if (isset($_POST["last_name"])) {
            $lastName = $_POST["last_name"];
        } elseif (isset($_GET["last_name"])) {
            $lastName = $_GET["last_name"];
        } else {
            $lastName = "";
        }

        $resArray = array(
            "antispam" => $antispam,
            "antispam2" => $antispam2,
            "antispam3" => $antispam3,
            "lastName" => $lastName,
        );

        return $resArray;
    }
}