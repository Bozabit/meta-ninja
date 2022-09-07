<?php

/**
 * Updater Class, fired when required
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.1.0
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/includes
 * @author     Bozabit <bozabit@luckyseed.com>
 */
class Meta_Ninja_Updater
{
    private $_file;
    public function __construct($file)
    {
        $this->_file = $file;
    }
    public function check_updates()
    {
        require_once plugin_dir_path($this->_file) . 'plugin-update-checker/plugin-update-checker.php';
        $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
            'https://github.com/Bozabit/meta-ninja',
            $this->_file,
            'meta-ninja'
        );

        //Set the branch that contains the stable release.
        $myUpdateChecker->setBranch('master');
    }
}