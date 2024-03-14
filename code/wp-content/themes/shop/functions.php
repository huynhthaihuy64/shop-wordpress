<?php
function my_custom_wc_theme_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', 'my_custom_wc_theme_support');
function initTheme() {
    //Chuyển trình soạn thảo về phiên bản cũ
    add_filter('use_block_editor_for_post', '__return_false');
    //Đăng ký menu
    register_nav_menu('header-top', __('Menu Top'));
    register_nav_menu('header-menu', __('Menu Chính'));
    register_nav_menu('header-footer', __('Menu Bot'));

    //Đăng ký sidebar
    if (function_exists('register_sidebar')) {
        register_sidebar([
            'name' => 'Cột bên',
            'id' => 'sidebar'
        ]);
    }

    function setPostView($postID) {
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if($count == '') {
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }

    function getPostView($postID)
    {
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return '0';
        }
        return $count;
    }
}

add_action('init', 'initTheme');