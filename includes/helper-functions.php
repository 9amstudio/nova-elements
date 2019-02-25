<?php

if (!function_exists('nova_log')) {
    function nova_log($log) {
        if (true === WP_DEBUG) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

if(!function_exists('nova_elements_template_path')){
    function nova_elements_template_path(){
        return apply_filters( 'nova-elements/template-path', 'nova-elements/' );
    }
}

if(!function_exists('nova_elements_get_template')){
    function nova_elements_get_template( $name = null ){
        $template = locate_template( nova_elements_template_path() . $name );

        if ( ! $template ) {
            $template = NOVA_ELEMENTS_PATH  . 'templates/' . $name;
        }
        if ( file_exists( $template ) ) {
            return $template;
        } else {
            return false;
        }
    }
}
