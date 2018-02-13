
<h2> Tutorial</h2>

<!-- Insert Video Embed code here-->



<h2><?php _e("Settings", __CLEAN_SLATE_PLUGIN_SLUG__);?></h2>

<form name="actionForm" id="actionForm" method="post" action="">
<div class="options">
<?php
    foreach(self::getOptions() as $name=>$array){
        $extraClass     = empty($array["class"]) ? "" : $array["class"];
?>
                <div class="option <?php echo $extraClass;?> <?php echo $name;?>">
<?php
        switch($array["type"]){
            case "heading":
?>
                <h3><?php echo $array["label"];?></h3>
<?php
                break;

            case "checkbox":
?>
                <input type="checkbox" name="options[]" id="<?php echo $name;?>" value="<?php echo $name;?>">
                <label for="<?php echo $name;?>"><?php echo $array["label"];?>
<?php
                if(!empty($array["image"])){
?>
                    <img src="<?php echo $array["image"];?>">
<?php
                }
?>
                </label>
<?php
                if(!empty($array["hidden"])){
?>
                <div class="option_sub" style="display: none">
<?php
                    foreach($array["hidden"] as $hidden){
?>
                        <div class="option_sub_sub">
<?php
                        switch ($hidden["type"]){
                            case "textarea":
                                if(!empty($hidden["label"])){
?>
                            <label for="<?php echo $hidden["name"];?>"><?php echo $hidden["label"];?></label>
<?php
                                }
?>
                            <textarea
                                placeholder="<?php echo (!empty($hidden["placeholder"]) ? $hidden["placeholder"] : "");?>"
                                name="<?php echo $hidden["name"];?>"
                                id="<?php echo $hidden["name"];?>"
                            ></textarea>
<?php
                                break;

                            case "textbox":
                                if(!empty($hidden["label"])){
?>
                            <label for="<?php echo $hidden["name"];?>"><?php echo $hidden["label"];?></label>
<?php
                                }
?>
                            <input
                                type="text" 
                                name="<?php echo $hidden["name"];?>"
                                id="<?php echo $hidden["name"];?>"
                                placeholder="<?php echo (!empty($hidden["placeholder"]) ? $hidden["placeholder"] : "");?>"
                            >
<?php
                                break;
                        }
?>
                        </div>
<?php
                    }
?>
                </div>
<?php
                }
                break;
        }
?>
                </div>
<?php
    }

    submit_button(__("Go", __CLEAN_SLATE_PLUGIN_SLUG__) . "!", "primary", __CLEAN_SLATE_PLUGIN_SLUG__ . "submit");
    $action     = __CLEAN_SLATE_PLUGIN_SLUG__;

?>
    <input type="hidden" name="action" value="<?php echo $action;?>">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce($action);?>">
</div>
</form>
