<?php

class CleanSlateActions{

    public function delete_posts($name, $options, $class){
        $items  = get_posts(
                        array(
                            "posts_per_page"    => -1,
                            "post_type"         => "post",
                        )
        );
        foreach($items as $item){
            wp_delete_post($item->ID, true);
        }
    }

    public function delete_pages($name, $options, $class){
        $items      = get_posts(
                        array(
                            "posts_per_page"    => -1,
                            "post_type"         => "page",
                        )
        );
        foreach($items as $item){
            wp_delete_post($item->ID, true);
        }
    }

    public function delete_comments($name, $options, $class){
        $items      = get_comments();
        foreach($items as $item){
            wp_delete_comment($item->ID, true);
        }
    }

    public function delete_plugins($name, $options, $class){
        require_once trailingslashit(ABSPATH) . "wp-admin/includes/plugin.php";

        wp_clean_plugins_cache();
        $items      = get_plugins();
        $delete     = array();
        foreach($items as $file=>$item){
            $class::writeDebug("checking for $file, " . basename($file) . " wrt " . basename(__CLEAN_SLATE_FILE__));
            if(basename(WP_PLUGIN_DIR . $file) === basename(__CLEAN_SLATE_FILE__)) continue;
            $delete[]   = $file;
        }
        $class::writeDebug("deleting " . print_r($delete,true));
        self::addIfError(deactivate_plugins($delete), $class);
        self::addIfError(delete_plugins($delete), $class);
    }

