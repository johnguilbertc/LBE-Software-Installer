<?php
/**
* Plugin Name: LBE Software Installer
* Plugin URI: http://www.marketingwithdan.com
* Description: Install LBE-Approved Plugins
* Version: 1.1.6
* Author: Dan Mattson
* Author URI: http://www.marketingwithdan.com
* License: GPL2
*/
/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*Start kernl code*/
require 'plugin_update_check.php';
$MyUpdateChecker = new PluginUpdateChecker_2_0 (
   'https://kernl.us/api/v1/updates/597549a5e8f81a4a458d879c/',
   __FILE__,
   'my-plugin-slug',
   1
);
// $MyUpdateChecker->purchaseCode = "WI4N58YCIS37N5";
// $MyUpdateChecker->remoteGetTimeout = 5;
/*End kernl code*/

define("__CLEAN_SLATE_PLUGIN_NAME__", "LBE Software Installer");
define("__CLEAN_SLATE_PLUGIN_SLUG__", "__clean_slate_");
define("__CLEAN_SLATE_VERSION__", 1.0);
define("__CLEAN_SLATE_FILE__", __FILE__);
define("__CLEAN_SLATE_DIR__", trailingslashit(plugin_dir_path(__FILE__)));
define("__CLEAN_SLATE_URL__", plugin_dir_url(__FILE__));
define("__CLEAN_SLATE_ROOT__", trailingslashit(plugins_url("", __FILE__)));
define("__CLEAN_SLATE_RESOURCES__", __CLEAN_SLATE_ROOT__ . "resources/");
define("__CLEAN_SLATE_IMAGES__", __CLEAN_SLATE_RESOURCES__ . "images/");
define("__CLEAN_SLATE_DEBUG__", false);
define("__CLEAN_SLATE_TEST__", false);
define("__CLEAN_SLATE_STAGING__", false);

if(__CLEAN_SLATE_DEBUG__){
    @error_reporting(E_ALL);
    @ini_set("display_errors", "1");
}

/**
 * Abort loading if WordPress is upgrading
 */
if (defined("WP_INSTALLING") && WP_INSTALLING) return;

class CleanSlate{

    private $error      = array();

