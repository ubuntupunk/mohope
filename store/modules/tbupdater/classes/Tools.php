<?php
/**
 * Copyright (C) 2017-2019 thirty bees
 * Copyright (C) 2007-2016 PrestaShop
 *
 * thirty bees is an extension to the PrestaShop software by PrestaShop SA.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    thirty bees <contact@thirtybees.com>
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2017-2019 thirty bees
 * @copyright 2007-2016 PrestaShop SA
 * @license   https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * PrestaShop is an internationally registered trademark of PrestaShop SA.
 */

namespace TbUpdaterModule;

use TbUpdaterModule\GuzzleHttp\Client;

/**
 * Class Tools
 * @since 1.0.0
 */
class Tools
{
    // @codingStandardsIgnoreStart
    public static $round_mode = null;
    protected static $file_exists_cache = [];
    protected static $_forceCompile;
    protected static $_caching;
    protected static $_user_plateform;
    protected static $_user_browser;
    protected static $_cache_nb_media_servers = null;
    protected static $is_addons_up = true;
    // @codingStandardsIgnoreEnd

    /**
     * Random password generator
     *
     * @param int    $length Desired length (optional)
     * @param string $flag   Output type (NUMERIC, ALPHANUMERIC, NO_NUMERIC, RANDOM)
     *
     * @return bool|string Password
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function passwdGen($length = 8, $flag = 'ALPHANUMERIC')
    {
        $length = (int) $length;

        if ($length <= 0) {
            return false;
        }

        switch ($flag) {
            case 'NUMERIC':
                $str = '0123456789';
                break;
            case 'NO_NUMERIC':
                $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'RANDOM':
                $numBytes = (int) ceil($length * 0.75);
                $bytes = self::getBytes($numBytes);

                return substr(rtrim(base64_encode($bytes), '='), 0, $length);
            case 'ALPHANUMERIC':
            default:
                $str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }

        $bytes = static::getBytes($length);
        $position = 0;
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $position = ($position + ord($bytes[$i])) % strlen($str);
            $result .= $str[$position];
        }

        return $result;
    }

    /**
     * Random bytes generator
     *
     * Thanks to Zend for entropy
     *
     * @param int $length Desired length of random bytes
     *
     * @return bool|string Random bytes
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getBytes($length)
    {
        $length = (int) $length;

        if ($length <= 0) {
            return false;
        }

        if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length, $cryptoStrong);

            if ($cryptoStrong === true) {
                return $bytes;
            }
        }

        if (function_exists('mcrypt_create_iv')) {
            $bytes = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);

            if ($bytes !== false && strlen($bytes) === $length) {
                return $bytes;
            }
        }

        // Else try to get $length bytes of entropy.
        // Thanks to Zend

        $result = '';
        $entropy = '';
        $msecPerRound = 400;
        $bitsPerRound = 2;
        $total = $length;
        $hashLength = 20;

        while (strlen($result) < $length) {
            $bytes = ($total > $hashLength) ? $hashLength : $total;
            $total -= $bytes;

            for ($i = 1; $i < 3; $i++) {
                $t1 = microtime(true);
                $seed = mt_rand();

                for ($j = 1; $j < 50; $j++) {
                    $seed = sha1($seed);
                }

                $t2 = microtime(true);
                $entropy .= $t1.$t2;
            }

            $div = (int) (($t2 - $t1) * 1000000);

            if ($div <= 0) {
                $div = 400;
            }

            $rounds = (int) ($msecPerRound * 50 / $div);
            $iter = $bytes * (int) (ceil(8 / $bitsPerRound));

            for ($i = 0; $i < $iter; $i++) {
                $t1 = microtime();
                $seed = sha1(mt_rand());

                for ($j = 0; $j < $rounds; $j++) {
                    $seed = sha1($seed);
                }

                $t2 = microtime();
                $entropy .= $t1.$t2;
            }

            $result .= sha1($entropy, true);
        }

        return substr($result, 0, $length);
    }

    /**
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @param int    $cur
     *
     * @return mixed
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function strReplaceFirst($search, $replace, $subject, $cur = 0)
    {
        return (strpos($subject, $search, $cur)) ? substr_replace($subject, $replace, (int) strpos($subject, $search, $cur), strlen($search)) : $subject;
    }

    /**
     * Redirect URLs already containing PS_BASE_URI
     *
     * @param string $url Desired URL
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function redirectLink($url)
    {
        if (!preg_match('@^https?://@i', $url)) {
            if (strpos($url, __PS_BASE_URI__) !== false && strpos($url, __PS_BASE_URI__) == 0) {
                $url = substr($url, strlen(__PS_BASE_URI__));
            }
            if (strpos($url, 'index.php?controller=') !== false && strpos($url, 'index.php/') == 0) {
                $url = substr($url, strlen('index.php?controller='));
            }
            $explode = explode('?', $url);
            $url = Context::getContext()->link->getPageLink($explode[0]);
            if (isset($explode[1])) {
                $url .= '?'.$explode[1];
            }
        }
        header('Location: '.$url);
        exit;
    }

    /**
     * Redirect user to another admin page
     *
     * @param string $url Desired URL
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function redirectAdmin($url)
    {
        header('Location: '.$url);
        exit;
    }

    /**
     * getShopProtocol return the available protocol for the current shop in use
     * SSL if Configuration is set on and available for the server
     *
     * @return String
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getShopProtocol()
    {
        $protocol = (Configuration::get('PS_SSL_ENABLED') || (!empty($_SERVER['HTTPS'])
                && static::strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' : 'http://';

        return $protocol;
    }

    /**
     * @param string $str
     *
     * @return bool|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function strtolower($str)
    {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($str, 'utf-8');
        }

        return strtolower($str);
    }

    /**
     * getProtocol return the set protocol according to configuration (http[s])
     *
     * @param bool $useSsl true if require ssl
     *
     * @return String (http|https)
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getProtocol($useSsl = null)
    {
        return (!is_null($useSsl) && $useSsl ? 'https://' : 'http://');
    }

    /**
     * Get the server variable REMOTE_ADDR, or the first ip of HTTP_X_FORWARDED_FOR (when using proxy)
     *
     * @return string $remote_addr ip of client
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getRemoteAddr()
    {
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }

        if (array_key_exists('X-Forwarded-For', $headers)) {
            $_SERVER['HTTP_X_FORWARDED_FOR'] = $headers['X-Forwarded-For'];
        }

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && (!isset($_SERVER['REMOTE_ADDR'])
                || preg_match('/^127\..*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^172\.16.*/i', trim($_SERVER['REMOTE_ADDR']))
                || preg_match('/^192\.168\.*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^10\..*/i', trim($_SERVER['REMOTE_ADDR'])))
        ) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')) {
                $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                return $ips[0];
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * Get the current url prefix protocol (https/http)
     *
     * @return string protocol
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getCurrentUrlProtocolPrefix()
    {
        if (static::usingSecureMode()) {
            return 'https://';
        } else {
            return 'http://';
        }
    }

    /**
     * Check if the current page use SSL connection on not
     *
     * @return bool uses SSL
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function usingSecureMode()
    {
        if (isset($_SERVER['HTTPS'])) {
            return in_array(static::strtolower($_SERVER['HTTPS']), [1, 'on']);
        }
        // $_SERVER['SSL'] exists only in some specific configuration
        if (isset($_SERVER['SSL'])) {
            return in_array(static::strtolower($_SERVER['SSL']), [1, 'on']);
        }
        // $_SERVER['REDIRECT_HTTPS'] exists only in some specific configuration
        if (isset($_SERVER['REDIRECT_HTTPS'])) {
            return in_array(static::strtolower($_SERVER['REDIRECT_HTTPS']), [1, 'on']);
        }
        if (isset($_SERVER['HTTP_SSL'])) {
            return in_array(static::strtolower($_SERVER['HTTP_SSL']), [1, 'on']);
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            return static::strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https';
        }

        return false;
    }

    /**
     * Secure an URL referrer
     *
     * @param string $referrer URL referrer
     *
     * @return string secured referrer
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function secureReferrer($referrer)
    {
        if (preg_match('/^http[s]?:\/\/'.static::getServerName().'(:'._PS_SSL_PORT_.')?\/.*$/Ui', $referrer)) {
            return $referrer;
        }

        return __PS_BASE_URI__;
    }

    /**
     * Get the server variable SERVER_NAME
     *
     * @return string server name
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getServerName()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_SERVER']) && $_SERVER['HTTP_X_FORWARDED_SERVER']) {
            return $_SERVER['HTTP_X_FORWARDED_SERVER'];
        }

        return $_SERVER['SERVER_NAME'];
    }

    /**
     * Get all values from $_POST/$_GET
     *
     * @return mixed
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getAllValues()
    {
        return $_POST + $_GET;
    }

    /**
     * @param string $key
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getIsset($key)
    {
        if (!isset($key) || empty($key) || !is_string($key)) {
            return false;
        }

        return isset($_POST[$key]) ? true : (isset($_GET[$key]) ? true : false);
    }

    /**
     * Change language in cookie while clicking on a flag
     *
     * @param \Cookie|null $cookie
     *
     * @return string ISO code
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function setCookieLanguage(\Cookie $cookie = null)
    {
        if (!$cookie) {
            $cookie = Context::getContext()->cookie;
        }
        /* If language does not exist or is disabled, erase it */
        if ($cookie->id_lang) {
            $lang = new Language((int) $cookie->id_lang);
            if (!Validate::isLoadedObject($lang) || !$lang->active || !$lang->isAssociatedToShop()) {
                $cookie->id_lang = null;
            }
        }

        if (!Configuration::get('PS_DETECT_LANG')) {
            unset($cookie->detect_language);
        }

        /* Automatically detect language if not already defined, detect_language is set in Cookie::update */
        if (!static::getValue('isolang') && !static::getValue('id_lang') && (!$cookie->id_lang || isset($cookie->detect_language))
            && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])
        ) {
            $array = explode(',', static::strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']));
            $string = $array[0];

            if (Validate::isLanguageCode($string)) {
                $lang = Language::getLanguageByIETFCode($string);
                if (Validate::isLoadedObject($lang) && $lang->active && $lang->isAssociatedToShop()) {
                    Context::getContext()->language = $lang;
                    $cookie->id_lang = (int) $lang->id;
                }
            }
        }

        if (isset($cookie->detect_language)) {
            unset($cookie->detect_language);
        }

        /* If language file not present, you must use default language file */
        if (!$cookie->id_lang || !Validate::isUnsignedId($cookie->id_lang)) {
            $cookie->id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        }

        $iso = Language::getIsoById((int) $cookie->id_lang);
        @include_once(_PS_THEME_DIR_.'lang/'.$iso.'.php');

        return $iso;
    }

    /**
     * Get a value from $_POST / $_GET
     * if unavailable, take a default value
     *
     * @param string $key          Value key
     * @param mixed  $defaultValue (optional)
     *
     * @return mixed Value
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getValue($key, $defaultValue = false)
    {
        if (!isset($key) || empty($key) || !is_string($key)) {
            return false;
        }

        $ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $defaultValue));

        if (is_string($ret)) {
            return stripslashes(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret))));
        }

        return $ret;
    }

    /**
     * Set cookie id_lang
     *
     * @param Context $context
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function switchLanguage(Context $context = null)
    {
        if (!$context) {
            $context = Context::getContext();
        }

        // Install call the dispatcher and so the switchLanguage
        // Stop this method by checking the cookie
        if (!isset($context->cookie)) {
            return;
        }

        if (($iso = static::getValue('isolang')) && Validate::isLanguageIsoCode($iso) && ($idLang = (int) Language::getIdByIso($iso))) {
            $_GET['id_lang'] = $idLang;
        }

        // update language only if new id is different from old id
        // or if default language changed
        $cookieIdLang = $context->cookie->id_lang;
        $configurationIdLang = Configuration::get('PS_LANG_DEFAULT');
        if ((($idLang = (int) static::getValue('id_lang')) && Validate::isUnsignedId($idLang) && $cookieIdLang != (int) $idLang)
            || (($idLang == $configurationIdLang) && Validate::isUnsignedId($idLang) && $idLang != $cookieIdLang)
        ) {
            $context->cookie->id_lang = $idLang;
            $language = new Language($idLang);
            if (Validate::isLoadedObject($language) && $language->active) {
                $context->language = $language;
            }

            $params = $_GET;
            if (Configuration::get('PS_REWRITING_SETTINGS') || !Language::isMultiLanguageActivated()) {
                unset($params['id_lang']);
            }
        }
    }

    /**
     * @param null $address
     *
     * @return int
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getCountry($address = null)
    {
        $idCountry = (int) static::getValue('id_country');
        if ($idCountry && Validate::isInt($idCountry)) {
            return (int) $idCountry;
        } elseif (!$idCountry && isset($address) && isset($address->id_country) && $address->id_country) {
            $idCountry = (int) $address->id_country;
        } elseif (Configuration::get('PS_DETECT_COUNTRY') && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            preg_match('#(?<=-)\w\w|\w\w(?!-)#', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $array);
            if (is_array($array) && isset($array[0]) && Validate::isLanguageIsoCode($array[0])) {
                $idCountry = (int) \Country::getByIso($array[0], true);
            }
        }
        if (!isset($idCountry) || !$idCountry) {
            $idCountry = (int) Configuration::get('PS_COUNTRY_DEFAULT');
        }

        return (int) $idCountry;
    }

    /**
     * Check if submit has been posted
     *
     * @param string $submit submit name
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function isSubmit($submit)
    {
        return (
            isset($_POST[$submit]) || isset($_POST[$submit.'_x']) || isset($_POST[$submit.'_y'])
            || isset($_GET[$submit]) || isset($_GET[$submit.'_x']) || isset($_GET[$submit.'_y'])
        );
    }

    /**
     * @param $number
     * @param $currency
     *
     * @return string
     *
     * @todo    : move to intl
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function displayNumber($number, $currency)
    {
        if (is_array($currency)) {
            $format = $currency['format'];
        } elseif (is_object($currency)) {
            $format = $currency->format;
        }

        return number_format($number, 0, '.', in_array($format, [1, 4]) ? ',' : ' ');
    }

    /**
     * returns the rounded value of $value to specified precision, according to your configuration;
     *
     * @note    : PHP 5.3.0 introduce a 3rd parameter mode in round function
     *
     * @param float $value
     * @param int   $precision
     *
     * @return float
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function ps_round($value, $precision = 0, $roundMode = null)
    {
        if ($roundMode === null) {
            if (static::$round_mode == null) {
                static::$round_mode = (int) Configuration::get('PS_PRICE_ROUND_MODE');
            }

            $roundMode = static::$round_mode;
        }

        switch ($roundMode) {
            case PS_ROUND_UP:
                return static::ceilf($value, $precision);
            case PS_ROUND_DOWN:
                return static::floorf($value, $precision);
            case PS_ROUND_HALF_DOWN:
            case PS_ROUND_HALF_EVEN:
            case PS_ROUND_HALF_ODD:
                return static::math_round($value, $precision, $roundMode);
            case PS_ROUND_HALF_UP:
            default:
                return static::math_round($value, $precision, PS_ROUND_HALF_UP);
        }
    }

    /**
     * returns the rounded value up of $value to specified precision
     *
     * @param float $value
     * @param int   $precision
     *
     * @return float
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function ceilf($value, $precision = 0)
    {
        $precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
        $tmp = $value * $precisionFactor;
        $tmp2 = (string) $tmp;
        // If the current value has already the desired precision
        if (strpos($tmp2, '.') === false) {
            return ($value);
        }
        if ($tmp2[strlen($tmp2) - 1] == 0) {
            return $value;
        }

        return ceil($tmp) / $precisionFactor;
    }

    /**
     * returns the rounded value down of $value to specified precision
     *
     * @param float $value
     * @param int   $precision
     *
     * @return float
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function floorf($value, $precision = 0)
    {
        $precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
        $tmp = $value * $precisionFactor;
        $tmp2 = (string) $tmp;
        // If the current value has already the desired precision
        if (strpos($tmp2, '.') === false) {
            return ($value);
        }
        if ($tmp2[strlen($tmp2) - 1] == 0) {
            return $value;
        }

        return floor($tmp) / $precisionFactor;
    }

    /**
     * @param     $value
     * @param     $places
     * @param int $mode
     *
     * @return float|int
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function math_round($value, $places, $mode = PS_ROUND_HALF_UP)
    {
        //If PHP_ROUND_HALF_UP exist (PHP 5.3) use it and pass correct mode value (PrestaShop define - 1)
        if (defined('PHP_ROUND_HALF_UP')) {
            return round($value, $places, $mode - 1);
        }

        $precisionPlaces = 14 - floor(log10(abs($value)));
        $f1 = pow(10.0, (double) abs($places));

        /* If the decimal precision guaranteed by FP arithmetic is higher than
        * the requested places BUT is small enough to make sure a non-zero value
        * is returned, pre-round the result to the precision */
        if ($precisionPlaces > $places && $precisionPlaces - $places < 15) {
            $f2 = pow(10.0, (double) abs($precisionPlaces));

            if ($precisionPlaces >= 0) {
                $tmpValue = $value * $f2;
            } else {
                $tmpValue = $value / $f2;
            }

            /* preround the result (tmp_value will always be something * 1e14,
            * thus never larger than 1e15 here) */
            $tmpValue = static::round_helper($tmpValue, $mode);
            /* now correctly move the decimal point */
            $f2 = pow(10.0, (double) abs($places - $precisionPlaces));
            /* because places < precision_places */
            $tmpValue = $tmpValue / $f2;
        } else {
            /* adjust the value */
            if ($places >= 0) {
                $tmpValue = $value * $f1;
            } else {
                $tmpValue = $value / $f1;
            }

            /* This value is beyond our precision, so rounding it is pointless */
            if (abs($tmpValue) >= 1e15) {
                return $value;
            }
        }

        /* round the temp value */
        $tmpValue = static::round_helper($tmpValue, $mode);

        /* see if it makes sense to use simple division to round the value */
        if (abs($places) < 23) {
            if ($places > 0) {
                $tmpValue /= $f1;
            } else {
                $tmpValue *= $f1;
            }
        }

        return $tmpValue;
    }

    /**
     * @param $value
     * @param $mode
     *
     * @return float
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function round_helper($value, $mode)
    {
        if ($value >= 0.0) {
            $tmpValue = floor($value + 0.5);

            if (($mode == PS_ROUND_HALF_DOWN && $value == (-0.5 + $tmpValue)) ||
                ($mode == PS_ROUND_HALF_EVEN && $value == (0.5 + 2 * floor($tmpValue / 2.0))) ||
                ($mode == PS_ROUND_HALF_ODD && $value == (0.5 + 2 * floor($tmpValue / 2.0) - 1.0))
            ) {
                $tmpValue = $tmpValue - 1.0;
            }
        } else {
            $tmpValue = ceil($value - 0.5);

            if (($mode == PS_ROUND_HALF_DOWN && $value == (0.5 + $tmpValue)) ||
                ($mode == PS_ROUND_HALF_EVEN && $value == (-0.5 + 2 * ceil($tmpValue / 2.0))) ||
                ($mode == PS_ROUND_HALF_ODD && $value == (-0.5 + 2 * ceil($tmpValue / 2.0) + 1.0))
            ) {
                $tmpValue = $tmpValue + 1.0;
            }
        }

        return $tmpValue;
    }

    /**
     * Implement array_replace for PHP <= 5.2
     *
     * @return array|mixed|null
     *
     * @deprecated 1.0.0 Use array_replace instead
     */
    public static function array_replace()
    {
        if (!function_exists('array_replace')) {
            $args = func_get_args();
            $numArgs = func_num_args();
            $res = [];
            for ($i = 0; $i < $numArgs; $i++) {
                if (is_array($args[$i])) {
                    foreach ($args[$i] as $key => $val) {
                        $res[$key] = $val;
                    }
                } else {
                    trigger_error(__FUNCTION__.'(): Argument #'.($i + 1).' is not an array', E_USER_WARNING);

                    return null;
                }
            }

            return $res;
        } else {
            return call_user_func_array('array_replace', func_get_args());
        }
    }

    /**
     * Display date regarding to language preferences
     *
     * @param array  $params Date, format...
     * @param object $smarty Smarty object for language preferences
     *
     * @return string Date
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function dateFormat($params, &$smarty)
    {
        return static::displayDate($params['date'], null, (isset($params['full']) ? $params['full'] : false));
    }

    /**
     * Display date regarding to language preferences
     *
     * @param string $date      Date to display format UNIX
     * @param int    $idLang    Language id DEPRECATED
     * @param bool   $full      With time or not (optional)
     * @param string $separator DEPRECATED
     *
     * @return string Date
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function displayDate($date, $idLang = null, $full = false, $separator = null)
    {
        if ($idLang !== null) {
            static::displayParameterAsDeprecated('id_lang');
        }
        if ($separator !== null) {
            static::displayParameterAsDeprecated('separator');
        }

        if (!$date || !($time = strtotime($date))) {
            return $date;
        }

        if ($date == '0000-00-00 00:00:00' || $date == '0000-00-00') {
            return '';
        }

        if (!Validate::isDate($date) || !Validate::isBool($full)) {
            throw new \Exception('Invalid date');
        }

        $context = Context::getContext();
        $dateFormat = ($full ? $context->language->date_format_full : $context->language->date_format_lite);

        return date($dateFormat, $time);
    }

    /**
     * Display a warning message indicating that the parameter is deprecated
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function displayParameterAsDeprecated($parameter)
    {
        $backtrace = debug_backtrace();
        $callee = next($backtrace);
        $error = 'Parameter <b>'.$parameter.'</b> in function <b>'.(isset($callee['function']) ? $callee['function'] : '').'()</b> is deprecated in <b>'.$callee['file'].'</b> on line <b>'.(isset($callee['line']) ? $callee['line'] : '(undefined)').'</b><br />';
        $message = 'The parameter '.$parameter.' in function '.$callee['function'].' (Line '.(isset($callee['line']) ? $callee['line'] : 'undefined').') is deprecated and will be removed in the next major version.';
        $class = isset($callee['class']) ? $callee['class'] : null;

        static::throwDeprecated($error, $message, $class);
    }

    protected static function throwDeprecated($error, $message, $class)
    {
        if (_PS_DISPLAY_COMPATIBILITY_WARNING_) {
            trigger_error($error, E_USER_WARNING);
        }
    }

    /**
     * @param string $string
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function htmlentitiesDecodeUTF8($string)
    {
        if (is_array($string)) {
            $string = array_map(['Tools', 'htmlentitiesDecodeUTF8'], $string);

            return (string) array_shift($string);
        }

        return html_entity_decode((string) $string, ENT_QUOTES, 'utf-8');
    }

    /**
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function safePostVars()
    {
        if (!isset($_POST) || !is_array($_POST)) {
            $_POST = [];
        } else {
            $_POST = array_map(['Tools', 'htmlentitiesUTF8'], $_POST);
        }
    }

    /**
     * Delete directory and subdirectories
     *
     * @param string $dirname Directory name
     * @param bool   $deleteSelf
     *
     * @return bool
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function deleteDirectory($dirname, $deleteSelf = true)
    {
        $dirname = rtrim($dirname, '/').'/';
        if (file_exists($dirname)) {
            if ($files = scandir($dirname)) {
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..' && $file != '.svn') {
                        if (is_dir($dirname.$file)) {
                            static::deleteDirectory($dirname.$file, true);
                        } elseif (file_exists($dirname.$file)) {
                            @chmod($dirname.$file, 0777); // NT ?
                            unlink($dirname.$file);
                        }
                    }
                }
                if ($deleteSelf && file_exists($dirname)) {
                    if (!rmdir($dirname)) {
                        @chmod($dirname, 0777); // NT ?

                        return false;
                    }
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Clear XML cache folder
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function clearXMLCache()
    {
    }

    /**
     * Delete file
     *
     * @param string $file         File path
     * @param array  $excludeFiles Excluded files
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function deleteFile($file, $excludeFiles = [])
    {
        if (isset($excludeFiles) && !is_array($excludeFiles)) {
            $excludeFiles = [$excludeFiles];
        }

        if (file_exists($file) && is_file($file) && array_search(basename($file), $excludeFiles) === false) {
            @chmod($file, 0777); // NT ?
            unlink($file);
        }
    }

    /**
     * Display a var dump in firebug console
     *
     * @param object $object Object to display
     *
     * @param string $type
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function fd($object, $type = 'log')
    {
        $types = ['log', 'debug', 'info', 'warn', 'error', 'assert'];

        if (!in_array($type, $types)) {
            $type = 'log';
        }

        echo '
			<script type="text/javascript">
				console.'.$type.'('.json_encode($object, JSON_PRETTY_PRINT).');
			</script>
		';
    }

    /**
     * ALIAS OF dieObject() - Display an error with detailed object
     *
     * @param object $object Object to display
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function d($object, $kill = true)
    {
        return (static::dieObject($object, $kill));
    }

    /**
     * Display an error with detailed object
     *
     * @param mixed $object
     * @param bool  $kill
     *
     * @return $object if $kill = false;
     */
    public static function dieObject($object, $kill = true)
    {
        echo '<xmp style="text-align: left;">';
        print_r($object);
        echo '</xmp><br />';

        if ($kill) {
            die('END');
        }

        return $object;
    }

    /**
     * @param int  $start
     * @param null $limit
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function debug_backtrace($start = 0, $limit = null)
    {
        $backtrace = debug_backtrace();
        array_shift($backtrace);
        for ($i = 0; $i < $start; ++$i) {
            array_shift($backtrace);
        }

        echo '
		<div style="margin:10px;padding:10px;border:1px solid #666666">
			<ul>';
        $i = 0;
        foreach ($backtrace as $id => $trace) {
            if ((int) $limit && (++$i > $limit)) {
                break;
            }
            $relativeFile = (isset($trace['file'])) ? 'in /'.ltrim(str_replace([_PS_ROOT_DIR_, '\\'], ['', '/'], $trace['file']), '/') : '';
            $currentLine = (isset($trace['line'])) ? ':'.$trace['line'] : '';

            echo '<li>
				<b>'.((isset($trace['class'])) ? $trace['class'] : '').((isset($trace['type'])) ? $trace['type'] : '').$trace['function'].'</b>
				'.$relativeFile.$currentLine.'
			</li>';
        }
        echo '</ul>
		</div>';
    }

    /**
     * ALIAS OF dieObject() - Display an error with detailed object but don't stop the execution
     *
     * @param object $object Object to display
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function p($object)
    {
        return (static::dieObject($object, false));
    }

    /**
     * Prints object information into error log
     *
     * @see     error_log()
     *
     * @param mixed       $object
     * @param int|null    $messageType
     * @param string|null $destination
     * @param string|null $extraHeaders
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function error_log($object, $messageType = null, $destination = null, $extraHeaders = null)
    {
        return error_log(print_r($object, true), $messageType, $destination, $extraHeaders);
    }

    /**
     * Display a warning message indicating that the method is deprecated
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function displayAsDeprecated($message = null)
    {
        $backtrace = debug_backtrace();
        $callee = next($backtrace);
        $class = isset($callee['class']) ? $callee['class'] : null;
        if ($message === null) {
            $message = 'The function '.$callee['function'].' (Line '.$callee['line'].') is deprecated and will be removed in the next major version.';
        }
        $error = 'Function <b>'.$callee['function'].'()</b> is deprecated in <b>'.$callee['file'].'</b> on line <b>'.$callee['line'].'</b><br />';

        static::throwDeprecated($error, $message, $class);
    }

    /**
     * Hash password with native `password_hash`
     *
     * @param string $password
     *
     * @return bool|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Encrypt data string
     *
     * @param string $data String to encrypt
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function encryptIV($data)
    {
        return md5(_COOKIE_IV_.$data);
    }

    /**
     * Get token to prevent CSRF
     *
     * @param string $token token to encrypt
     */
    public static function getToken($page = true, Context $context = null)
    {
        if (!$context) {
            $context = Context::getContext();
        }
        if ($page === true) {
            return (static::encrypt($context->customer->id.$context->customer->passwd.$_SERVER['SCRIPT_NAME']));
        } else {
            return (static::encrypt($context->customer->id.$context->customer->passwd.$page));
        }
    }

    /**
     * Encrypt password
     *
     * @param string $passwd String to encrypt
     */
    public static function encrypt($passwd)
    {
        return md5(_COOKIE_KEY_.$passwd);
    }

    public static function getAdminTokenLite($tab, Context $context = null)
    {
        if (!$context) {
            $context = Context::getContext();
        }

        return static::getAdminToken($tab.(int) Tab::getIdFromClassName($tab).(int) $context->employee->id);
    }

    /**
     * Tokenize a string
     *
     * @param string $string string to encript
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getAdminToken($string)
    {
        return !empty($string) ? static::encrypt($string) : false;
    }

    /**
     * @param array   $params
     * @param \Smarty $smarty
     *
     * @return bool|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getAdminTokenLiteSmarty($params, &$smarty)
    {
        $context = Context::getContext();

        return static::getAdminToken($params['tab'].(int) Tab::getIdFromClassName($params['tab']).(int) $context->employee->id);
    }

    /**
     * Get a valid image URL to use from BackOffice
     *
     * @param string $image   Image name
     * @param bool   $entites Set to true to use htmlentities function on image param
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getAdminImageUrl($image = null, $entities = false)
    {
        return static::getAdminUrl(basename(_PS_IMG_DIR_).'/'.$image, $entities);
    }

    /**
     * Get a valid URL to use from BackOffice
     *
     * @param string $url     An URL to use in BackOffice
     * @param bool   $entites Set to true to use htmlentities function on URL param
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getAdminUrl($url = null, $entities = false)
    {
        $link = static::getHttpHost(true).__PS_BASE_URI__;

        if (isset($url)) {
            $link .= ($entities ? static::htmlentitiesUTF8($url) : $url);
        }

        return $link;
    }

    /**
     * Truncate strings
     *
     * @param string $str
     * @param int    $max_length Max length
     * @param string $suffix     Suffix optional
     *
     * @return string $str truncated
     */
    /* CAUTION : Use it only on module hookEvents.
    ** For other purposes use the smarty function instead */
    /**
     * getHttpHost return the <b>current</b> host used, with the protocol (http or https) if $http is true
     * This function should not be used to choose http or https domain name.
     * Use static::getShopDomain() or static::getShopDomainSsl instead
     *
     * @param bool $http
     * @param bool $entities
     *
     * @return string host
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getHttpHost($http = false, $entities = false, $ignore_port = false)
    {
        $host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
        if ($ignore_port && $pos = strpos($host, ':')) {
            $host = substr($host, 0, $pos);
        }
        if ($entities) {
            $host = htmlspecialchars($host, ENT_COMPAT, 'UTF-8');
        }
        if ($http) {
            $host = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').$host;
        }

        return $host;
    }

    /**
     * @param     $string
     * @param int $type
     *
     * @return array|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function htmlentitiesUTF8($string, $type = ENT_QUOTES)
    {
        if (is_array($string)) {
            return array_map(['Tools', 'htmlentitiesUTF8'], $string);
        }

        return htmlentities((string) $string, $type, 'utf-8');
    }

    /**
     * Sanitize a string
     *
     * @param string $string String to sanitize
     * @param bool   $html   String contains HTML or not (optional)
     *
     * @return string Sanitized string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function safeOutput($string, $html = false)
    {
        if (!$html) {
            $string = strip_tags($string);
        }

        return @static::htmlentitiesUTF8($string, ENT_QUOTES);
    }

    /**
     * Display an error according to an error code
     *
     * @param string   $string       Error message
     * @param bool     $htmlentities By default at true for parsing error message with htmlentities
     * @param Context $context
     *
     * @return array|mixed|string
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function displayError($string = 'Fatal error', $htmlentities = true, Context $context = null)
    {
        global $_ERRORS;

        if (is_null($context)) {
            $context = Context::getContext();
        }

        @include_once(_PS_TRANSLATIONS_DIR_.$context->language->iso_code.'/errors.php');

        if (defined('_PS_MODE_DEV_') && _PS_MODE_DEV_ && $string == 'Fatal error') {
            return ('<pre>'.print_r(debug_backtrace(), true).'</pre>');
        }
        if (!is_array($_ERRORS)) {
            return $htmlentities ? static::htmlentitiesUTF8($string) : $string;
        }
        $key = md5(str_replace('\'', '\\\'', $string));
        $str = (isset($_ERRORS) && is_array($_ERRORS) && array_key_exists($key, $_ERRORS)) ? $_ERRORS[$key] : $string;

        return $htmlentities ? static::htmlentitiesUTF8(stripslashes($str)) : $str;
    }

    /**
     * Return the friendly url from the provided string
     *
     * @param string $str
     * @param bool   $utf8Decode (deprecated)
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function link_rewrite($str, $utf8Decode = null)
    {
        if ($utf8Decode !== null) {
            static::displayParameterAsDeprecated('utf8_decode');
        }

        return static::str2url($str);
    }

    /**
     * Return a friendly url made from the provided string
     * If the mbstring library is available, the output is the same as the js function of the same name
     *
     * @param string $str
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function str2url($str)
    {
        static $arrayStr = [];
        static $allowAccentedChars = null;
        static $hasMbStrtolower = null;

        if ($hasMbStrtolower === null) {
            $hasMbStrtolower = function_exists('mb_strtolower');
        }

        if (isset($arrayStr[$str])) {
            return $arrayStr[$str];
        }

        if (!is_string($str)) {
            return false;
        }

        if ($str == '') {
            return '';
        }

        if ($allowAccentedChars === null) {
            $allowAccentedChars = Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL');
        }

        $returnStr = trim($str);

        if ($hasMbStrtolower) {
            $returnStr = mb_strtolower($returnStr, 'utf-8');
        }
        if (!$allowAccentedChars) {
            $returnStr = static::replaceAccentedChars($returnStr);
        }

        // Remove all non-whitelist chars.
        if ($allowAccentedChars) {
            $returnStr = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]\-\p{L}]/u', '', $returnStr);
        } else {
            $returnStr = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]\-]/', '', $returnStr);
        }

        $returnStr = preg_replace('/[\s\'\:\/\[\]\-]+/', ' ', $returnStr);
        $returnStr = str_replace([' ', '/'], '-', $returnStr);

        // If it was not possible to lowercase the string with mb_strtolower, we do it after the transformations.
        // This way we lose fewer special chars.
        if (!$hasMbStrtolower) {
            $returnStr = static::strtolower($returnStr);
        }

        $arrayStr[$str] = $returnStr;

        return $returnStr;
    }

    /**
     * Replace all accented chars by their equivalent non accented chars.
     *
     * @param string $str
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function replaceAccentedChars($str)
    {
        /* One source among others:
            http://www.tachyonsoft.com/uc0000.htm
            http://www.tachyonsoft.com/uc0001.htm
            http://www.tachyonsoft.com/uc0004.htm
        */
        $patterns = [

            /* Lowercase */
            /* a  */
            '/[\x{00E0}\x{00E1}\x{00E2}\x{00E3}\x{00E4}\x{00E5}\x{0101}\x{0103}\x{0105}\x{0430}\x{00C0}-\x{00C3}\x{1EA0}-\x{1EB7}]/u',
            /* b  */
            '/[\x{0431}]/u',
            /* c  */
            '/[\x{00E7}\x{0107}\x{0109}\x{010D}\x{0446}]/u',
            /* d  */
            '/[\x{010F}\x{0111}\x{0434}\x{0110}]/u',
            /* e  */
            '/[\x{00E8}\x{00E9}\x{00EA}\x{00EB}\x{0113}\x{0115}\x{0117}\x{0119}\x{011B}\x{0435}\x{044D}\x{00C8}-\x{00CA}\x{1EB8}-\x{1EC7}]/u',
            /* f  */
            '/[\x{0444}]/u',
            /* g  */
            '/[\x{011F}\x{0121}\x{0123}\x{0433}\x{0491}]/u',
            /* h  */
            '/[\x{0125}\x{0127}]/u',
            /* i  */
            '/[\x{00EC}\x{00ED}\x{00EE}\x{00EF}\x{0129}\x{012B}\x{012D}\x{012F}\x{0131}\x{0438}\x{0456}\x{00CC}\x{00CD}\x{1EC8}-\x{1ECB}\x{0128}]/u',
            /* j  */
            '/[\x{0135}\x{0439}]/u',
            /* k  */
            '/[\x{0137}\x{0138}\x{043A}]/u',
            /* l  */
            '/[\x{013A}\x{013C}\x{013E}\x{0140}\x{0142}\x{043B}]/u',
            /* m  */
            '/[\x{043C}]/u',
            /* n  */
            '/[\x{00F1}\x{0144}\x{0146}\x{0148}\x{0149}\x{014B}\x{043D}]/u',
            /* o  */
            '/[\x{00F2}\x{00F3}\x{00F4}\x{00F5}\x{00F6}\x{00F8}\x{014D}\x{014F}\x{0151}\x{043E}\x{00D2}-\x{00D5}\x{01A0}\x{01A1}\x{1ECC}-\x{1EE3}]/u',
            /* p  */
            '/[\x{043F}]/u',
            /* r  */
            '/[\x{0155}\x{0157}\x{0159}\x{0440}]/u',
            /* s  */
            '/[\x{015B}\x{015D}\x{015F}\x{0161}\x{0441}]/u',
            /* ss */
            '/[\x{00DF}]/u',
            /* t  */
            '/[\x{0163}\x{0165}\x{0167}\x{0442}]/u',
            /* u  */
            '/[\x{00F9}\x{00FA}\x{00FB}\x{00FC}\x{0169}\x{016B}\x{016D}\x{016F}\x{0171}\x{0173}\x{0443}\x{00D9}-\x{00DA}\x{0168}\x{01AF}\x{01B0}\x{1EE4}-\x{1EF1}]/u',
            /* v  */
            '/[\x{0432}]/u',
            /* w  */
            '/[\x{0175}]/u',
            /* y  */
            '/[\x{00FF}\x{0177}\x{00FD}\x{044B}\x{1EF2}-\x{1EF9}\x{00DD}]/u',
            /* z  */
            '/[\x{017A}\x{017C}\x{017E}\x{0437}]/u',
            /* ae */
            '/[\x{00E6}]/u',
            /* ch */
            '/[\x{0447}]/u',
            /* kh */
            '/[\x{0445}]/u',
            /* oe */
            '/[\x{0153}]/u',
            /* sh */
            '/[\x{0448}]/u',
            /* shh*/
            '/[\x{0449}]/u',
            /* ya */
            '/[\x{044F}]/u',
            /* ye */
            '/[\x{0454}]/u',
            /* yi */
            '/[\x{0457}]/u',
            /* yo */
            '/[\x{0451}]/u',
            /* yu */
            '/[\x{044E}]/u',
            /* zh */
            '/[\x{0436}]/u',

            /* Uppercase */
            /* A  */
            '/[\x{0100}\x{0102}\x{0104}\x{00C0}\x{00C1}\x{00C2}\x{00C3}\x{00C4}\x{00C5}\x{0410}]/u',
            /* B  */
            '/[\x{0411}]/u',
            /* C  */
            '/[\x{00C7}\x{0106}\x{0108}\x{010A}\x{010C}\x{0426}]/u',
            /* D  */
            '/[\x{010E}\x{0110}\x{0414}]/u',
            /* E  */
            '/[\x{00C8}\x{00C9}\x{00CA}\x{00CB}\x{0112}\x{0114}\x{0116}\x{0118}\x{011A}\x{0415}\x{042D}]/u',
            /* F  */
            '/[\x{0424}]/u',
            /* G  */
            '/[\x{011C}\x{011E}\x{0120}\x{0122}\x{0413}\x{0490}]/u',
            /* H  */
            '/[\x{0124}\x{0126}]/u',
            /* I  */
            '/[\x{0128}\x{012A}\x{012C}\x{012E}\x{0130}\x{0418}\x{0406}]/u',
            /* J  */
            '/[\x{0134}\x{0419}]/u',
            /* K  */
            '/[\x{0136}\x{041A}]/u',
            /* L  */
            '/[\x{0139}\x{013B}\x{013D}\x{0139}\x{0141}\x{041B}]/u',
            /* M  */
            '/[\x{041C}]/u',
            /* N  */
            '/[\x{00D1}\x{0143}\x{0145}\x{0147}\x{014A}\x{041D}]/u',
            /* O  */
            '/[\x{00D3}\x{014C}\x{014E}\x{0150}\x{041E}]/u',
            /* P  */
            '/[\x{041F}]/u',
            /* R  */
            '/[\x{0154}\x{0156}\x{0158}\x{0420}]/u',
            /* S  */
            '/[\x{015A}\x{015C}\x{015E}\x{0160}\x{0421}]/u',
            /* T  */
            '/[\x{0162}\x{0164}\x{0166}\x{0422}]/u',
            /* U  */
            '/[\x{00D9}\x{00DA}\x{00DB}\x{00DC}\x{0168}\x{016A}\x{016C}\x{016E}\x{0170}\x{0172}\x{0423}]/u',
            /* V  */
            '/[\x{0412}]/u',
            /* W  */
            '/[\x{0174}]/u',
            /* Y  */
            '/[\x{0176}\x{042B}]/u',
            /* Z  */
            '/[\x{0179}\x{017B}\x{017D}\x{0417}]/u',
            /* AE */
            '/[\x{00C6}]/u',
            /* CH */
            '/[\x{0427}]/u',
            /* KH */
            '/[\x{0425}]/u',
            /* OE */
            '/[\x{0152}]/u',
            /* SH */
            '/[\x{0428}]/u',
            /* SHH*/
            '/[\x{0429}]/u',
            /* YA */
            '/[\x{042F}]/u',
            /* YE */
            '/[\x{0404}]/u',
            /* YI */
            '/[\x{0407}]/u',
            /* YO */
            '/[\x{0401}]/u',
            /* YU */
            '/[\x{042E}]/u',
            /* ZH */
            '/[\x{0416}]/u',
        ];

        // ?? to oe
        // ?? to aa
        // ?? to ae

        $replacements = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 'ss', 't', 'u', 'v', 'w', 'y', 'z', 'ae', 'ch', 'kh', 'oe', 'sh', 'shh', 'ya', 'ye', 'yi', 'yo', 'yu', 'zh',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'W', 'Y', 'Z', 'AE', 'CH', 'KH', 'OE', 'SH', 'SHH', 'YA', 'YE', 'YI', 'YO', 'YU', 'ZH',
        ];

        return preg_replace($patterns, $replacements, $str);
    }

    /**
     * @param string $str
     * @param int    $maxLength
     * @param string $suffix
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function truncate($str, $maxLength, $suffix = '...')
    {
        if (static::strlen($str) <= $maxLength) {
            return $str;
        }
        $str = utf8_decode($str);

        return (utf8_encode(substr($str, 0, $maxLength - static::strlen($suffix)).$suffix));
    }

    /**
     * @param        $str
     * @param string $encoding
     *
     * @return bool|int
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function strlen($str, $encoding = 'UTF-8')
    {
        if (is_array($str)) {
            return false;
        }
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, $encoding);
        }

        return strlen($str);
    }

    /**
     * @param       $text
     * @param int   $length
     * @param array $options
     *
     * @return bool|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function truncateString($text, $length = 120, $options = [])
    {
        $default = [
            'ellipsis' => '...', 'exact' => true, 'html' => true,
        ];

        $options = array_merge($default, $options);
        extract($options);
        /**
         * @var string $ellipsis
         * @var bool   $exact
         * @var bool   $html
         */

        if ($html) {
            if (static::strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            $totalLength = static::strlen(strip_tags($ellipsis));
            $openTags = [];
            $truncate = '';
            preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);

            foreach ($tags as $tag) {
                if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
                    if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                        array_unshift($openTags, $tag[2]);
                    } elseif (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                        $pos = array_search($closeTag[1], $openTags);
                        if ($pos !== false) {
                            array_splice($openTags, $pos, 1);
                        }
                    }
                }
                $truncate .= $tag[1];
                $contentLength = static::strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));

                if ($contentLength + $totalLength > $length) {
                    $left = $length - $totalLength;
                    $entitiesLength = 0;

                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entitiesLength <= $left) {
                                $left--;
                                $entitiesLength += static::strlen($entity[0]);
                            } else {
                                break;
                            }
                        }
                    }

                    $truncate .= static::substr($tag[3], 0, $left + $entitiesLength);
                    break;
                } else {
                    $truncate .= $tag[3];
                    $totalLength += $contentLength;
                }

                if ($totalLength >= $length) {
                    break;
                }
            }
        } else {
            if (static::strlen($text) <= $length) {
                return $text;
            }

            $truncate = static::substr($text, 0, $length - static::strlen($ellipsis));
        }

        if (!$exact) {
            $spacepos = static::strrpos($truncate, ' ');
            if ($html) {
                $truncateCheck = static::substr($truncate, 0, $spacepos);
                $lastOpenTag = static::strrpos($truncateCheck, '<');
                $lastCloseTag = static::strrpos($truncateCheck, '>');

                if ($lastOpenTag > $lastCloseTag) {
                    preg_match_all('/<[\w]+[^>]*>/s', $truncate, $lastTagMatches);
                    $lastTag = array_pop($lastTagMatches[0]);
                    $spacepos = static::strrpos($truncate, $lastTag) + static::strlen($lastTag);
                }

                $bits = static::substr($truncate, $spacepos);
                preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);

                if (!empty($droppedTags)) {
                    if (!empty($openTags)) {
                        foreach ($droppedTags as $closingTag) {
                            if (!in_array($closingTag[1], $openTags)) {
                                array_unshift($openTags, $closingTag[1]);
                            }
                        }
                    } else {
                        foreach ($droppedTags as $closingTag) {
                            $openTags[] = $closingTag[1];
                        }
                    }
                }
            }

            $truncate = static::substr($truncate, 0, $spacepos);
        }

        $truncate .= $ellipsis;

        if ($html) {
            foreach ($openTags as $tag) {
                $truncate .= '</'.$tag.'>';
            }
        }

        return $truncate;
    }

    /**
     * @param        $str
     * @param        $start
     * @param bool   $length
     * @param string $encoding
     *
     * @return bool|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function substr($str, $start, $length = false, $encoding = 'utf-8')
    {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_substr')) {
            return mb_substr($str, (int) $start, ($length === false ? static::strlen($str) : (int) $length), $encoding);
        }

        return substr($str, $start, ($length === false ? static::strlen($str) : (int) $length));
    }

    /**
     * @param        $str
     * @param        $find
     * @param int    $offset
     * @param string $encoding
     *
     * @return bool|int
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function strrpos($str, $find, $offset = 0, $encoding = 'utf-8')
    {
        if (function_exists('mb_strrpos')) {
            return mb_strrpos($str, $find, $offset, $encoding);
        }

        return strrpos($str, $find, $offset);
    }

    /**
     * @param $directory
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function normalizeDirectory($directory)
    {
        return rtrim($directory, '/\\').DIRECTORY_SEPARATOR;
    }

    /**
     * Generate date form
     *
     * @param int $year  Year to select
     * @param int $month Month to select
     * @param int $day   Day to select
     *
     * @return array $tab html data with 3 cells :['days'], ['months'], ['years']
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     *
     */
    public static function dateYears()
    {
        $tab = [];
        for ($i = date('Y'); $i >= 1900; $i--) {
            $tab[] = $i;
        }

        return $tab;
    }

    /**
     * @return array
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function dateDays()
    {
        $tab = [];
        for ($i = 1; $i != 32; $i++) {
            $tab[] = $i;
        }

        return $tab;
    }

    /**
     * @return array
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function dateMonths()
    {
        $tab = [];
        for ($i = 1; $i != 13; $i++) {
            $tab[$i] = date('F', mktime(0, 0, 0, $i, date('m'), date('Y')));
        }

        return $tab;
    }

    /**
     * @param $date
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function dateFrom($date)
    {
        $tab = explode(' ', $date);
        if (!isset($tab[1])) {
            $date .= ' '.static::hourGenerate(0, 0, 0);
        }

        return $date;
    }

    /**
     * @param $hours
     * @param $minutes
     * @param $seconds
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function hourGenerate($hours, $minutes, $seconds)
    {
        return implode(':', [$hours, $minutes, $seconds]);
    }

    /**
     * @param $date
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function dateTo($date)
    {
        $tab = explode(' ', $date);
        if (!isset($tab[1])) {
            $date .= ' '.static::hourGenerate(23, 59, 59);
        }

        return $date;
    }

    /**
     * @param $string
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function stripslashes($string)
    {
        if (_PS_MAGIC_QUOTES_GPC_) {
            $string = stripslashes($string);
        }

        return $string;
    }

    /**
     * @param        $str
     * @param        $find
     * @param int    $offset
     * @param string $encoding
     *
     * @return bool|int
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function strpos($str, $find, $offset = 0, $encoding = 'UTF-8')
    {
        if (function_exists('mb_strpos')) {
            return mb_strpos($str, $find, $offset, $encoding);
        }

        return strpos($str, $find, $offset);
    }

    /**
     * @param $str
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function ucwords($str)
    {
        if (function_exists('mb_convert_case')) {
            return mb_convert_case($str, MB_CASE_TITLE);
        }

        return ucwords(static::strtolower($str));
    }

    /**
     * @param $array
     * @param $order_way
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function orderbyPrice(&$array, $order_way)
    {
        foreach ($array as &$row) {
            $row['price_tmp'] = \Product::getPriceStatic($row['id_product'], true, ((isset($row['id_product_attribute']) && !empty($row['id_product_attribute'])) ? (int) $row['id_product_attribute'] : null), 2);
        }

        unset($row);

        if (static::strtolower($order_way) == 'desc') {
            uasort($array, 'cmpPriceDesc');
        } else {
            uasort($array, 'cmpPriceAsc');
        }
        foreach ($array as &$row) {
            unset($row['price_tmp']);
        }
    }

    /**
     * @param $from
     * @param $to
     * @param $string
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function iconv($from, $to, $string)
    {
        if (function_exists('iconv')) {
            return iconv($from, $to.'//TRANSLIT', str_replace('??', '&yen;', str_replace('??', '&pound;', str_replace('???', '&euro;', $string))));
        }

        return html_entity_decode(htmlentities($string, ENT_NOQUOTES, $from), ENT_NOQUOTES, $to);
    }

    /**
     * @param $field
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function isEmpty($field)
    {
        return ($field === '' || $field === null);
    }

    /**
     * file_exists() wrapper with a call to clearstatcache prior
     *
     * @param string $filename File name
     *
     * @return bool Cached result of file_exists($filename)
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function file_exists_no_cache($filename)
    {
        clearstatcache();

        return file_exists($filename);
    }

    /**
     * @param      $url
     * @param bool $use_include_path
     * @param null $stream_context
     * @param int  $curl_timeout
     *
     * @return bool|mixed|string
     *
     * @deprecated 1.0.0 Use Guzzle for remote URLs and file_get_contents for local files instead
     */
    public static function file_get_contents($url, $use_include_path = false, $stream_context = null, $curl_timeout = 5)
    {
        if ($stream_context == null && preg_match('/^https?:\/\//', $url)) {
            $stream_context = @stream_context_create(['http' => ['timeout' => $curl_timeout]]);
        }
        if (in_array(ini_get('allow_url_fopen'), ['On', 'on', '1']) || !preg_match('/^https?:\/\//', $url)) {
            return @file_get_contents($url, $use_include_path, $stream_context);
        } elseif (function_exists('curl_init')) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_TIMEOUT, $curl_timeout);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            if ($stream_context != null) {
                $opts = stream_context_get_options($stream_context);
                if (isset($opts['http']['method']) && static::strtolower($opts['http']['method']) == 'post') {
                    curl_setopt($curl, CURLOPT_POST, true);
                    if (isset($opts['http']['content'])) {
                        parse_str($opts['http']['content'], $post_data);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
                    }
                }
            }
            $content = curl_exec($curl);
            curl_close($curl);

            return $content;
        } else {
            return false;
        }
    }

    /**
     * @param      $url
     * @param null $className
     *
     * @return null|\SimpleXMLElement
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function simplexml_load_file($url, $className = null)
    {
        $file = static::file_get_contents($url);

        return @simplexml_load_string($file, $className);
    }

    /**
     * @param      $source
     * @param      $destination
     * @param null $streamContext
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function copy($source, $destination, $streamContext = null)
    {
        $timeout = ini_get('max_execution_time');
        if ( ! $timeout || $timeout > 600) {
            $timeout = 600;
        }
        $timeout -= 5; // Room for other processing.

        $guzzle = new Client([
            'verify'   => __DIR__.'/../cacert.pem',
            'timeout'  => $timeout,
        ]);

        try {
            $guzzle->get($source, ['sink' => $destination]);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @deprecated as of 1.0.0 use Media::minifyHTML()
     */
    public static function minifyHTML($htmlContent)
    {
        static::displayAsDeprecated();

        return \Media::minifyHTML($htmlContent);
    }

    /**
     * Translates a string with underscores into camel case (e.g. first_name -> firstName)
     *
     * @prototype string public static function toCamelCase(string $str[, bool $capitalise_first_char = false])
     *
     * @since     1.0.0
     * @version   1.0.0 Initial version
     */
    public static function toCamelCase($str, $catapitaliseFirstChar = false)
    {
        $str = static::strtolower($str);
        if ($catapitaliseFirstChar) {
            $str = ucfirst($str);
        }

        return preg_replace_callback('/_+([a-z])/', function ($c) {
            return strtoupper($c[1]);
        }, $str);
    }

    /**
     * @param $str
     *
     * @return string
     *
     * @deprecated 1.0.0 use ucfirst instead
     */
    public static function ucfirst($str)
    {
        return ucfirst($str);
    }

    /**
     * @param $str
     *
     * @return bool|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function strtoupper($str)
    {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_strtoupper')) {
            return mb_strtoupper($str, 'utf-8');
        }

        return strtoupper($str);
    }

    /**
     * Transform a CamelCase string to underscore_case string
     *
     * @param string $string
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function toUnderscoreCase($string)
    {
        // 'CMSCategories' => 'cms_categories'
        // 'RangePrice' => 'range_price'
        return static::strtolower(trim(preg_replace('/([A-Z][a-z])/', '_$1', $string), '_'));
    }

    /**
     * @param $hex
     *
     * @return float|int|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getBrightness($hex)
    {
        if (static::strtolower($hex) == 'transparent') {
            return '129';
        }

        $hex = str_replace('#', '', $hex);

        if (static::strlen($hex) == 3) {
            $hex .= $hex;
        }

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        return (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
    }

    /**
     * @param $sql
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function parserSQL($sql)
    {
        if (class_exists('\PHPSQLParser') && strlen($sql) > 0) {
            $parser = new \PHPSQLParser($sql);

            return $parser->parsed;
        }

        return false;
    }
    /**
     * @param $filename
     *
     * @return mixed|string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getMediaServer($filename)
    {
        if (self::$_cache_nb_media_servers === null && defined('_MEDIA_SERVER_1_') && defined('_MEDIA_SERVER_2_') && defined('_MEDIA_SERVER_3_')) {
            if (_MEDIA_SERVER_1_ == '') {
                self::$_cache_nb_media_servers = 0;
            } elseif (_MEDIA_SERVER_2_ == '') {
                self::$_cache_nb_media_servers = 1;
            } elseif (_MEDIA_SERVER_3_ == '') {
                self::$_cache_nb_media_servers = 2;
            } else {
                self::$_cache_nb_media_servers = 3;
            }
        }

        if ($filename && self::$_cache_nb_media_servers && ($id_media_server = (abs(crc32($filename)) % self::$_cache_nb_media_servers + 1))) {
            return constant('_MEDIA_SERVER_'.$id_media_server.'_');
        }

        return static::usingSecureMode() ? static::getShopDomainSSL() : static::getShopDomain();
    }

    /**
     * getShopDomain returns domain name according to configuration and ignoring ssl
     *
     * @param bool $http     if true, return domain name with protocol
     * @param bool $entities if true, convert special chars to HTML entities
     *
     * @return string domain
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getShopDomain($http = false, $entities = false)
    {
        if (!$domain = ShopUrl::getMainShopDomain()) {
            $domain = static::getHttpHost();
        }
        if ($entities) {
            $domain = htmlspecialchars($domain, ENT_COMPAT, 'UTF-8');
        }
        if ($http) {
            $domain = 'http://'.$domain;
        }

        return $domain;
    }

    /**
     * getShopDomainSsl returns domain name according to configuration and depending on ssl activation
     *
     * @param bool $http     if true, return domain name with protocol
     * @param bool $entities if true, convert special chars to HTML entities
     *
     * @return string domain
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getShopDomainSsl($http = false, $entities = false)
    {
        if (!$domain = ShopUrl::getMainShopDomainSSL()) {
            $domain = Tools::getHttpHost();
        }
        if ($entities) {
            $domain = htmlspecialchars($domain, ENT_COMPAT, 'UTF-8');
        }
        if ($http) {
            $domain = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').$domain;
        }

        return $domain;
    }

    /**
     * @param null   $path
     * @param null   $rewrite_settings
     * @param null   $cache_control
     * @param string $specific
     * @param null   $disable_multiviews
     * @param bool   $medias
     * @param null   $disable_modsec
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function generateHtaccess($path = null, $rewrite_settings = null, $cache_control = null, $specific = '', $disable_multiviews = null, $medias = false, $disable_modsec = null)
    {
        if (defined('TB_INSTALLATION_IN_PROGRESS') && $rewrite_settings === null) {
            return true;
        }

        // Default values for parameters
        if (is_null($path)) {
            $path = _PS_ROOT_DIR_.'/.htaccess';
        }

        if (is_null($cache_control)) {
            $cache_control = (int) Configuration::get('PS_HTACCESS_CACHE_CONTROL');
        }
        if (is_null($disable_multiviews)) {
            $disable_multiviews = (int) Configuration::get('PS_HTACCESS_DISABLE_MULTIVIEWS');
        }

        if ($disable_modsec === null) {
            $disable_modsec = (int) Configuration::get('PS_HTACCESS_DISABLE_MODSEC');
        }

        // Check current content of .htaccess and save all code outside of thirty bees comments
        $specific_before = $specific_after = '';
        if (file_exists($path)) {
            if (self::isSubmit('htaccess')) {
                $content = self::getValue('htaccess');
            } else {
                $content = file_get_contents($path);
            }
            if (preg_match('#^(.*)\# ~~start~~.*\# ~~end~~[^\n]*(.*)$#s', $content, $m)) {
                $specific_before = $m[1];
                $specific_after = $m[2];
            } else {
                // For retrocompatibility
                if (preg_match('#\# http://www\.thirtybees\.com - http://www\.thirtybees\.com/forums\s*(.*)<IfModule mod_rewrite\.c>#si', $content, $m)) {
                    $specific_before = $m[1];
                } else {
                    $specific_before = $content;
                }
            }
        }

        // Write .htaccess data
        if (!$write_fd = @fopen($path, 'w')) {
            return false;
        }
        if ($specific_before) {
            fwrite($write_fd, trim($specific_before)."\n\n");
        }

        $domains = [];
        foreach (ShopUrl::getShopUrls() as $shop_url) {
            /** @var ShopUrl $shop_url */
            if (!isset($domains[$shop_url->domain])) {
                $domains[$shop_url->domain] = [];
            }

            $domains[$shop_url->domain][] = [
                'physical' => $shop_url->physical_uri,
                'virtual'  => $shop_url->virtual_uri,
                'id_shop'  => $shop_url->id_shop,
            ];

            if ($shop_url->domain == $shop_url->domain_ssl) {
                continue;
            }

            if (!isset($domains[$shop_url->domain_ssl])) {
                $domains[$shop_url->domain_ssl] = [];
            }

            $domains[$shop_url->domain_ssl][] = [
                'physical' => $shop_url->physical_uri,
                'virtual'  => $shop_url->virtual_uri,
                'id_shop'  => $shop_url->id_shop,
            ];
        }

        // Write data in .htaccess file
        fwrite($write_fd, "# ~~start~~ Do not remove this comment, thirty bees will keep automatically the code outside this comment when .htaccess will be generated again\n");
        fwrite($write_fd, "# .htaccess automatically generated by thirty bees e-commerce open-source solution\n");
        fwrite($write_fd, "# http://www.thirtybees.com - http://www.thirtybees.com/forums\n\n");

        if ($disable_modsec) {
            fwrite($write_fd, "<IfModule mod_security.c>\nSecFilterEngine Off\nSecFilterScanPOST Off\n</IfModule>\n\n");
        }

        // RewriteEngine
        fwrite($write_fd, "<IfModule mod_rewrite.c>\n");

        // Ensure HTTP_MOD_REWRITE variable is set in environment
        fwrite($write_fd, "<IfModule mod_env.c>\n");
        fwrite($write_fd, "SetEnv HTTP_MOD_REWRITE On\n");
        fwrite($write_fd, "</IfModule>\n\n");

        // Disable multiviews ?
        if ($disable_multiviews) {
            fwrite($write_fd, "\n# Disable Multiviews\nOptions -Multiviews\n\n");
        }

        fwrite($write_fd, "RewriteEngine on\n");

        if (!$medias && Configuration::getMultiShopValues('PS_MEDIA_SERVER_1')
            && Configuration::getMultiShopValues('PS_MEDIA_SERVER_2')
            && Configuration::getMultiShopValues('PS_MEDIA_SERVER_3')
        ) {
            $medias = [
                Configuration::getMultiShopValues('PS_MEDIA_SERVER_1'),
                Configuration::getMultiShopValues('PS_MEDIA_SERVER_2'),
                Configuration::getMultiShopValues('PS_MEDIA_SERVER_3'),
            ];
        }

        $media_domains = '';
        foreach ($medias as $media) {
            foreach ($media as $media_url) {
                if ($media_url) {
                    $media_domains .= 'RewriteCond %{HTTP_HOST} ^'.$media_url.'$ [OR]'."\n";
                }
            }
        }

        if (Configuration::get('PS_WEBSERVICE_CGI_HOST')) {
            fwrite($write_fd, "RewriteCond %{HTTP:Authorization} ^(.*)\nRewriteRule . - [E=HTTP_AUTHORIZATION:%1]\n\n");
        }

        foreach ($domains as $domain => $list_uri) {
            $physicals = [];
            foreach ($list_uri as $uri) {
                fwrite($write_fd, PHP_EOL.PHP_EOL.'#Domain: '.$domain.PHP_EOL);
                if (Shop::isFeatureActive()) {
                    fwrite($write_fd, 'RewriteCond %{HTTP_HOST} ^'.$domain.'$'."\n");
                }
                fwrite($write_fd, 'RewriteRule . - [E=REWRITEBASE:'.$uri['physical'].']'."\n");

                // Webservice
                fwrite($write_fd, 'RewriteRule ^api$ api/ [L]'."\n\n");
                fwrite($write_fd, 'RewriteRule ^api/(.*)$ %{ENV:REWRITEBASE}webservice/dispatcher.php?url=$1 [QSA,L]'."\n\n");

                if (!$rewrite_settings) {
                    $rewrite_settings = (int) Configuration::get('PS_REWRITING_SETTINGS', null, null, (int) $uri['id_shop']);
                }

                $domain_rewrite_cond = 'RewriteCond %{HTTP_HOST} ^'.$domain.'$'."\n";
                // Rewrite virtual multishop uri
                if ($uri['virtual']) {
                    if (!$rewrite_settings) {
                        fwrite($write_fd, $media_domains);
                        if (Shop::isFeatureActive()) {
                            fwrite($write_fd, $domain_rewrite_cond);
                        }
                        fwrite($write_fd, 'RewriteRule ^'.trim($uri['virtual'], '/').'/?$ '.$uri['physical'].$uri['virtual']."index.php [L,R]\n");
                    } else {
                        fwrite($write_fd, $media_domains);
                        if (Shop::isFeatureActive()) {
                            fwrite($write_fd, $domain_rewrite_cond);
                        }
                        fwrite($write_fd, 'RewriteRule ^'.trim($uri['virtual'], '/').'$ '.$uri['physical'].$uri['virtual']." [L,R]\n");
                    }
                    fwrite($write_fd, $media_domains);
                    if (Shop::isFeatureActive()) {
                        fwrite($write_fd, $domain_rewrite_cond);
                    }
                    fwrite($write_fd, 'RewriteRule ^'.ltrim($uri['virtual'], '/').'(.*) '.$uri['physical']."$1 [L]\n\n");
                }

                if ($rewrite_settings) {
                    // Compatibility with the old image filesystem
                    fwrite($write_fd, "# Images\n");
                    if (Configuration::get('PS_LEGACY_IMAGES')) {
                        fwrite($write_fd, $media_domains);
                        if (Shop::isFeatureActive()) {
                            fwrite($write_fd, $domain_rewrite_cond);
                        }
                        fwrite($write_fd, 'RewriteRule ^([a-z0-9]+)\-([a-z0-9]+)(\-[_a-zA-Z0-9-]*)(-[0-9]+)?/.+\.jpg$ %{ENV:REWRITEBASE}img/p/$1-$2$3$4.jpg [L]'."\n");
                        fwrite($write_fd, $media_domains);
                        if (Shop::isFeatureActive()) {
                            fwrite($write_fd, $domain_rewrite_cond);
                        }
                        fwrite($write_fd, 'RewriteRule ^([0-9]+)\-([0-9]+)(-[0-9]+)?/.+\.jpg$ %{ENV:REWRITEBASE}img/p/$1-$2$3.jpg [L]'."\n");
                    }

                    // Rewrite product images < 100 millions
                    for ($i = 1; $i <= 8; $i++) {
                        $img_path = $img_name = '';
                        for ($j = 1; $j <= $i; $j++) {
                            $img_path .= '$'.$j.'/';
                            $img_name .= '$'.$j;
                        }
                        $img_name .= '$'.$j;
                        fwrite($write_fd, $media_domains);
                        if (Shop::isFeatureActive()) {
                            fwrite($write_fd, $domain_rewrite_cond);
                        }
                        fwrite($write_fd, 'RewriteRule ^'.str_repeat('([0-9])', $i).'(\-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ %{ENV:REWRITEBASE}img/p/'.$img_path.$img_name.'$'.($j + 1).".jpg [L]\n");
                    }
                    fwrite($write_fd, $media_domains);
                    if (Shop::isFeatureActive()) {
                        fwrite($write_fd, $domain_rewrite_cond);
                    }
                    fwrite($write_fd, 'RewriteRule ^c/([0-9]+)(\-[\.*_a-zA-Z0-9-]*)(-[0-9]+)?/.+\.jpg$ %{ENV:REWRITEBASE}img/c/$1$2$3.jpg [L]'."\n");
                    fwrite($write_fd, $media_domains);
                    if (Shop::isFeatureActive()) {
                        fwrite($write_fd, $domain_rewrite_cond);
                    }
                    fwrite($write_fd, 'RewriteRule ^c/([a-zA-Z_-]+)(-[0-9]+)?/.+\.jpg$ %{ENV:REWRITEBASE}img/c/$1$2.jpg [L]'."\n");
                }

                fwrite($write_fd, "# AlphaImageLoader for IE and fancybox\n");
                if (Shop::isFeatureActive()) {
                    fwrite($write_fd, $domain_rewrite_cond);
                }
                fwrite($write_fd, 'RewriteRule ^images_ie/?([^/]+)\.(jpe?g|png|gif)$ js/jquery/plugins/fancybox/images/$1.$2 [L]'."\n");
            }
            // Redirections to dispatcher
            if ($rewrite_settings) {
                fwrite($write_fd, "\n# Dispatcher\n");
                fwrite($write_fd, "RewriteCond %{REQUEST_FILENAME} -s [OR]\n");
                fwrite($write_fd, "RewriteCond %{REQUEST_FILENAME} -l [OR]\n");
                fwrite($write_fd, "RewriteCond %{REQUEST_FILENAME} -d\n");
                if (Shop::isFeatureActive()) {
                    fwrite($write_fd, $domain_rewrite_cond);
                }
                fwrite($write_fd, "RewriteRule ^.*$ - [NC,L]\n");
                if (Shop::isFeatureActive()) {
                    fwrite($write_fd, $domain_rewrite_cond);
                }
                fwrite($write_fd, "RewriteRule ^.*\$ %{ENV:REWRITEBASE}index.php [NC,L]\n");
            }
        }

        fwrite($write_fd, "</IfModule>\n\n");

        fwrite($write_fd, "AddType application/vnd.ms-fontobject .eot\n");
        fwrite($write_fd, "AddType font/ttf .ttf\n");
        fwrite($write_fd, "AddType font/otf .otf\n");
        fwrite($write_fd, "AddType application/x-font-woff .woff\n");
        fwrite(
            $write_fd, "<IfModule mod_headers.c>
	<FilesMatch \"\.(ttf|ttc|otf|eot|woff|svg)$\">
		Header add Access-Control-Allow-Origin \"*\"
	</FilesMatch>
</IfModule>\n\n"
        );

        // Cache control
        if ($cache_control) {
            $cache_control = "<IfModule mod_expires.c>
	ExpiresActive On
	ExpiresByType image/gif \"access plus 1 month\"
	ExpiresByType image/jpeg \"access plus 1 month\"
	ExpiresByType image/png \"access plus 1 month\"
	ExpiresByType text/css \"access plus 1 week\"
	ExpiresByType text/javascript \"access plus 1 week\"
	ExpiresByType application/javascript \"access plus 1 week\"
	ExpiresByType application/x-javascript \"access plus 1 week\"
	ExpiresByType image/x-icon \"access plus 1 year\"
	ExpiresByType image/svg+xml \"access plus 1 year\"
	ExpiresByType image/vnd.microsoft.icon \"access plus 1 year\"
	ExpiresByType application/font-woff \"access plus 1 year\"
	ExpiresByType application/x-font-woff \"access plus 1 year\"
	ExpiresByType application/vnd.ms-fontobject \"access plus 1 year\"
	ExpiresByType font/opentype \"access plus 1 year\"
	ExpiresByType font/ttf \"access plus 1 year\"
	ExpiresByType font/otf \"access plus 1 year\"
	ExpiresByType application/x-font-ttf \"access plus 1 year\"
	ExpiresByType application/x-font-otf \"access plus 1 year\"
</IfModule>

<IfModule mod_headers.c>
	Header unset Etag
</IfModule>
FileETag none
<IfModule mod_deflate.c>
	<IfModule mod_filter.c>
		AddOutputFilterByType DEFLATE text/html text/css text/javascript application/javascript application/x-javascript font/ttf application/x-font-ttf font/otf application/x-font-otf font/opentype
	</IfModule>
</IfModule>\n\n";
            fwrite($write_fd, $cache_control);
        }

        // In case the user hasn't rewrite mod enabled
        fwrite($write_fd, "#If rewrite mod isn't enabled\n");

        // Do not remove ($domains is already iterated upper)
        reset($domains);
        $domain = current($domains);
        fwrite($write_fd, 'ErrorDocument 404 '.$domain[0]['physical']."index.php?controller=404\n\n");

        fwrite($write_fd, "# ~~end~~ Do not remove this comment, thirty bees will keep automatically the code outside this comment when .htaccess will be generated again");
        if ($specific_after) {
            fwrite($write_fd, "\n\n".trim($specific_after));
        }
        fclose($write_fd);

        return true;
    }

    /**
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function generateIndex()
    {
        if (defined('_DB_PREFIX_') && Configuration::get('PS_DISABLE_OVERRIDES')) {
            \PrestaShopAutoload::getInstance()->_include_override_path = false;
        }
        \PrestaShopAutoload::getInstance()->generateIndex();
    }

    /**
     * jsonDecode convert json string to php array / object
     *
     * @param string $json
     * @param bool   $assoc (since 1.4.2.4) if true, convert to associativ array
     *
     * @return object|array
     *
     * @deprecated 1.0.0 Use json_decode instead
     */
    public static function jsonDecode($json, $assoc = false)
    {
        return json_decode($json, $assoc);
    }

    /**
     * Convert an array to json string
     *
     * @param object|array $data
     *
     * @return string json
     *
     * @deprecated 1.0.0 Use json_encode instead
     */
    public static function jsonEncode($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function displayFileAsDeprecated()
    {
        $backtrace = debug_backtrace();
        $callee = current($backtrace);
        $error = 'File <b>'.$callee['file'].'</b> is deprecated<br />';
        $message = 'The file '.$callee['file'].' is deprecated and will be removed in the next major version.';
        $class = isset($callee['class']) ? $callee['class'] : null;

        static::throwDeprecated($error, $message, $class);
    }

    /**
     * @param int           $level
     * @param Context|null $context
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function enableCache($level = 1, Context $context = null)
    {
        if (!$context) {
            $context = Context::getContext();
        }
        $smarty = $context->smarty;
        if (!Configuration::get('PS_SMARTY_CACHE')) {
            return;
        }
        if ($smarty->force_compile == 0 && $smarty->caching == $level) {
            return;
        }
        self::$_forceCompile = (int) $smarty->force_compile;
        self::$_caching = (int) $smarty->caching;
        $smarty->force_compile = 0;
        $smarty->caching = (int) $level;
        $smarty->cache_lifetime = 31536000; // 1 Year
    }

    /**
     * @param Context|null $context
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function restoreCacheSettings(Context $context = null)
    {
        if (!$context) {
            $context = Context::getContext();
        }

        if (isset(self::$_forceCompile)) {
            $context->smarty->force_compile = (int) self::$_forceCompile;
        }
        if (isset(self::$_caching)) {
            $context->smarty->caching = (int) self::$_caching;
        }
    }

    /**
     * @param $function
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function isCallable($function)
    {
        $disabled = explode(',', ini_get('disable_functions'));

        return (!in_array($function, $disabled) && is_callable($function));
    }

    /**
     * @param $s
     * @param $delim
     *
     * @return mixed
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function pRegexp($s, $delim)
    {
        $s = str_replace($delim, '\\'.$delim, $s);
        foreach (['?', '[', ']', '(', ')', '{', '}', '-', '.', '+', '*', '^', '$', '`', '"', '%'] as $char) {
            $s = str_replace($char, '\\'.$char, $s);
        }

        return $s;
    }

    /**
     * @param $needle
     * @param $replace
     * @param $haystack
     *
     * @return mixed
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function str_replace_once($needle, $replace, $haystack)
    {
        $pos = false;
        if ($needle) {
            $pos = strpos($haystack, $needle);
        }
        if ($pos === false) {
            return $haystack;
        }

        return substr_replace($haystack, $replace, $pos, strlen($needle));
    }

    /**
     * Function property_exists does not exist in PHP < 5.1
     *
     * @deprecated since 1.5.0 (PHP 5.1 required, so property_exists() is now natively supported)
     *
     * @param object $class
     * @param string $property
     *
     * @return bool
     *
     * @since      1.0.0
     * @version    1.0.0 Initial version
     */
    public static function property_exists($class, $property)
    {
        static::displayAsDeprecated();

        if (function_exists('property_exists')) {
            return property_exists($class, $property);
        }

        if (is_object($class)) {
            $vars = get_object_vars($class);
        } else {
            $vars = get_class_vars($class);
        }

        return array_key_exists($property, $vars);
    }

    /**
     * @desc    identify the version of php
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function checkPhpVersion()
    {
        $version = null;

        if (defined('PHP_VERSION')) {
            $version = PHP_VERSION;
        } else {
            $version = phpversion('');
        }

        //Case management system of ubuntu, php version return 5.2.4-2ubuntu5.2
        if (strpos($version, '-') !== false) {
            $version = substr($version, 0, strpos($version, '-'));
        }

        return $version;
    }

    /**
     * @desc    try to open a zip file in order to check if it's valid
     * @return bool success
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function ZipTest($fromFile)
    {
        $zip = new \ZipArchive();

        return ($zip->open($fromFile, \ZipArchive::CHECKCONS) === true);
    }

    /**
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getSafeModeStatus()
    {
        if (!$safe_mode = @ini_get('safe_mode')) {
            $safe_mode = '';
        }

        return in_array(static::strtolower($safe_mode), [1, 'on']);
    }

    /**
     * @desc    extract a zip file to the given directory
     * @return bool success
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function ZipExtract($fromFile, $toDir)
    {
        if (!file_exists($toDir)) {
            mkdir($toDir, 0777);
        }

        $zip = new \ZipArchive();
        if ($zip->open($fromFile) === true && $zip->extractTo($toDir) && $zip->close()) {
            return true;
        }

        return false;
    }

    /**
     * @param $path
     * @param $filemode
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function chmodr($path, $filemode)
    {
        if (!is_dir($path)) {
            return @chmod($path, $filemode);
        }
        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {
                $fullpath = $path.'/'.$file;
                if (is_link($fullpath)) {
                    return false;
                } elseif (!is_dir($fullpath) && !@chmod($fullpath, $filemode)) {
                    return false;
                } elseif (!static::chmodr($fullpath, $filemode)) {
                    return false;
                }
            }
        }
        closedir($dh);
        if (@chmod($path, $filemode)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get products order field name for queries.
     *
     * @param string                   $type  by|way
     * @param string                   $value If no index given, use default order from admin -> pref -> products
     * @param bool|\bool(false)|string $prefix
     *
     * @return string Order by sql clause
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getProductsOrder($type, $value = null, $prefix = false)
    {
        switch ($type) {
            case 'by':
                $list = [0 => 'name', 1 => 'price', 2 => 'date_add', 3 => 'date_upd', 4 => 'position', 5 => 'manufacturer_name', 6 => 'quantity', 7 => 'reference'];
                $value = (is_null($value) || $value === false || $value === '') ? (int) Configuration::get('PS_PRODUCTS_ORDER_BY') : $value;
                $value = (isset($list[$value])) ? $list[$value] : ((in_array($value, $list)) ? $value : 'position');
                $order_by_prefix = '';
                if ($prefix) {
                    if ($value == 'id_product' || $value == 'date_add' || $value == 'date_upd' || $value == 'price') {
                        $order_by_prefix = 'p.';
                    } elseif ($value == 'name') {
                        $order_by_prefix = 'pl.';
                    } elseif ($value == 'manufacturer_name' && $prefix) {
                        $order_by_prefix = 'm.';
                        $value = 'name';
                    } elseif ($value == 'position' || empty($value)) {
                        $order_by_prefix = 'cp.';
                    }
                }

                return $order_by_prefix.$value;
                break;

            case 'way':
                $value = (is_null($value) || $value === false || $value === '') ? (int) Configuration::get('PS_PRODUCTS_ORDER_WAY') : $value;
                $list = [0 => 'asc', 1 => 'desc'];

                return ((isset($list[$value])) ? $list[$value] : ((in_array($value, $list)) ? $value : 'asc'));
                break;
        }
    }

    /**
     * @deprecated 1.0.0 use Controller::getController('PageNotFoundController')->run();
     */
    public static function display404Error()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        include(dirname(__FILE__).'/../404.php');
        die;
    }

    /**
     * Concat $begin and $end, add ? or & between strings
     *
     * @param string $begin
     * @param string $end
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function url($begin, $end)
    {
        return $begin.((strpos($begin, '?') !== false) ? '&' : '?').$end;
    }

    /**
     * Display error and dies or silently log the error.
     *
     * @param string $msg
     * @param bool   $die
     *
     * @return bool success of logging
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function dieOrLog($msg, $die = true)
    {
        if ($die || (defined('_PS_MODE_DEV_') && _PS_MODE_DEV_)) {
            die($msg);
        }
    }

    /**
     * Convert \n and \r\n and \r to <br />
     *
     * @param string $string String to transform
     *
     * @return string New string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function nl2br($str)
    {
        return str_replace(["\r\n", "\r", "\n"], '<br />', $str);
    }

    /**
     * Clear Smarty cache and compile folders
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function clearSmartyCache()
    {
        $smarty = Context::getContext()->smarty;
        static::clearCache($smarty);
        static::clearCompile($smarty);
    }

    /**
     * Clear cache for Smarty
     *
     * @param \Smarty $smarty
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function clearCache($smarty = null, $tpl = false, $cacheId = null, $compileId = null)
    {
        if ($smarty === null) {
            $smarty = Context::getContext()->smarty;
        }

        if ($smarty === null) {
            return;
        }

        if (!$tpl && $cacheId === null && $compileId === null) {
            return $smarty->clearAllCache();
        }

        return $smarty->clearCache($tpl, $cacheId, $compileId);
    }

    /**
     * Clear compile for Smarty
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function clearCompile($smarty = null)
    {
        if ($smarty === null) {
            $smarty = Context::getContext()->smarty;
        }

        if ($smarty === null) {
            return;
        }

        return $smarty->clearCompiledTemplate();
    }

    /**
     * @param bool $id_product
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function clearColorListCache($id_product = false)
    {
        // Change template dir if called from the BackOffice
        $current_template_dir = Context::getContext()->smarty->getTemplateDir();
        Context::getContext()->smarty->setTemplateDir(_PS_THEME_DIR_);
        static::clearCache(null, _PS_THEME_DIR_.'product-list-colors.tpl', \Product::getColorsListCacheId((int) $id_product, false));
        Context::getContext()->smarty->setTemplateDir($current_template_dir);
    }

    /**
     * getMemoryLimit allow to get the memory limit in octet
     *
     * @return int the memory limit value in octet
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getMemoryLimit()
    {
        $memory_limit = @ini_get('memory_limit');

        return static::getOctets($memory_limit);
    }

    /**
     * getOctet allow to gets the value of a configuration option in octet
     *
     * @return int the value of a configuration option in octet
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getOctets($option)
    {
        if (preg_match('/[0-9]+k/i', $option)) {
            return 1024 * (int) $option;
        }

        if (preg_match('/[0-9]+m/i', $option)) {
            return 1024 * 1024 * (int) $option;
        }

        if (preg_match('/[0-9]+g/i', $option)) {
            return 1024 * 1024 * 1024 * (int) $option;
        }

        return $option;
    }

    /**
     *
     * @return bool true if the server use 64bit arch
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function isX86_64arch()
    {
        return (PHP_INT_MAX == '9223372036854775807');
    }

    /**
     *
     * @return bool true if php-cli is used
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function isPHPCLI()
    {
        return (defined('STDIN') || (static::strtolower(php_sapi_name()) == 'cli' && (!isset($_SERVER['REMOTE_ADDR']) || empty($_SERVER['REMOTE_ADDR']))));
    }

    /**
     * @param $argc
     * @param $argv
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function argvToGET($argc, $argv)
    {
        if ($argc <= 1) {
            return;
        }

        // get the first argument and parse it like a query string
        parse_str($argv[1], $args);
        if (!is_array($args) || !count($args)) {
            return;
        }
        $_GET = array_merge($args, $_GET);
        $_SERVER['QUERY_STRING'] = $argv[1];
    }

    /**
     * Get max file upload size considering server settings and optional max value
     *
     * @param int $max_size optional max file size
     *
     * @return int max file size in bytes
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getMaxUploadSize($max_size = 0)
    {
        $post_max_size = static::convertBytes(ini_get('post_max_size'));
        $upload_max_filesize = static::convertBytes(ini_get('upload_max_filesize'));
        if ($max_size > 0) {
            $result = min($post_max_size, $upload_max_filesize, $max_size);
        } else {
            $result = min($post_max_size, $upload_max_filesize);
        }

        return $result;
    }

    /**
     * Convert a shorthand byte value from a PHP configuration directive to an integer value
     *
     * @param string $value value to convert
     *
     * @return int
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function convertBytes($value)
    {
        if (is_numeric($value)) {
            return $value;
        } else {
            $value_length = strlen($value);
            $qty = (int) substr($value, 0, $value_length - 1);
            $unit = static::strtolower(substr($value, $value_length - 1));
            switch ($unit) {
                case 'k':
                    $qty *= 1024;
                    break;
                case 'm':
                    $qty *= 1048576;
                    break;
                case 'g':
                    $qty *= 1073741824;
                    break;
            }

            return $qty;
        }
    }

    /**
     * Copy the folder $src into $dst, $dst is created if it do not exist
     *
     * @param      $src
     * @param      $dst
     * @param bool $del if true, delete the file after copy
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function recurseCopy($src, $dst, $del = false)
    {
        if (!file_exists($src)) {
            return false;
        }
        $dir = opendir($src);

        if (!file_exists($dst)) {
            mkdir($dst);
        }
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src.DIRECTORY_SEPARATOR.$file)) {
                    self::recurseCopy($src.DIRECTORY_SEPARATOR.$file, $dst.DIRECTORY_SEPARATOR.$file, $del);
                } else {
                    copy($src.DIRECTORY_SEPARATOR.$file, $dst.DIRECTORY_SEPARATOR.$file);
                    if ($del && is_writable($src.DIRECTORY_SEPARATOR.$file)) {
                        unlink($src.DIRECTORY_SEPARATOR.$file);
                    }
                }
            }
        }
        closedir($dir);
        if ($del && is_writable($src)) {
            rmdir($src);
        }
    }

    /**
     * file_exists() wrapper with cache to speedup performance
     *
     * @param string $filename File name
     *
     * @return bool Cached result of file_exists($filename)
     *
     * @deprecated 1.0.0 Please do not use this function. PHP already caches this function.
     */
    public static function file_exists_cache($filename)
    {
        if (!isset(self::$file_exists_cache[$filename])) {
            self::$file_exists_cache[$filename] = file_exists($filename);
        }

        return self::$file_exists_cache[$filename];
    }

    /**
     * @params  string $path Path to scan
     * @params  string $ext Extention to filter files
     * @params  string $dir Add this to prefix output for example /path/dir/*
     *
     * @return array List of file found
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function scandir($path, $ext = 'php', $dir = '', $recursive = false)
    {
        $path = rtrim(rtrim($path, '\\'), '/').'/';
        $real_path = rtrim(rtrim($path.$dir, '\\'), '/').'/';
        $files = scandir($real_path);
        if (!$files) {
            return [];
        }

        $filtered_files = [];

        $real_ext = false;
        if (!empty($ext)) {
            $real_ext = '.'.$ext;
        }
        $real_ext_length = strlen($real_ext);

        $subdir = ($dir) ? $dir.'/' : '';
        foreach ($files as $file) {
            if (!$real_ext || (strpos($file, $real_ext) && strpos($file, $real_ext) == (strlen($file) - $real_ext_length))) {
                $filtered_files[] = $subdir.$file;
            }

            if ($recursive && $file[0] != '.' && is_dir($real_path.$file)) {
                foreach (static::scandir($path, $ext, $subdir.$file, $recursive) as $subfile) {
                    $filtered_files[] = $subfile;
                }
            }
        }

        return $filtered_files;
    }

    /**
     * Align version sent and use internal function
     *
     * @param        $v1
     * @param        $v2
     * @param string $operator
     *
     * @return mixed
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function version_compare($v1, $v2, $operator = '<')
    {
        static::alignVersionNumber($v1, $v2);

        return version_compare($v1, $v2, $operator);
    }

    /**
     * Align 2 version with the same number of sub version
     * version_compare will work better for its comparison :)
     * (Means: '1.8' to '1.9.3' will change '1.8' to '1.8.0')
     *
     * @param $v1
     * @param $v2
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function alignVersionNumber(&$v1, &$v2)
    {
        $len1 = count(explode('.', trim($v1, '.')));
        $len2 = count(explode('.', trim($v2, '.')));
        $len = 0;
        $str = '';

        if ($len1 > $len2) {
            $len = $len1 - $len2;
            $str = &$v2;
        } elseif ($len2 > $len1) {
            $len = $len2 - $len1;
            $str = &$v1;
        }

        for ($len; $len > 0; $len--) {
            $str .= '.0';
        }
    }

    /**
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function modRewriteActive()
    {
        if (static::apacheModExists('mod_rewrite')) {
            return true;
        }
        if ((isset($_SERVER['HTTP_MOD_REWRITE']) && static::strtolower($_SERVER['HTTP_MOD_REWRITE']) == 'on') || static::strtolower(getenv('HTTP_MOD_REWRITE')) == 'on') {
            return true;
        }

        return false;
    }

    /**
     * apacheModExists return true if the apache module $name is loaded
     *
     * @TODO    move this method in class Information (when it will exist)
     *
     * Notes: This method requires either apache_get_modules or phpinfo()
     * to be available. With CGI mod, we cannot get php modules
     *
     * @param string $name module name
     *
     * @return bool true if exists
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function apacheModExists($name)
    {
        if (function_exists('apache_get_modules')) {
            static $apache_module_list = null;

            if (!is_array($apache_module_list)) {
                $apache_module_list = apache_get_modules();
            }

            // we need strpos (example, evasive can be evasive20)
            foreach ($apache_module_list as $module) {
                if (strpos($module, $name) !== false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Reproduce array_unique working before php version 5.2.9
     *
     * @param array $array
     *
     * @return array
     *
     * @deprecated Use array_unique instead
     */
    public static function arrayUnique($array)
    {
        if (version_compare(phpversion(), '5.2.9', '<')) {
            return array_unique($array);
        } else {
            return array_unique($array, SORT_REGULAR);
        }
    }

    /**
     * Delete unicode class from regular expression patterns
     *
     * @param string $pattern
     *
     * @return string pattern
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function cleanNonUnicodeSupport($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET')) {
            return $pattern;
        }

        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }

    /**
     * @param       $request
     * @param array $params
     *
     * @return bool
     *
     * @deprecated 1.0.0
     */
    public static function addonsRequest($request, $params = [])
    {
        return false;
    }

    /**
     * Returns an array containing information about
     * HTTP file upload variable ($_FILES)
     *
     * @param string $input          File upload field name
     * @param bool   $return_content If true, returns uploaded file contents
     *
     * @return array|null
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function fileAttachment($input = 'fileUpload', $return_content = true)
    {
        $file_attachment = null;
        if (isset($_FILES[$input]['name']) && !empty($_FILES[$input]['name']) && !empty($_FILES[$input]['tmp_name'])) {
            $file_attachment['rename'] = uniqid().static::strtolower(substr($_FILES[$input]['name'], -5));
            if ($return_content) {
                $file_attachment['content'] = file_get_contents($_FILES[$input]['tmp_name']);
            }
            $file_attachment['tmp_name'] = $_FILES[$input]['tmp_name'];
            $file_attachment['name'] = $_FILES[$input]['name'];
            $file_attachment['mime'] = $_FILES[$input]['type'];
            $file_attachment['error'] = $_FILES[$input]['error'];
            $file_attachment['size'] = $_FILES[$input]['size'];
        }

        return $file_attachment;
    }

    /**
     * @param $file_name
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function changeFileMTime($file_name)
    {
        @touch($file_name);
    }

    /**
     * @param     $file_name
     * @param int $timeout
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function waitUntilFileIsModified($file_name, $timeout = 180)
    {
        @ini_set('max_execution_time', $timeout);
        if (($time_limit = ini_get('max_execution_time')) === null) {
            $time_limit = 30;
        }

        $time_limit -= 5;
        $start_time = microtime(true);
        $last_modified = @filemtime($file_name);

        while (true) {
            if (((microtime(true) - $start_time) > $time_limit) || @filemtime($file_name) > $last_modified) {
                break;
            }
            clearstatcache();
            usleep(300);
        }
    }

    /**
     * Delete a substring from another one starting from the right
     *
     * @param string $str
     * @param string $str_search
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function rtrimString($str, $str_search)
    {
        $length_str = strlen($str_search);
        if (strlen($str) >= $length_str && substr($str, -$length_str) == $str_search) {
            $str = substr($str, 0, -$length_str);
        }

        return $str;
    }

    /**
     * Format a number into a human readable format
     * e.g. 24962496 => 23.81M
     *
     * @param     $size
     * @param int $precision
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function formatBytes($size, $precision = 2)
    {
        if (!$size) {
            return '0';
        }
        $base = log($size) / log(1024);
        $suffixes = ['', 'k', 'M', 'G', 'T'];

        return round(pow(1024, $base - floor($base)), $precision).$suffixes[floor($base)];
    }

    /**
     * @param $value
     *
     * @return bool
     *
     * @deprecated Use a cast instead
     */
    public static function boolVal($value)
    {
        if (empty($value)) {
            $value = false;
        }

        return (bool) $value;
    }

    /**
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getUserPlatform()
    {
        if (isset(self::$_user_plateform)) {
            return self::$_user_plateform;
        }

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        self::$_user_plateform = 'unknown';

        if (preg_match('/linux/i', $user_agent)) {
            self::$_user_plateform = 'Linux';
        } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            self::$_user_plateform = 'Mac';
        } elseif (preg_match('/windows|win32/i', $user_agent)) {
            self::$_user_plateform = 'Windows';
        }

        return self::$_user_plateform;
    }

    /**
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getUserBrowser()
    {
        if (isset(self::$_user_browser)) {
            return self::$_user_browser;
        }

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        self::$_user_browser = 'unknown';

        if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
            self::$_user_browser = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            self::$_user_browser = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            self::$_user_browser = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $user_agent)) {
            self::$_user_browser = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $user_agent)) {
            self::$_user_browser = 'Opera';
        } elseif (preg_match('/Netscape/i', $user_agent)) {
            self::$_user_browser = 'Netscape';
        }

        return self::$_user_browser;
    }

    /**
     * Allows to display the category description without HTML tags and slashes
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getDescriptionClean($description)
    {
        return strip_tags(stripslashes($description));
    }

    /**
     * @param      $html
     * @param null $uri_unescape
     * @param bool $allow_style
     *
     * @return string
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     *
     * @todo    : update htmlpurifier
     */
    public static function purifyHTML($html, $uri_unescape = null, $allow_style = false)
    {
        static $use_html_purifier = null;
        static $purifier = null;

        if (defined('TB_INSTALLATION_IN_PROGRESS') || !Configuration::configurationIsLoaded()) {
            return $html;
        }

        if ($use_html_purifier === null) {
            $use_html_purifier = (bool) Configuration::get('PS_USE_HTMLPURIFIER');
        }

        if ($use_html_purifier) {
            if ($purifier === null) {
                $config = \HTMLPurifier_Config::createDefault();

                $config->set('Attr.EnableID', true);
                $config->set('HTML.Trusted', true);
                $config->set('Cache.SerializerPath', _PS_CACHE_DIR_.'purifier');
                $config->set('Attr.AllowedFrameTargets', ['_blank', '_self', '_parent', '_top']);
                if (is_array($uri_unescape)) {
                    $config->set('URI.UnescapeCharacters', implode('', $uri_unescape));
                }

                if (Configuration::get('PS_ALLOW_HTML_IFRAME')) {
                    $config->set('HTML.SafeIframe', true);
                    $config->set('HTML.SafeObject', true);
                    $config->set('URI.SafeIframeRegexp', '/.*/');
                }

                /** @var \HTMLPurifier_HTMLDefinition|\HTMLPurifier_HTMLModule $def */
                // http://developers.whatwg.org/the-video-element.html#the-video-element
                if ($def = $config->getHTMLDefinition(true)) {
                    $def->addElement(
                        'video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', [
                            'src'      => 'URI',
                            'type'     => 'Text',
                            'width'    => 'Length',
                            'height'   => 'Length',
                            'poster'   => 'URI',
                            'preload'  => 'Enum#auto,metadata,none',
                            'controls' => 'Bool',
                        ]
                    );
                    $def->addElement(
                        'source', 'Block', 'Flow', 'Common', [
                            'src'  => 'URI',
                            'type' => 'Text',
                        ]
                    );
                    if ($allow_style) {
                        $def->addElement('style', 'Block', 'Flow', 'Common', ['type' => 'Text']);
                    }
                }

                $purifier = new \HTMLPurifier($config);
            }
            if (_PS_MAGIC_QUOTES_GPC_) {
                $html = stripslashes($html);
            }

            $html = $purifier->purify($html);

            if (_PS_MAGIC_QUOTES_GPC_) {
                $html = addslashes($html);
            }
        }

        return $html;
    }

    /**
     * Check if a constant was already defined
     *
     * @param string $constant Constant name
     * @param mixed  $value    Default value to set if not defined
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function safeDefine($constant, $value)
    {
        if (!defined($constant)) {
            define($constant, $value);
        }
    }

    /**
     * Spread an amount on lines, adjusting the $column field,
     * with the biggest adjustments going to the rows having the
     * highest $sort_column.
     *
     * E.g.:
     *
     * $rows = [['a' => 5.1], ['a' => 8.2]];
     *
     * spreadAmount(0.3, 1, $rows, 'a');
     *
     * => $rows is [['a' => 8.4], ['a' => 5.2]]
     *
     * @param $amount        float  The amount to spread across the rows
     * @param $precision     int Rounding precision
     *                       e.g. if $amount is 1, $precision is 0 and $rows = [['a' => 2], ['a' => 1]]
     *                       then the resulting $rows will be [['a' => 3], ['a' => 1]]
     *                       But if $precision were 1, then the resulting $rows would be [['a' => 2.5], ['a' => 1.5]]
     * @param &$rows         array   An array, associative or not, containing arrays that have at least $column and $sort_column fields
     * @param $column        string The column on which to perform adjustments
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function spreadAmount($amount, $precision, &$rows, $column)
    {
        if (!is_array($rows) || empty($rows)) {
            return;
        }

        uasort($rows, function ($a, $b) use ($column) {
            return $b[$column] > $a[$column] ? 1 : -1;
        });

        $unit = pow(10, $precision);

        $int_amount = (int) round($unit * $amount);

        $remainder = $int_amount % count($rows);
        $amount_to_spread = ($int_amount - $remainder) / count($rows) / $unit;

        $sign = ($amount >= 0 ? 1 : -1);
        $position = 0;
        foreach ($rows as &$row) {
            $adjustment_factor = $amount_to_spread;

            if ($position < abs($remainder)) {
                $adjustment_factor += $sign * 1 / $unit;
            }

            $row[$column] += $adjustment_factor;

            ++$position;
        }
        unset($row);
    }

    /**
     * Replaces elements from passed arrays into the first array recursively
     *
     * @param array $base         The array in which elements are replaced.
     * @param array $replacements The array from which elements will be extracted.
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function arrayReplaceRecursive($base, $replacements)
    {
        if (function_exists('array_replace_recursive')) {
            return array_replace_recursive($base, $replacements);
        }

        foreach (array_slice(func_get_args(), 1) as $replacements) {
            $brefStack = [&$base];
            $headStack = [$replacements];

            do {
                end($brefStack);

                $bref = &$brefStack[key($brefStack)];
                $head = array_pop($headStack);
                unset($brefStack[key($brefStack)]);
                foreach (array_keys($head) as $key) {
                    if (isset($key, $bref) && is_array($bref[$key]) && is_array($head[$key])) {
                        $brefStack[] = &$bref[$key];
                        $headStack[] = $head[$key];
                    } else {
                        $bref[$key] = $head[$key];
                    }
                }
            } while (count($headStack));
        }

        return $base;
    }

    /**
     * Smarty {implode} plugin
     *
     * Type:     function<br>
     * Name:     implode<br>
     * Purpose:  implode Array
     * Use: {implode value="" separator=""}
     *
     * @link http://www.smarty.net/manual/en/language.function.fetch.php {fetch}
     *       (Smarty online manual)
     *
     * @param array                     $params   parameters
     * @param \Smarty_Internal_Template $template template object
     * @return string|null if the assign parameter is passed, Smarty assigns the result to a template variable
     */
    public static function smartyImplode($params, $template)
    {
        if (!isset($params['value']))
        {
            trigger_error("[plugin] implode parameter 'value' cannot be empty", E_USER_NOTICE);
            return;
        }

        if (empty($params['separator']))
            $params['separator'] = ',';

        return implode($params['value'], $params['separator']);
    }
}

/**
 * Compare 2 prices to sort products
 *
 * @param float $a
 * @param float $b
 *
 * @return int
 *
 * @since   1.0.0
 * @version 1.0.0 Initial version
 *
 * @todo    : move into class
 */
/* Externalized because of a bug in PHP 5.1.6 when inside an object */
function cmpPriceAsc($a, $b)
{
    if ((float) $a['price_tmp'] < (float) $b['price_tmp']) {
        return (-1);
    } elseif ((float) $a['price_tmp'] > (float) $b['price_tmp']) {
        return (1);
    }

    return 0;
}

/**
 * @param $a
 * @param $b
 *
 * @return int
 *
 * @since   1.0.0
 * @version 1.0.0 Initial version
 *
 * @todo    : move into class
 */
function cmpPriceDesc($a, $b)
{
    if ((float) $a['price_tmp'] < (float) $b['price_tmp']) {
        return 1;
    } elseif ((float) $a['price_tmp'] > (float) $b['price_tmp']) {
        return -1;
    }

    return 0;
}