    public function about_page($name, $options, $class){
        $subOptions = $options[$name]["hidden"];
        $title      = $options[$name]["title"];

        $body       = $options[$name]["content"];
        $hidden     = $options[$name]["hidden"];
        foreach($hidden as $field){
            $variable   = $field["name"];
            $value      = $_POST[$variable];
            $body       = str_replace($variable, $value, $body);
        }

        $errors     = array();
        if(get_page_by_title($title, OBJECT, "page") != NULL){
            $errors[]   = __("Page already exists", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
        }else{
            $page = array(
                "post_title"    => $title,
                "post_name"     => $title,
                "post_content"  => $body,
                "post_status"   => "publish",
                "post_type"     => "page",
            );

            $postID = wp_insert_post($page);
            if($postID === 0){
                $errors[]       = __("Unable to create page", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
            }
        }
        $class->addError($errors);
    }

    public function privacy_policy($name, $options, $class){
        $title      = $options[$name]["title"];
        $body       = $options[$name]["content"];
        if(is_array($body)){
            $body   = file_get_contents($body[0]);
        }

        $hidden     = $options[$name]["hidden"];
        foreach($hidden as $field){
            $variable   = $field["name"];
            $value      = $_POST[$variable];
            $body       = str_replace($variable, $value, $body);
        }

        $errors     = array();
        if(get_page_by_title($title, OBJECT, "page") != NULL){
            $errors[]   = __("Page already exists", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
        }else{
            $page = array(
                "post_title"    => $title,
                "post_name"     => $title,
                "post_content"  => $body,
                "post_status"   => "publish",
                "post_type"     => "page",
            );

            $postID = wp_insert_post($page);
            if($postID === 0){
                $errors[]       = __("Unable to create page", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
            }
        }
        $class->addError($errors);
    }

    public function terms_of_use($name, $options, $class){
        $title      = $options[$name]["title"];
        $body       = $options[$name]["content"];
        if(is_array($body)){
            $body   = file_get_contents($body[0]);
        }

        $hidden     = $options[$name]["hidden"];
        foreach($hidden as $field){
            $variable   = $field["name"];
            $value      = $_POST[$variable];
            $body       = str_replace($variable, $value, $body);
        }

        $errors     = array();
        if(get_page_by_title($title, OBJECT, "page") != NULL){
            $errors[]   = __("Page already exists", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
        }else{
            $page = array(
                "post_title"    => $title,
                "post_name"     => $title,
                "post_content"  => $body,
                "post_status"   => "publish",
                "post_type"     => "page",
            );

            $postID = wp_insert_post($page);
            if($postID === 0){
                $errors[]       = __("Unable to create page", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
            }
        }
        $class->addError($errors);
    }

    public function earnings_disclaimer($name, $options, $class){
        $title      = $options[$name]["title"];
        $variable   = $options[$name]["name"];
        $body       = $options[$name]["content"];
        if(is_array($body)){
            $body   = file_get_contents($body[0]);
        }
        $body       = str_replace($variable, home_url(), $body);

        $errors     = array();
        if(get_page_by_title($title, OBJECT, "page") != NULL){
            $errors[]   = __("Page already exists", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
        }else{
            $page = array(
                "post_title"    => $title,
                "post_name"     => $title,
                "post_content"  => $body,
                "post_status"   => "publish",
                "post_type"     => "page",
            );

            $postID = wp_insert_post($page);
            if($postID === 0){
                $errors[]       = __("Unable to create page", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
            }
        }
        $class->addError($errors);
    }

    public function contact_us($name, $options, $class){
        $title      = $options[$name]["title"];
        $body       = $options[$name]["content"];
        $errors     = array();
        if(get_page_by_title($title, OBJECT, "page") != NULL){
            $errors[]   = __("Page already exists", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
        }else{
            $page = array(
                "post_title"    => $title,
                "post_name"     => $title,
                "post_content"  => $body,
                "post_status"   => "publish",
                "post_type"     => "page",
            );

            $postID = wp_insert_post($page);
            if($postID === 0){
                $errors[]       = __("Unable to create page", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . $title;
            }
        }
        $class->addError($errors);

        $zip        = $options[$name]["zip"];
        $errors     = $this->installPlugins($zip, $class);
        $class->addError($errors);
    }

    public function permalinks($name, $options, $class){
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure("/%postname%/");
        flush_rewrite_rules();
    }

    public function stop_comment_notify($name, $options, $class){
        update_option("comments_notify", 0);
    }

    public function turn_off_comments($name, $options, $class){
        update_option("default_comment_status", 0);
    }

    public function stop_moderate_comment($name, $options, $class){
        update_option("moderation_notify", 0);
    }

    public function categories($name, $options, $class){
        $items          = @$_POST[$options[$name]["hidden"][0]["name"]];
        $errors         = array();

        if($items){
            $items      = explode(",", $items);
            array_filter($items);
            foreach($items as $item){
                $item   = trim($item);
                if(wp_create_category($item) == 0){
                    $errors[]       = $item;
                }
            }
        }

        if($errors){
            $error      = __("Unable to create categories", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . implode(", ", $errors);
            $errors     = array($error);
        }
        $class->addError($errors);
    }

    public function blank_pages($name, $options, $class){
        $items          = @$_POST[$options[$name]["hidden"][0]["name"]];
        $errors         = array();

        if($items){
            $items      = explode(",", $items);
            array_filter($items);
            foreach($items as $item){
                $item   = trim($item);
                $page = array(
                    "post_title"    => $item,
                    "post_name"     => $item,
                    "post_status"   => "publish",
                    "post_type"     => "page",
                );
                
                $postID = wp_insert_post($page);
                if($postID === 0){
                    $errors[]       = $item;
                }
            }
        }

        if($errors){
            $error      = __("Unable to create pages", __CLEAN_SLATE_PLUGIN_SLUG__) . ": " . implode(", ", $errors);
            $errors     = array($error);
        }
        $class->addError($errors);
    }

    public function install_plugin($name, $options, $class){
        $zip            = $options[$name]["zip"];
        $errors         = $this->installPlugins($zip, $class);
        $class->addError($errors);
    }

    public function plugin_custom($name, $options, $class){
        $zips       = @$_POST[$options[$name]["hidden"][0]["name"]];
        if($zips){
            $zips       = preg_split('/\r\n|[\r\n]/', $zips);
            $class::writeDebug("zips " . print_r($zips,true));
            array_filter($zips);
            $errors     = $this->installPlugins($zips, $class);
            $class->addError($errors);
        }
    }

    public function install_theme($name, $options, $class){
        $zip            = $options[$name]["zip"];
        $errors         = $this->installThemes($zip, $class);
        $class->addError($errors);
    }

    public function theme_custom($name, $options, $class){
        $zips       = @$_POST[$options[$name]["hidden"][0]["name"]];
        if($zips){
            $zips       = preg_split('/\r\n|[\r\n]/', $zips);
            $class::writeDebug("zips " . print_r($zips,true));
            array_filter($zips);
            $errors     = $this->installThemes($zips, $class);
            $class->addError($errors);
        }
    }

    private function installThemes($zip, $class){
        if(empty($zip) || !is_array($zip) || count($zip) == 0) return;

        require_once trailingslashit(ABSPATH) . "wp-admin/includes/plugin.php";
        WP_Filesystem();

        $themes         = wp_get_themes(array("errors" => null));
        $themesBefore   = array();
        foreach($themes as $theme){
            $themesBefore   = $theme->display("ThemeURI");
        }

        $errors         = array();
        foreach($zip as $file){
            $tmp    = download_url($file);
            if(self::addIfError($tmp, $class)){
                @unlink($tmp);
                continue;
            }

            $unzipped       = unzip_file($tmp, get_theme_root());
            @unlink($tmp);
            if(!$unzipped && self::addIfError($unzipped, $class)){
                continue;
            }
        }

        return $errors;
    }

    private function installPlugins($zip, $class){
        if(empty($zip) || !is_array($zip) || count($zip) == 0) return;

        require_once trailingslashit(ABSPATH) . "wp-admin/includes/plugin.php";
        WP_Filesystem();

        $pluginsBefore  = array_keys(get_plugins());
        $class::writeDebug("plugins already there " . print_r($pluginsBefore,true));

        $errors         = array();
        foreach($zip as $file){
            $class::writeDebug("downloading $file");
            $tmp    = download_url($file);
            $class::writeDebug("downloaded $file");
            if(self::addIfError($tmp, $class)){
                continue;
            }

            $class::writeDebug("unzipping $tmp");

            $unzipped       = unzip_file($tmp, WP_PLUGIN_DIR);
            @unlink($tmp);
            if(!$unzipped && self::addIfError($unzipped, $class)){
                continue;
            }
        }

        wp_clean_plugins_cache();
        $pluginsNow     = get_plugins();
        $class::writeDebug("plugins now " . print_r($pluginsNow,true));
        foreach($pluginsNow as $file=>$array){
            if(in_array($file, $pluginsBefore)) continue;
            $class::writeDebug("plugin to install " . $file);
            activate_plugin($file);
        }

        $class::writeDebug("errors = " . print_r($errors,true));        
        return $errors;
    }

    private static function addIfError($obj, $class){
        if(is_wp_error($obj)){
            $class::writeDebug("adding errror " . $obj->get_error_message());
            $class->addError($obj->get_error_message());
            return true;
        }
        return false;
    }
}
