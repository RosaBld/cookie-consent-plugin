<?php
    function generate($field_name, $group = false, $default=false) { 
        $values = get_field("cookies_styles","options");


        if ($values && isset($values[$group]) && isset($values[$group][$field_name])) {
            $val = $values[$group][$field_name];
    
            // Check if the value is not empty
            if ($val != "") {
                // Echo the CSS variable with the fetched value
                echo "$val" ;
            } else {
                echo " ";
            }
        } else {
            echo "Values is not set or $field_name key does not exist!";
        }
    }

    function generateButton($field_name, $button_type = false, $group = 'boutons', $default=false) { 
        $values = get_field("cookies_styles","options");
    
        if ($values && isset($values[$group]) && isset($values[$group][$button_type]) && isset($values[$group][$button_type][$field_name])) {
            $val = $values[$group][$button_type][$field_name];
    
            // Check if the value is not empty
            if ($val != "") {
                // Echo the CSS variable with the fetched value
                echo "$val" ;
            } else {
                echo " ";
            }
        } else {
            echo "Values is not set or $field_name key does not exist!";
        }
    }
?>

:root {
    --cc-fonts-copy: <?php generate("--cc-fonts-copy", "fonts") ?>;
    --cc-fonts-title: <?php generate("--cc-fonts-title", "fonts") ?>;
    --cc-colors-main: <?php generate("--cc-colors-main", "fonts") ?>;
    --cc-colors-secondary: <?php generate("--cc-colors-secondary", "fonts") ?>;
    --cc-colors-copy: <?php generate("--cc-colors-copy", "fonts") ?>;
    --cc-global-vars-borderRadius: <?php generate("--cc-global-vars-borderRadius", "fonts") ?>;
    
    --banner-consent-background: <?php generate("--banner-consent-background", "banner") ?>;
    --banner-consent-boxShadow: <?php generate("--banner-consent-boxShadow", "banner") ?>;
    --banner-consent-color: <?php generate("--banner-consent-color", "banner") ?>;
    --banner-consent-borderRadius: <?php generate("--banner-consent-borderradius", "banner") ?>;
    --banner-consent-width: <?php generate("--banner-consent-width", "banner") ?>;

    --popup-consent-color: <?php generate("--popup-consent-color", "popup") ?>;
    --popup-consent-background: <?php generate("--popup-consent-background", "popup") ?>;
    --popup-consent-overlayBackground: <?php generate("--popup-consent-overlayBackground", "popup") ?>;
    --popup-consent-borderRadius: <?php generate("--popup-consent-borderRadius", "popup") ?>;
    --popup-consent-padding: <?php generate("--popup-consent-padding", "popup") ?>;
    --popup-consent-tableBorderRadius: <?php generate("--popup-consent-tableBorderRadius", "popup") ?>;
    --popup-consent-tableBackground: <?php generate("--popup-consent-tableBackground", "popup") ?>;
    --popup-consent-tableHeadBackground: <?php generate("--popup-consent-tableHeadBackground", "popup") ?>;
    --popup-consent-tableHeadColor: <?php generate("--popup-consent-tableHeadColor", "popup") ?>;
    --popup-consent-tableBodyBorder: <?php generate("--popup-consent-tableBodyBorder", "popup") ?>;
    --popup-consent-tableBodyFontSize: <?php generate("--popup-consent-tableBodyFontSize", "popup") ?>;

    --popup-consent-toggleAgreed: <?php generate("--popup-consent-toggleAgreed", "toggle") ?>;
    --popup-consent-toggleBackground: <?php generate("--popup-consent-toggleBackground", "toggle") ?>;
    --popup-consent-toggleColor: <?php generate("--popup-consent-toggleColor", "toggle") ?>;
    --popup-consent-toggleDisabled: <?php generate("--popup-consent-toggleDisabled", "toggle") ?>;
    --popup-consent-toggleBorderRadius: <?php generate("--popup-consent-toggleBorderRadius", "toggle") ?>;
    --popup-consent-toggleBorderRadiusAfter: <?php generate("--popup-consent-toggleBorderRadiusAfter", "toggle") ?>;

    --popup-consent-linkShowMoreColor: <?php generate("--popup-consent-linkShowMoreColor", "link") ?>;
    --popup-consent-linkShowMoreColorHover: <?php generate("--popup-consent-linkShowMoreColorHover", "link") ?>;

    --popup-consent-buttonDarkBackground: <?php generateButton("--popup-consent-buttonDarkBackground", "dark_button") ?>;
    --popup-consent-buttonDarkColor: <?php generateButton("--popup-consent-buttonDarkColor", "dark_button") ?>;
    --popup-consent-buttonDarkBackgroundHover: <?php generateButton("--popup-consent-buttonDarkBackgroundHover", "dark_button") ?>;
    --popup-consent-buttonDarkColorHover: <?php generateButton("--popup-consent-buttonDarkColorHover", "dark_button") ?>;
    --popup-consent-buttonDarkBackgroundActive: <?php generateButton("--popup-consent-buttonDarkBackgroundActive", "dark_button") ?>;
    --popup-consent-buttonDarkColorActive: <?php generateButton("--popup-consent-buttonDarkColorActive", "dark_button") ?>;
    
    --popup-consent-buttonRefuseBackground: <?php generateButton("--popup-consent-buttonRefuseBackground", "refuse_button") ?>;
    --popup-consent-buttonRefuseColor: <?php generateButton("--popup-consent-buttonRefuseColor", "refuse_button") ?>;
    --popup-consent-buttonRefuseBackgroundHover: <?php generateButton("--popup-consent-buttonRefuseBackgroundHover", "refuse_button") ?>;
    --popup-consent-buttonRefuseColorHover: <?php generateButton("--popup-consent-buttonRefuseColorHover", "refuse_button") ?>;
    --popup-consent-buttonRefuseBackgroundActive: <?php generateButton("--popup-consent-buttonRefuseBackgroundActive", "refuse_button") ?>;
    --popup-consent-buttonRefuseColorActive: <?php generateButton("--popup-consent-buttonRefuseColorActive", "refuse_button") ?>;
    
    --popup-consent-buttonShowBackground: <?php generateButton("--popup-consent-buttonShowBackground", "show") ?>;
    --popup-consent-buttonShowColor: <?php generateButton("--popup-consent-buttonShowColor", "show") ?>;
    --popup-consent-buttonShowBackgroundHover: <?php generateButton("--popup-consent-buttonShowBackgroundHover", "show") ?>;
    --popup-consent-buttonShowColorHover: <?php generateButton("--popup-consent-buttonShowColorHover", "show") ?>;
    --popup-consent-buttonShowBackgroundActive: <?php generateButton("--popup-consent-buttonShowBackgroundActive", "show") ?>;
    --popup-consent-buttonShowColorActive: <?php generateButton("--popup-consent-buttonShowColorActive", "show") ?>;

    --popup-consent-buttonBackground: <?php generateButton("--popup-consent-buttonBackground", "button_style") ?>;
    --popup-consent-buttonColor: <?php generateButton("--popup-consent-buttonColor", "button_style") ?>;
    --popup-consent-buttonFontFamily: <?php generateButton("--popup-consent-buttonFontFamily", "button_style") ?>;
    --popup-consent-buttonFontWeight:<?php generateButton("--popup-consent-buttonFontWeight", "button_style") ?>;
    --popup-consent-buttonLineHeight:<?php generateButton("--popup-consent-buttonLineHeight", "button_style") ?>;
    --popup-consent-buttonFontSize: <?php generateButton("--popup-consent-buttonFontSize", "button_style") ?>;
    --popup-consent-buttonLetterSpacing: <?php generateButton("--popup-consent-buttonLetterSpacing", "button_style") ?>;
    --popup-consent-buttonTextTransform: <?php generateButton("--popup-consent-buttonTextTransform", "button_style") ?>;
    --popup-consent-buttonBorderRadius: <?php generateButton("--popup-consent-buttonBorderRadius", "button_style") ?>;
    --popup-consent-buttonPadding: <?php generateButton("--popup-consent-buttonPadding", "button_style") ?>;

    --popup-consent-buttonSimpleFontFamily: <?php generateButton("--popup-consent-buttonSimpleFontFamily", "simple") ?>;
    --popup-consent-buttonSimpleFontWeight: <?php generateButton("--popup-consent-buttonSimpleFontWeight", "simple") ?>;
    --popup-consent-buttonSimpleLineHeight: <?php generateButton("--popup-consent-buttonSimpleLineHeight", "simple") ?>;
    --popup-consent-buttonSimpleFontSize: <?php generateButton("--popup-consent-buttonSimpleFontSize", "simple") ?>;
    --popup-consent-buttonSimpleTextTransform: <?php generateButton("--popup-consent-buttonSimpleTextTransform", "simple") ?>;
    --popup-consent-buttonSimpleLetterSpacing: <?php generateButton("--popup-consent-buttonSimpleLetterSpacing", "simple") ?>;
    --popup-consent-buttonSimpleColor: <?php generateButton("--popup-consent-buttonSimpleColor", "simple") ?>;
    --popup-consent-buttonSimpleBackground: <?php generateButton("--popup-consent-buttonSimpleBackground", "simple") ?>;
    --popup-consent-buttonSimpleBackgroundHover: <?php generateButton("--popup-consent-buttonSimpleBackgroundHover", "simple") ?>;
    --popup-consent-buttonSimpleColorHover: <?php generateButton("--popup-consent-buttonSimpleColorHover", "simple") ?>;
    --popup-consent-buttonSimpleBackgroundActive: <?php generateButton("--popup-consent-buttonSimpleBackgroundActive", "simple") ?>;
    --popup-consent-buttonSimpleColorActive: <?php generateButton("--popup-consent-buttonSimpleColorActive", "simple") ?>;
    --popup-consent-buttonSimplePadding: <?php generateButton("--popup-consent-buttonSimplePadding", "simple") ?>;
    --popup-consent-buttonSmallLineHeight: <?php generateButton("--popup-consent-buttonSmallLineHeight", "small") ?>;
    --popup-consent-buttonSmallFontSize: <?php generateButton("--popup-consent-buttonSmallFontSize", "small") ?>;
    --popup-consent-buttonSmallPadding: <?php generateButton("--popup-consent-buttonSmallPadding", "small") ?>;

    --popup-consent-buttonLightColor: <?php generateButton("--popup-consent-buttonLightColor", "light_button") ?>;
    --popup-consent-buttonLightBackground: <?php generateButton("--popup-consent-buttonLightBackground", "light_button") ?>;
    --popup-consent-buttonLightBackgroundHover: <?php generateButton("--popup-consent-buttonLightBackgroundHover", "light_button") ?>;
    --popup-consent-buttonLightColorHover: <?php generateButton("--popup-consent-buttonLightColorHover", "light_button") ?>;
    --popup-consent-buttonLightBackgroundActive: <?php generateButton("--popup-consent-buttonLightBackgroundActive", "light_button") ?>;
    --popup-consent-buttonLightColorActive: <?php generateButton("--popup-consent-buttonLightColorActive", "light_button") ?>;

    --popup-consent-titleColor: <?php generate("--popup-consent-titleColor", "title") ?>;
    --popup-consent-titleFontFamily: <?php generate("--popup-consent-titleFontFamily", "title") ?>;
    --popup-consent-titleFontWeight: <?php generate("--popup-consent-titleFontWeight", "title") ?>;
    --popup-consent-titleLineHeight: <?php generate("--popup-consent-titleLineHeight", "title") ?>;
    --popup-consent-titleTextTransform: <?php generate("--popup-consent-titleTextTransform", "title") ?>;
    --popup-consent-titleLetterSpacing: <?php generate("--popup-consent-titleLetterSpacing", "title") ?>;
    --popup-consent-titleMargin: <?php generate("--popup-consent-titleMargin", "title") ?>;
    --popup-consent-titleFontSize: <?php generate("--popup-consent-titleFontSize", "title") ?>;

    --popup-consent-descrFontFamily: <?php generate("--popup-consent-descrFontFamily", "description") ?>;
    --popup-consent-descrFontWeight: <?php generate("--popup-consent-descrFontWeight", "description") ?>;
    --popup-consent-descrLineHeight: <?php generate("--popup-consent-descrLineHeight", "description") ?>;
    --popup-consent-descrFontSize: <?php generate("--popup-consent-descrFontSize", "description") ?>;
    --popup-consent-descrColor: <?php generate("--popup-consent-descrColor", "description") ?>;
    --popup-consent-width: <?php generate("--popup-consent-width", "description") ?>;
}