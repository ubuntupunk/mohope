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

/**
 * Class ContextCore
 *
 * @since 1.0.0
 */
class Context
{
    // @codingStandardsIgnoreStart
    /** @var int */
    const DEVICE_COMPUTER = 1;
    /** @var int */
    const DEVICE_TABLET = 2;
    /** @var int */
    const DEVICE_MOBILE = 4;
    /** @var int */
    const MODE_STD = 1;
    /** @var int */
    const MODE_STD_CONTRIB = 2;
    /** @var int */
    const MODE_HOST_CONTRIB = 4;
    /** @var int */
    const MODE_HOST = 8;
    /* @var Context */
    protected static $instance;
    /** @var Cart */
    public $cart;
    /** @var Customer */
    public $customer;
    /** @var Cookie */
    public $cookie;
    /** @var Link */
    public $link;
    /** @var Country */
    public $country;
    /** @var Employee */
    public $employee;
    /** @var AdminController|FrontController */
    public $controller;
    /** @var string */
    public $override_controller_name_for_translations;
    /** @var Language */
    public $language;
    /** @var Currency */
    public $currency;
    /** @var AdminTab */
    public $tab;
    /** @var Shop */
    public $shop;
    /** @var Theme */
    public $theme;
    /** @var Smarty */
    public $smarty;
    /** @var Mobile_Detect */
    public $mobile_detect;
    /** @var int */
    public $mode;
    /**
     * Mobile device of the customer
     *
     * @var bool|null
     */
    protected $mobile_device = null;
    /** @var bool|null */
    protected $is_mobile = null;
    /** @var bool|null */
    protected $is_tablet = null;
    // @codingStandardsIgnoreEnd

    /**
     * @param $test_instance Context
     *                       Unit testing purpose only
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function setInstanceForTesting($test_instance)
    {
        static::$instance = $test_instance;
    }

    /**
     * Unit testing purpose only
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function deleteTestingInstance()
    {
        static::$instance = null;
    }

    /**
     * Get a singleton instance of Context object
     *
     * @return Context
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public static function getContext()
    {
        if (!isset(static::$instance)) {
            static::$instance = new Context();
        }

        return static::$instance;
    }

    /**
     * Checks if visitor's device is a mobile device
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public function isMobile()
    {
        if ($this->is_mobile === null) {
            $this->is_mobile = false;
        }

        return $this->is_mobile;
    }

    /**
     * Checks if visitor's device is a tablet device
     *
     * @return bool
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public function isTablet()
    {
        if ($this->is_tablet === null) {;
            $this->is_tablet = false;
        }

        return $this->is_tablet;
    }

    /**
     * Returns mobile device type
     *
     * @return int
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public function getDevice()
    {
        static $device = null;

        if ($device === null) {
            if ($this->isTablet()) {
                $device = Context::DEVICE_TABLET;
            } elseif ($this->isMobile()) {
                $device = Context::DEVICE_MOBILE;
            } else {
                $device = Context::DEVICE_COMPUTER;
            }
        }

        return $device;
    }

    /**
     * Clone current context object
     *
     * @return Context
     *
     * @since   1.0.0
     * @version 1.0.0 Initial version
     */
    public function cloneContext()
    {
        return clone($this);
    }
}
