<?php
/**
 * Copyright (C) 2018-2019 thirty bees
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    thirty bees <modules@thirtybees.com>
 * @copyright 2018-2019 thirty bees
 * @license   Academic Free License (AFL 3.0)
 */

if (!defined('_TB_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_.'/coreupdater/classes/GitUpdate.php';

/**
 * Class AdminCoreUpdaterController.
 */
class AdminCoreUpdaterController extends ModuleAdminController
{
    const API_URL   = 'https://api.thirtybees.com/installationmaster.php';
    const CHANNELS  = [
        'Stable'                      => 'tags',
        'Bleeding Edge'               => 'branches',
        //'Developer (enter Git hash)'  => 'gitHash', // implementation postponed
    ];
    // For the translations parser:
    // $this->l('Stable');
    // $this->l('Bleeding Edge');
    // $this->l('Developer (enter Git hash)');

    /**
     * Where manually modified files get backed up before they get overwritten
     * by the new version. A directory path, which gets appended by a date of
     * the format BACKUP_DATE_SUFFIX (should give a unique suffix).
     */
    const BACKUP_PATH = _PS_ADMIN_DIR_.'/CoreUpdaterBackup';
    const BACKUP_DATE_SUFFIX = '-Y-m-d--H-i-s';

    /**
     * AdminCoreUpdaterController constructor.
     *
     * @version 1.0.0 Initial version.
     */
    public function __construct()
    {
        $this->bootstrap = true;
        Shop::setContext(Shop::CONTEXT_ALL);

        // Take a shortcut for Ajax requests.
        if (Tools::getValue('ajax')) {
            $action = Tools::getValue('action');

            if ($action === 'UpdateIgnoreTheme') {
                // Here it gets ugly. There is no simple default processing
                // implemented in core.

                $success = Configuration::updateValue(
                    'CORE_UPDATER_IGNORE_THEME',
                    Tools::getValue('value'));

                $confirmations = [];
                $error = false;
                if ($success) {
                    $confirmations[] = $this->l('Ignorance setting updated.');
                } else {
                    $error = $this->l('Could not update ignorance of the community theme.');
                }

                die(json_encode([
                    'confirmations' => $confirmations,
                    'error'         => $error,
                ]));
            }

            // Else it should be a step processing request.
            // This does not return.
            $this->ajaxProcess($action);
        }

        $displayChannelList = [];
        foreach (static::CHANNELS as $channel => $path) {
            $displayChannelList[] = [
                'channel' => $path,
                'name'    => $this->l($channel),
            ];
        }

        $installedVersion = \CoreUpdater\GitUpdate::getInstalledVersion();
        $selectedVersion = Tools::getValue('CORE_UPDATER_VERSION');
        if ( ! $selectedVersion) {
            $selectedVersion = $installedVersion;
        }

        $this->fields_options = [
            'updatepanel' => [
                'title'       => $this->l('Version Select'),
                'icon'        => 'icon-beaker',
                'description' => '<p>'
                                 .$this->l('Here you can update your thirty bees installation and/or switch between thirty bees versions easily.')
                                 .'</p><ol><li>'
                                 .$this->l('Select the version you want to update to. This can be a newer version or an older version, or even the current version (to investigate or fix this installation).')
                                 .'</li><li>'
                                 .$this->l('Click on "Compare". Doing so compares this installation with a clean installation of the selected version.')
                                 .'</li><li>'
                                 .$this->l('Look at the comparison result and proceed accordingly. Clicking on list titles opens them. If you\'re in a hurry or don\'t know what all these lists mean, just click "Update". Update defaults are safe.')
                                 .'</li></ol>',
                'info'        => $this->l('Current thirty bees version:')
                                 .' <b>'.$installedVersion.'</b>',
                'submit'      => [
                    'title'     => $this->l('Compare'),
                    'imgclass'  => 'refresh',
                    'name'      => 'coreUpdaterCompare',
                ],
                'fields' => [
                    'CORE_UPDATER_PARAMETERS' => [
                        'type'        => 'hidden',
                        'value'       => htmlentities(json_encode([
                            'apiUrl'          => static::API_URL,
                            'selectedVersion' => $selectedVersion,
                            'completedLog'    => $this->l('completed'),
                            'completedList'   => $this->l('%d items'),
                            'errorRetrieval'  => $this->l('request failed, see JavaScript console'),
                            'errorProcessing' => $this->l('Processing failed.'),
                        ])),
                        'auto_value' => false,
                    ],
                    'CORE_UPDATER_CHANNEL' => [
                        'type'        => 'select',
                        'title'       => $this->l('Channel:'),
                        'desc'        => $this->l('This is the Git channel to update from. "Stable" lists releases, "Bleeding Edge" lists development branches.'),
                        'identifier'  => 'channel',
                        'list'        => $displayChannelList,
                    ],
                    'CORE_UPDATER_VERSION' => [
                        'type'        => 'select',
                        'title'       => $this->l('Version to compare to:'),
                        'desc'        => $this->l('Retrieving versions for this channel ...'),
                        'identifier'  => 'version',
                        'list'        => [
                            [
                                'version' => '',
                                'name'    => '',
                            ],
                        ],
                    ],
                    'CORE_UPDATER_IGNORE_THEME' => [
                        'type'       => 'bool',
                        'title'      => $this->l('Ignore community themes'),
                        'desc'       => $this->l('When enabled, the updater ignores themes coming with thirty bees. While this prohibits bugs from getting fixed, it can make sense for those who customized this theme for their needs, without making a copy before.'),
                        'default'    => false,
                    ],
                ],
            ],
        ];

        if (Tools::isSubmit('coreUpdaterCompare')) {
            /*
             * Show an empty file compare panel. Existence of this panel
             * causes JavaScript to trigger requests for doing all the steps
             * necessary for preparing an update, which also fills the lists.
             */
            $this->fields_options['comparepanel'] = [
                'title'       => $this->l('Update Comparison'),
                'description' => '<p>'
                                 .$this->l('This panel compares all files of this shop installation with a clean installation of the version given above. To update this shop to that version, update all files to the clean installation.')
                                 .'</p><p>'
                                 .$this->l('Manually edited files will get backed up before they get overwritten.')
                                 .'</p>',
                'submit'      => [
                    'title'     => $this->l('Update'),
                    'imgclass'  => 'update',
                    'name'      => 'coreUpdaterUpdate',
                ],
                'fields' => [
                    'CORE_UPDATER_PROCESSING' => [
                        'type'        => 'textarea',
                        'title'       => $this->l('Processing log:'),
                        'cols'        => 2000,
                        'rows'        => 3,
                        'value'       => $this->l('Starting...'),
                        'auto_value'  => false,
                    ],
                    'CORE_UPDATER_INCOMPATIBLE' => [
                        'type'        => 'none',
                        'title'       => $this->l('Incompatible modules to get uninstalled:'),
                        'desc'        => $this->l('These modules are currently installed, but not compatible with the target thirty bees version. They\'ll get uninstalled and deleted when updating.'),
                    ],
                    'CORE_UPDATER_UPDATE' => [
                        'type'        => 'none',
                        'title'       => $this->l('Files to get changed:'),
                        'desc'        => $this->l('These files get updated for the version change. "M" means, doing so overwrites manual local edits of this file.'),
                    ],
                    'CORE_UPDATER_ADD' => [
                        'type'        => 'none',
                        'title'       => $this->l('Files to get created:'),
                        'desc'        => $this->l('These files get created for the version change.'),
                    ],
                    'CORE_UPDATER_REMOVE' => [
                        'type'        => 'none',
                        'title'       => $this->l('Files to get removed:'),
                        'desc'        => $this->l('These files get removed for the version change. "M" means, doing so also removes manual local edits of this file.'),
                    ],
                    'CORE_UPDATER_REMOVE_OBSOLETE' => [
                        'type'        => 'none',
                        'title'       => $this->l('Obsolete files:'),
                        'desc'        => '<p>'
                                         .$this->l('These files exist locally, but are not needed for the selected version of thirty bees core. Mark the checkbox(es) to remove them.')
                                         .'</p><p>'
                                         .$this->l('Obsolete files are generally harmless. PrestaShop and thirty bees before v1.0.8 didn\'t even have tools to detect them. Some of these files might be in use by modules, so it\'s better to keep them. That\'s why there\'s no "select all" button.')
                                         .'</p>',
                    ],
                ],
            ];
        } elseif (Tools::isSubmit('coreUpdaterUpdate')) {
            /*
             * Show an empty file processing panel. Existence of this panel
             * causes JavaScript to trigger requests for doing all the steps
             * necessary processing the update.
             */
            $this->fields_options['processpanel'] = [
                'title'       => $this->l('Update Processing'),
                'info'        => sprintf($this->l('Processing update from %s to %s.'),
                                         '<b>'.$installedVersion.'</b>',
                                         '<b>'.$selectedVersion.'</b>'),
                'submit'      => [
                    'title'     => $this->l('Finalize'),
                    'imgclass'  => 'ok',
                    'name'      => 'coreUpdaterFinalize',
                ],
                'fields' => [
                    // Intentionally the same name as in the comparepanel.
                    'CORE_UPDATER_PROCESSING' => [
                        'type'        => 'textarea',
                        'title'       => $this->l('Processing log:'),
                        'cols'        => 2000,
                        'rows'        => 10,
                        'value'       => $this->l('Starting...'),
                        'auto_value'  => false,
                    ],
                ],
            ];
        } else {
            // New session.
            \CoreUpdater\GitUpdate::deleteStorage(false);
        }

        parent::__construct();
    }

    /**
     * Get back office page HTML.
     *
     * @return string Page HTML.
     *
     * @version 1.0.0 Initial version.
     */
    public function initContent()
    {
        $this->page_header_toolbar_title = $this->l('Core Updater');

        parent::initContent();
    }

    /**
     * Set media.
     *
     * @version 1.0.0 Initial version.
     */
    public function setMedia()
    {
        parent::setMedia();

        $this->addJquery();
        $this->addJS(_PS_MODULE_DIR_.'coreupdater/views/js/controller.js');
    }

    /**
     * Post processing. All custom code, no default processing used.
     *
     * @version 1.0.0 Initial version.
     */
    public function postProcess()
    {
        /**
         * Collect parameters sent back. This uses the same hidden input field
         * which is used to forward parameters to the browser.
         */
        $parameters = Tools::getValue('CORE_UPDATER_PARAMETERS');
        if ($parameters) {
            $parameters = json_decode($parameters, true);
            if (array_key_exists('selectedObsolete', $parameters)) {
                \CoreUpdater\GitUpdate::setSelectedObsolete(
                    $parameters['selectedObsolete']
                );
            }
        }

        /**
         * Send a confirmation message with the finalize step. Default action
         * is to show the initial page already.
         */
        if (Tools::isSubmit('coreUpdaterFinalize')) {
            $message = '<p>'.$this->l('Shop updated successfully.').'</p>';
            $backupDir = \CoreUpdater\GitUpdate::getBackupDir();
            if ($backupDir) {
                $message .= '<p>';
                $message .= sprintf($this->l('Manually edited files, if any, were backed up in %s.'), $backupDir);
                $message .= '</p>';
            }

            $this->confirmations[] = $message;
        }

        // Intentionally not calling parent, there's nothing to do.
    }

    /**
     * Process one step of a version comparison. The calling panel repeats this
     * request as long as 'done' returns false. Each call should not exceed
     * 3 seconds for a good user experience and a safe margin against the 30
     * seconds guaranteed maximum processing time.
     *
     * This function is expected to not return.
     *
     * @param string $type Process type. 'processCompare' triggers
     *                     GitUpdate::compareStep(), 'processUpdate' triggers
     *                     GitUpdate::updateStep(), everything else is invalid.
     *
     * @version 1.0.0 Initial version.
     */
    public function ajaxProcess($type) {
        $messages = [
            // List of message texts of any kind.
            'informations'  => [],
            // Whether an error occured. Implies 'done' = true.
            'error'         => false,
            // Whether the sequence of of steps is completed.
            'done'          => true,
        ];

        $method = lcfirst(preg_replace('/^process/', '', $type)).'Step';
        if ( ! method_exists('\CoreUpdater\GitUpdate', $method)) {
            die('Invalid request for Ajax action \''.$type.'\'.');
        }

        $version = Tools::getValue('compareVersion');
        if ( ! $version) {
            die('Parameter \'compareVersion\' is empty.');
        }

        $start = time();
        do {
            $stepStart = microtime(true);

            \CoreUpdater\GitUpdate::{$method}($messages, $version);
            if ($messages['error']) {
                $messages['done'] = true;
            }

            $messages['informations'][count($messages['informations']) - 1]
                .= sprintf(' (%.1f s)', microtime(true) - $stepStart);
        } while ($messages['done'] !== true
                 && ! array_key_exists('updateScript', $messages)
                 && time() - $start < 3);

        die(json_encode($messages));
    }
}
