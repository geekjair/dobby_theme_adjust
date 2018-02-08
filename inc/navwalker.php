<?php

/**
* Add the menu module
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 1.0
*/
add_action('after_setup_theme', 'dobby_register_nav_menu');

function dobby_register_nav_menu() {
  register_nav_menus(array('header_menu' => __( 'Header Menu', 'dobby' )));
  register_nav_menus(array('footer_menu' => __( 'Footer Menu', 'dobby' )));
}

/**
* Remove the navigation menu redundant style
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 1.0
*/
add_filter('nav_menu_css_class', 'dobby_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'dobby_attributes_filter', 100, 1);
add_filter('page_css_class', 'dobby_attributes_filter', 100, 1);
function dobby_attributes_filter($var) {
  return is_array($var) ? array_intersect($var, array()) : '';
}

/**
* Adaptive Bootstrap navigation
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 1.0
*/
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        $classes = array('dropdown-menu');
        $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $labelledby = '';
        preg_match_all('/(<a.*?id=\\"|\')(.*?)\\"|\'.*?>/im', $output, $matches);
        if (end($matches[2])) {
            $lablledby = 'aria-labelledby="' . end($matches[2]) . '"';
        }
        $output .= "{$n}{$indent}<ul{$class_names} role=\"menu\">{$n}";
    }
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = $depth ? str_repeat($t, $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $linkmod_classes = array();
        $icon_classes = array();
        $classes = self::seporate_linkmods_and_icons_from_classes($classes, $linkmod_classes, $icon_classes, $depth);
        $icon_class_string = join(' ', $icon_classes);
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
        if ($args->has_children) {
            $classes[] = 'dropdown';
        }
        if (in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true)) {
            $classes[] = 'active';
        }
        // $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'nav-item';
        $classes = apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth);
        $class_names = join(' ', $classes);
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        if ($args->has_children) {
            $output .= $indent . '<li' . $id . ' class="nav-item dropdown" ' . '>';
        } else {
        	$output .= $indent . '<li' . $id . ' class="nav-item" ' . '>';
        }
        
        $atts = array();
        if (empty($item->attr_title)) {
            $atts['title'] = !empty($item->title) ? strip_tags($item->title) : '';
        } else {
            $atts['title'] = $item->attr_title;
        }
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        if ($args->has_children && 0 === $depth && $args->depth > 1) {
            $atts['href'] = '#';
            $atts['data-toggle'] = 'dropdown';
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
            $atts['class'] = 'dropdown-toggle nav-link';
            // $atts['id'] = 'menu-item-dropdown-' . $item->ID;
        } else {
            $atts['href'] = !empty($item->url) ? $item->url : '';
            if ($depth > 0) {
                $atts['class'] = 'dropdown-item';
            } else {
                $atts['class'] = 'nav-link';
            }
        }
        $atts = self::update_atts_for_linkmod_type($atts, $linkmod_classes);
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = 'href' === $attr ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $linkmod_type = self::get_linkmod_type($linkmod_classes);
        $item_output = $args->before;
        if ('' !== $linkmod_type) {
            $item_output .= self::linkmod_element_open($linkmod_type, $attributes);
        } else {
            $item_output .= '<a' . $attributes . '>';
        }
        $icon_html = '';
        if (!empty($icon_class_string)) {
            $icon_html = '<i class="' . esc_attr($icon_class_string) . '" aria-hidden="true"></i> ';
        }
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        if (in_array('sr-only', $linkmod_classes, true)) {
            $title = self::wrap_for_screen_reader($title);
            $keys_to_unset = array_keys($linkmod_classes, 'sr-only');
            foreach ($keys_to_unset as $k) {
                unset($linkmod_classes[$k]);
            }
        }
        $item_output .= $args->link_before . $icon_html . $title . $args->link_after;
        if ('' !== $linkmod_type) {
            $item_output .= self::linkmod_element_close($linkmod_type, $attributes);
        } else {
            $item_output .= '</a>';
        }
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if (!$element) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->{$id_field}]);
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    public static function fallback($args)
    {
        if (current_user_can('edit_theme_options')) {
            $container = $args['container'];
            $container_id = $args['container_id'];
            $container_class = $args['container_class'];
            $menu_class = $args['menu_class'];
            $menu_id = $args['menu_id'];
            $fallback_output = '';
            if ($container) {
                $fallback_output .= '<' . esc_attr($container);
                if ($container_id) {
                    $fallback_output .= ' id="' . esc_attr($container_id) . '"';
                }
                if ($container_class) {
                    $fallback_output .= ' class="' . esc_attr($container_class) . '"';
                }
                $fallback_output .= '>';
            }
            $fallback_output .= '<ul';
            if ($menu_id) {
                $fallback_output .= ' id="' . esc_attr($menu_id) . '"';
            }
            if ($menu_class) {
                $fallback_output .= ' class="' . esc_attr($menu_class) . '"';
            }
            $fallback_output .= '>';
            $fallback_output .= '<li class="nav-item"><a class="nav-link" href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Add a menu', 'dobby') . '</a></li>';
            $fallback_output .= '</ul>';
            if ($container) {
                $fallback_output .= '</' . esc_attr($container) . '>';
            }
            if (array_key_exists('echo', $args) && $args['echo']) {
                echo $fallback_output;
            } else {
                return $fallback_output;
            }
        }
    }
    private function seporate_linkmods_and_icons_from_classes($classes, &$linkmod_classes, &$icon_classes, $depth)
    {
        foreach ($classes as $key => $class) {
            if (preg_match('/disabled|sr-only/', $class)) {
                $linkmod_classes[] = $class;
                unset($classes[$key]);
            } elseif (preg_match('/dropdown-header|dropdown-divider/', $class) && $depth > 0) {
                $linkmod_classes[] = $class;
                unset($classes[$key]);
            } elseif (preg_match('/fa-(\\S*)?|fas(\\s?)|far(\\s?)|fal(\\s?)|fab(\\s?)|fa(\\s?)/', $class)) {
                $icon_classes[] = $class;
                unset($classes[$key]);
            } elseif (preg_match('/glyphicons-(\\S*)?|glyphicons(\\s?)/', $class)) {
                $icon_classes[] = $class;
                unset($classes[$key]);
            }
        }
        return $classes;
    }
    private function get_linkmod_type($linkmod_classes = array())
    {
        $linkmod_type = '';
        if (!empty($linkmod_classes)) {
            foreach ($linkmod_classes as $link_class) {
                if (!empty($link_class)) {
                    if ('dropdown-header' === $link_class) {
                        $linkmod_type = 'dropdown-header';
                    } elseif ('dropdown-divider' === $link_class) {
                        $linkmod_type = 'dropdown-divider';
                    }
                }
            }
        }
        return $linkmod_type;
    }
    private function update_atts_for_linkmod_type($atts = array(), $linkmod_classes = array())
    {
        if (!empty($linkmod_classes)) {
            foreach ($linkmod_classes as $link_class) {
                if (!empty($link_class)) {
                    if ('sr-only' !== $link_class) {
                        $atts['class'] .= ' ' . esc_attr($link_class);
                    }
                    if ('disabled' === $link_class) {
                        $atts['href'] = '#';
                        unset($atts['target']);
                    } elseif ('dropdown-header' === $link_class || 'dropdown-divider' === $link_class) {
                        unset($atts['href']);
                        unset($atts['target']);
                    }
                }
            }
        }
        return $atts;
    }
    private function wrap_for_screen_reader($text = '')
    {
        if ($text) {
            $text = '<span class="sr-only">' . $text . '</span>';
        }
        return $text;
    }
    private function linkmod_element_open($linkmod_type, $attributes = '')
    {
        $output = '';
        if ('dropdown-header' === $linkmod_type) {
            $output .= '<span class="dropdown-header h6"' . $attributes . '>';
        } elseif ('dropdown-divider' === $linkmod_type) {
            $output .= '<div class="dropdown-divider"' . $attributes . '>';
        }
        return $output;
    }
    private function linkmod_element_close($linkmod_type)
    {
        $output = '';
        if ('dropdown-header' === $linkmod_type) {
            $output .= '</span>';
        } elseif ('dropdown-divider' === $linkmod_type) {
            $output .= '</div>';
        }
        return $output;
    }
}