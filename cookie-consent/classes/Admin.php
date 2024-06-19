<?php

namespace Cookie_Consent;

class Admin {

    public function __construct() 
    {
        $this->init();
    }

    /**
     * Register hooks
     */
    protected function init() 
    {
        // Add action to wp_head hook to output CSS
        add_action('wp_head', [$this, 'output_css']);
    }

    /**
     * Output CSS styles
     */
    public function output_css()
    {
        ?>
        <style>
            .banner-consent {
                background-color: <?php echo get_field('background_color', 'option'); ?>;
                color: <?php echo get_field('text_color', 'option'); ?>;
                font-size: <?php echo get_field('font_size', 'option'); ?>px;
            }
        </style>
        <?php
    }
}