    public static function getOptions(){
        return array(
            "about_page"    => array(
                                "label"     => __("Create About Page", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "title"     => "About Us",
                                "content"   => "Hi, and welcome to about_page_site.<br>This site was create to discuss topics like about_page_topics, and much more.<br>Be sure to check back often!",
                                "hidden"    => array(
                                    array(
                                        "name"      => "about_page_site",
                                        "label"      => __("Site Name", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "placeholder"   => __("e.g. Monkey Catching Club", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                    array(
                                        "name"      => "about_page_topics",
                                        "label"      => __("Topics Covered", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "placeholder"   => __("e.g. Catching Monkeys, Best Monkey Nets", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                )
            ),
            "privacy_policy"
                            => array(
                                "label"     => __("Create Privacy Policy Page", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "title"     => "Privacy Policy",
                                "content"   => array(__CLEAN_SLATE_DIR__ . "resources/admin/templates/privacy_policy.html"),
                                "hidden"    => array(
                                    array(
                                        "name"      => "privacy_policy_company",
                                        "label"      => __("Company Name", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                    array(
                                        "name"      => "privacy_policy_email",
                                        "label"      => __("Email Address", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                    array(
                                        "name"      => "privacy_policy_address",
                                        "label"      => __("Business Address", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textarea",
                                    ),
                                )
            ),
            "terms_of_use"
                            => array(
                                "label"     => __("Create Terms Of Use Page", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "title"     => "Terms of Use",
                                "content"   => array(__CLEAN_SLATE_DIR__ . "resources/admin/templates/terms_of_use.html"),
                                "hidden"    => array(
                                    array(
                                        "name"      => "terms_of_use_company",
                                        "label"      => __("Company Name", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                    array(
                                        "name"      => "terms_of_use_address",
                                        "label"      => __("Business Address", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textarea",
                                    ),
                                    array(
                                        "name"      => "terms_of_use_country",
                                        "label"      => __("Country", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                )
            ),
            "earnings_disclaimer"
                            => array(
                                "label"     => __("Create Earnings Disclaimer Page", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "title"     => "Earnings Disclaimer",
                                "name"      => "website_url",
                                "content"   => array(__CLEAN_SLATE_DIR__ . "resources/admin/templates/earnings_disclaimer.html"),
            ),
            "contact_us"    => array(
                                "label"      => __("Create Contact Us Page (will also install Contact Form 7)", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"  => "checkbox",
                                "zip"       => array(
                                    "https://downloads.wordpress.org/plugin/contact-form-7.4.9.2.zip"
                                ),
                                "title"     => "Contact Us",
                                "content"   => "To get in contact with us, fill out the form below.<br>Please allow us up to 72 hours for our reply<br>[contact-form-7 title=\"Contact form 1\"]"

            ),
            "permalinks"    => array(
                                "label"     => __("Set Permalinks to Post Name", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
            ),
            "stop_comment_notify"
                            => array(
                                "label"     => __("Stop new comment notifications via email", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
            ),
            "stop_moderate_comment"
                            => array(
                                "label"     => __("Stop moderate comment notifications via email", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
            ),
            "turn_off_comments"
                            => array(
                                "label"     => __("Turn Off Comments For Pages/Posts", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
            ),
            "categories"    => array(
                                "label"     => __("Create Multiple Categories Quickly", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "hidden"    => array(
                                    array(
                                        "name"      => "category_names",
                                        "label"      => __("Enter multiple category names separated by comma", __CLEAN_SLATE_PLUGIN_SLUG__) . " (,)",
                                        "placeholder"   => __("e.g. Reviews, Advice, Products", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                )
            ),
            "blank_pages"   => array(
                                "label"     => __("Create New Blank Pages", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "hidden"    => array(
                                    array(
                                        "name"      => "blank_page_names",
                                        "label"      => __("Enter multiple page names separated by comma", __CLEAN_SLATE_PLUGIN_SLUG__) . " (,)",
                                        "placeholder"   => __("e.g. Contact, Careers, Affiliates", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "type"      => "textbox",
                                    ),
                                )
            ),
            "heading_1"     => array(
                                "label"     => __("Install Common Plugins", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "heading",
            ),
            "plugin_wordfence"
                            => array(
                                "label"     => __("Wordfence Security", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://downloads.wordpress.org/plugin/wordfence.6.3.22.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_w3totalcache"
                            => array(
                                "label"     => __("W3 Total Cache (Do NOT use caching on membership sites)", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://downloads.wordpress.org/plugin/w3-total-cache.0.9.6.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_yoastseo"
                            => array(
                                "label"     => __("Yoast SEO", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://downloads.wordpress.org/plugin/wordpress-seo.6.1.1.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_gabyyoast"
                            => array(
                                "label"     => __("Google Analytics by MonsterInsights", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://downloads.wordpress.org/plugin/google-analytics-for-wordpress.6.2.7.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_contactform7"
                            => array(
                                "label"     => __("Contact Form 7", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://downloads.wordpress.org/plugin/contact-form-7.4.9.2.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_updraft"
                            => array(
                                "label"     => __("UpdraftPlus Backup and Restoration", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://downloads.wordpress.org/plugin/updraftplus.1.14.2.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_generatepress"
                            => array(
                                "label"     => __("GeneratePress License Plugin (Required for GeneratePress Theme)", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("http://lbehost.com/lbe/gp-premium-156.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_thrive"
                            => array(
                                "label"     => __("Thrive Architect (NOTE: Activate License BEFORE Updating)", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("http://lbehost.com/lbe/thrive-architect-209.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_instabuilder"
                            => array(
                                "label"      => __("InstaBuilder (NOTE: Activate License BEFORE Updating)", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://www.dropbox.com/s/spcra1j5r9iv62s/instabuilder2-lic.zip?dl=1"),
                                "action"    => "install_plugin"
            ),
            "plugin_instamember"
                            => array(
                                "label"      => __("InstaMember (NOTE: Activate License BEFORE Updating)", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://www.dropbox.com/s/eps79kwjlv54ydj/InstaMember-lic.zip?dl=1"),
                                "action"    => "install_plugin"
            ),
            "plugin_wpmailsmtp"
                            => array(
                                "label"      => __("WP Mail SMTP by WPForms (WP-Mail-SMTP) - Use this with InstaMember", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "zip"       => array("https://downloads.wordpress.org/plugin/wp-mail-smtp.zip"),
                                "action"    => "install_plugin"
            ),
            "plugin_custom" => array(
                                "label"     => __("Install Custom Plugins", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "checkbox",
                                "hidden"    => array(
                                    array(
                                        "name"      => "plugin_custom_names",
                                        "label"   => __("Enter URLs for Zip files, one per line", __CLEAN_SLATE_PLUGIN_SLUG__),
                                        "placeholder"   => "e.g. https://downloads.wordpress.org/plugin/buddypress.2.9.2.zip",
                                        "type"      => "textarea",
                                    ),
                                )
            ),
            "heading_2"     => array(
                                "label"     => __("Install LBE Themes", __CLEAN_SLATE_PLUGIN_SLUG__),
                                "type"      => "heading",
            ),
            "theme_1"       => array(
                                "label"     => "GeneratePress (Used in Physical Product Bootcamp)",
                                "type"      => "checkbox",
                                "image"     => __CLEAN_SLATE_IMAGES__ . "gp.png",
                                "zip"       => array("http://downloads.wordpress.org/theme/generatepress.2.0.2.zip"),
                                "action"    => "install_theme",
                                "class"     => "common_theme",
            ),
            "theme_2"       => array(
                                "label"     => "LBE Article Theme (Used in Affiliate Success Bootcamp)",
                                "type"      => "checkbox",
                                "image"     => __CLEAN_SLATE_IMAGES__ . "womness.png",
                                "zip"       => array("https://kernl.us/api/v1/archive/5a65398160776c69a3de4782"),
                                "action"    => "install_theme",
                                "class"     => "common_theme",
                                ),
                            );
    }

    public function __construct(){
        // all hooks and actions
        register_activation_hook(__FILE__ , array($this, "clean_slate_activate"));
        register_deactivation_hook(__FILE__ , array($this, "clean_slate_deactivate"));

        add_action("init", array($this, "clean_slate_register"));
        add_action("admin_enqueue_scripts", array($this, "clean_slate_includeResources"));
        add_action("plugins_loaded", array($this, "clean_slate_i18n"));
        add_action("admin_menu", array($this, "clean_slate_add_menu"));

        // custom
        require_once __CLEAN_SLATE_DIR__ . "resources/admin/includes/actions.php";
        $actions        = new CleanSlateActions;
        foreach(self::getOptions() as $name=>$option){
            $action     = $name;
            if(!empty($option["action"])){
                $action = $option["action"];
            }
            add_action(__CLEAN_SLATE_PLUGIN_SLUG__ . $name, array($actions, $action), 10, 4);
        }
    }

    /**
     * Initializes the locale
     */
    function clean_slate_i18n(){
        $pluginDirName  = dirname(plugin_basename(__FILE__));
        $domain         = __CLEAN_SLATE_PLUGIN_SLUG__;
        $locale         = apply_filters("plugin_locale", get_locale(), $domain);
        load_textdomain($domain, WP_LANG_DIR . "/" . $pluginDirName . "/" . $domain . "-" . $locale . ".mo");
        load_plugin_textdomain($domain, "", $pluginDirName . "/resources/lang/");
    }

    /**
     * Initializes the admin menu
     */
    function clean_slate_add_menu(){
        add_menu_page(__CLEAN_SLATE_PLUGIN_NAME__, __CLEAN_SLATE_PLUGIN_NAME__, "manage_options", __CLEAN_SLATE_PLUGIN_SLUG__, array($this, "clean_slate_settings"));
    }

    /**
     * Saves settings from the settings screen
     */
    function clean_slate_settings(){
        if(isset($_POST[__CLEAN_SLATE_PLUGIN_SLUG__ . "submit"]) && wp_verify_nonce($_POST["nonce"], $_POST["action"])){
            include_once __CLEAN_SLATE_DIR__ . "resources/admin/includes/settings-pre.php";
            ob_flush();
            flush();

            set_time_limit(0);
            $this->doAction();
        }

        include_once __CLEAN_SLATE_DIR__ . "resources/admin/includes/settings.php";
        ob_end_flush();
    }

    private function doAction(){
        self::writeDebug("in doAction " . print_r($_POST,true));
        $options        = self::getOptions();
        $opts           = empty($_POST["options"]) ? array() : $_POST["options"];
        foreach($opts as $name){
            do_action(__CLEAN_SLATE_PLUGIN_SLUG__ . $name, $name, $options, $this);
        }

        array_filter($this->error);

        if($this->error){
            $msg        = "";
            foreach($this->error as $indx=>$error){
                $msg    .= $error . "<br>";
            }
            echo "<div class='error'><p>$msg</p></div>";
        }else{
            $msg        = " Please <a href='" . admin_url() . "'>Click Here</a> to return to your dashboard to finalize all options";
            echo "<div class='updated'><p>" . __("Done", __CLEAN_SLATE_PLUGIN_SLUG__) . "!" . $msg . "</p></div>";
        }
    }

    public function addError($error){
        if($error){
            if(is_string($error)){
                $this->error[]      = $error;
            }else if(is_array($error) && count($error) > 0){
                foreach($error as $e){
                    $this->error[]  = $e;
                }
            }
        }
    }


    /**
     * Loads the JS and CSS resources
     */
    function clean_slate_includeResources() {
        wp_enqueue_script("jquery");

        wp_register_script(__CLEAN_SLATE_PLUGIN_SLUG__, __CLEAN_SLATE_RESOURCES__ . "admin/js/clean-slate.js", array("jquery"), null, true);
        wp_enqueue_script(__CLEAN_SLATE_PLUGIN_SLUG__);
        wp_localize_script(__CLEAN_SLATE_PLUGIN_SLUG__, "cs", array(
            "i18n"      => array(
                "noSubOptionsMsg"   => __("Please provide", __CLEAN_SLATE_RESOURCES__),
                "selectOneMsg"      => __("Please select at least one option", __CLEAN_SLATE_RESOURCES__),
            )
        ));

        wp_register_style(__CLEAN_SLATE_PLUGIN_SLUG__, __CLEAN_SLATE_RESOURCES__ . "admin/css/clean-slate.css");
        wp_enqueue_style(__CLEAN_SLATE_PLUGIN_SLUG__);
    }

    function clean_slate_register(){
        // do nothing
    }

    /**
     * Activate the plugin
     */
    function clean_slate_activate(){
        // do nothing
    }

    /**
     * Deactivate the plugin
     */
    function clean_slate_deactivate(){
        if(__CLEAN_SLATE_TEST__ || __CLEAN_SLATE_STAGING__){
            define("WP_UNINSTALL_PLUGIN", true);
            include_once __CLEAN_SLATE_DIR__ . "uninstall.php";
        }
    }


    /****************************************** Util functions ******************************************/

    /**
     * Writes to the file /tmp/log.log if DEBUG is on
     */
    public static function writeDebug($msg){
        if(__CLEAN_SLATE_DEBUG__) file_put_contents(__CLEAN_SLATE_DIR__ . "tmp/log.log", date("F j, Y H:i:s") . " - " . $msg."\n", FILE_APPEND);
    }

    /**
     * Custom wrapper for the get_option function
     *
     * @return string
     */
    public static function getOption($field, $clean=false){
        $val = get_option(__CLEAN_SLATE_PLUGIN_SLUG__ . $field);
        return $clean ? htmlspecialchars($val) : $val;
    }

    /**
     * Custom wrapper for the update_option function
     *
     * @return mixed
     */
    public static function setOption($field, $value){
        return update_option(__CLEAN_SLATE_PLUGIN_SLUG__ . $field, $value);
    }

}

$cleanSlate = new CleanSlate();
