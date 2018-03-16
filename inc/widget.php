<?php

/**
 * Register widgets
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_action( 'widgets_init', 'dobby_widgets_init' );
function dobby_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Single Widgets', 'dobby' ),
        'id' => 'sidebar_single',
        'before_widget' => '<section id="%1$s" class="%2$s mb-3 clearfix">',
        'after_widget' => '</section>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>'
    ) );
    register_sidebar( array(
        'name' => __( 'Page Widgets', 'dobby' ),
        'id' => 'sidebar_page',
        'before_widget' => '<section id="%1$s" class="%2$s mb-3 clearfix">',
        'after_widget' => '</section>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>'
    ) );
    register_sidebar( array(
        'name' => __( 'Index Widgets', 'dobby' ),
        'id' => 'sidebar_index',
        'before_widget' => '<section id="%1$s" class="%2$s mb-3 clearfix">',
        'after_widget' => '</section>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>'
    ) );    
}

/**
 * Remove default widget
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_action( 'widgets_init', 'remove_default_widget' );
function remove_default_widget() {
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Widget_Text');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Nav_Menu_Widget');
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Media_Video');
  unregister_widget('WP_Widget_Media_Audio');
  unregister_widget('WP_Widget_Media_Image');
  unregister_widget('WP_Widget_Media_Gallery');
  #unregister_widget('WP_Widget_Custom_HTML');
}

class dobby_widget_ad extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_dobby_ad',
            'name'        => __( 'Advertising', 'dobby' ),
            'description' => __( 'Display picture ads at your site', 'dobby' )
        );
        parent::__construct( false, false, $widget_ops );
    }
    function widget( $args, $instance ) {
        extract( $args );
        $aurl = $instance['aurl'] ? $instance['aurl'] : '';
        $title = $instance['title'] ? $instance['title'] : '';
        $imgurl = $instance['imgurl'] ? $instance['imgurl'] : '';
        echo $before_widget;
        ?>
            <?php if(!empty($title)) {?>
            <h3><span><?php echo $title; ?></span></h3>
            <?php }?>
            <?php if(!empty($imgurl)) {?>
            <div class="p-1">
                <a href="<?php echo $aurl; ?>" target="_blank">
                    <img class="carousel-inner img-responsive img-rounded" src="<?php echo $imgurl; ?>" alt="Advertising" />
                </a>
            </div>
            <?php }?>
        <?php
        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
    function form( $instance ) {
        @$title = esc_attr( $instance['title'] );
        @$aurl = esc_attr( $instance['aurl'] );
        @$imgurl = esc_attr( $instance['imgurl'] );
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    栏目标题：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'aurl' ); ?>">
                    图片链接：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'aurl' ); ?>" name="<?php echo $this->get_field_name( 'aurl' ); ?>" type="text" value="<?php echo $aurl; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'imgurl' ); ?>">
                    栏目图片：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'imgurl' ); ?>" name="<?php echo $this->get_field_name( 'imgurl' ); ?>" type="text" value="<?php echo $imgurl; ?>" />
                </label>
            </p>
        <?php
    }
}

class dobby_widget_tags extends WP_Widget {

    function __construct(){
        $widget_ops = array(
            'classname' => 'widget_dobby_tags',
            'name'        => __( 'Tag Cloud', 'dobby' ),
            'description' => __( 'The tags of your site article is displayed', 'dobby' )
        );
        parent::__construct(false, false, $widget_ops);
    }

    function widget($args, $instance){
        extract($args);
        $result = '';
        $title = $instance['title'] ? esc_attr($instance['title']) : '';
        $title = apply_filters('widget_title',$title);
        $number = (!empty($instance['number'])) ? intval($instance['number']) : 50;
        $orderby = (!empty($instance['orderby'])) ? esc_attr($instance['orderby']) : 'count';
        $order = (!empty($instance['order'])) ? esc_attr($instance['order']) : 'DESC';
        $tags = wp_tag_cloud( array(
                    'unit' => 'px',
                    'smallest' => 14,
                    'largest' => 14,
                    'number' => $number,
                    'format' => 'flat',
                    'orderby' => $orderby,
                    'order' => $order,
                    'echo' => FALSE
                )
            );
        $result .= $before_widget;
        if($title) $result .= '<h3><span>'.$title .'</span></h3>';
        $result .= '<div class="clouds">';
        $result .= $tags;
        $result .= '</div>';
        $result .= $after_widget;
        echo $result;
    }

    function update($new_instance, $old_instance){
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = esc_attr($new_instance['title']);
        $instance['number'] = intval($new_instance['number']);
        $instance['orderby'] = esc_attr($new_instance['orderby']);
        $instance['order'] = esc_attr($new_instance['order']);
        return $instance;
    }

    function form($instance){
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=>'标签聚合','number'=>'20','orderby'=>'count','order'=>'RAND'));
        $title =  esc_attr($instance['title']);
        $number = intval($instance['number']);
        $orderby =  esc_attr($instance['orderby']);
        $order =  esc_attr($instance['order']);
        ?>
        <p>
            <label for='<?php echo $this->get_field_id("title");?>'>栏目标题：<input type='text' class='widefat' name='<?php echo $this->get_field_name("title");?>' id='<?php echo $this->get_field_id("title");?>' value="<?php echo $title;?>"/></label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("number");?>'>显示数量：<input type='text' name='<?php echo $this->get_field_name("number");?>' id='<?php echo $this->get_field_id("number");?>' value="<?php echo $number;?>"/></label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("orderby");?>'>参照类型：
                <select name="<?php echo $this->get_field_name("orderby");?>" id='<?php echo $this->get_field_id("orderby");?>'>
                    <option value="count" <?php echo ($orderby == 'count') ? 'selected' : ''; ?>>数量</option>
                    <option value="name" <?php echo ($orderby == 'name') ? 'selected' : ''; ?>>名字</option>
                </select>
            </label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("order");?>'>排序类型：
                <select name="<?php echo $this->get_field_name("order");?>" id='<?php echo $this->get_field_id("order");?>'>
                    <option value="DESC" <?php echo ($order == 'DESC') ? 'selected' : ''; ?>>降序</option>
                    <option value="ASC" <?php echo ($order == 'ASC') ? 'selected' : ''; ?>>升序</option>
                    <option value="RAND" <?php echo ($order == 'RAND') ? 'selected' : ''; ?>>随机</option>
                </select>
            </label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}

class dobby_widget_comments extends WP_Widget {

    function __construct(){
        $widget_ops = array(
            'classname' => 'dobby_widget_comments',
            'name'        => __( 'Recent Comments', 'dobby' ),
            'description' => __( 'Your site recently commented on the presentation', 'dobby' )
        );
        parent::__construct(false, false, $widget_ops);
    }

    function widget($args, $instance){
        extract($args);
        $result = '';
        $title = $instance['title'] ? esc_attr($instance['title']) : '';
        $title = apply_filters('widget_title',$title);
        $number = (!empty($instance['number'])) ? intval($instance['number']) : 5;
        $result .= $before_widget;
        if($title) $result .= $before_title . $title . $after_title;
        $result .= '<div class="comments">';
        $result .= dobby_latest_comments($number, 50);
        $result .= '</div>';
        $result .= $after_widget;
        echo $result;
    }

    function update($new_instance, $old_instance){
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = esc_attr($new_instance['title']);
        $instance['number'] = intval($new_instance['number']);
        return $instance;
    }

    function form($instance){
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=>__( 'Recent Comments', 'dobby' ),'number'=>'5'));
        $title =  esc_attr($instance['title']);
        $number = intval($instance['number']);
        ?>
        <p>
            <label for='<?php echo $this->get_field_id("title");?>'>栏目标题：<input type='text' class='widefat' name='<?php echo $this->get_field_name("title");?>' id='<?php echo $this->get_field_id("title");?>' value="<?php echo $title;?>"/></label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("number");?>'>显示数量：<input type='text' name='<?php echo $this->get_field_name("number");?>' id='<?php echo $this->get_field_id("number");?>' value="<?php echo $number;?>"/></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}

class dobby_widget_special extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_dobby_special',
            'name'        => __( 'Thematic content', 'dobby' ),
            'description' => __( 'Display thematic content at your site', 'dobby' )
        );
        parent::__construct( false, false, $widget_ops );
    }
    function widget( $args, $instance ) {
        extract( $args );
        $title = $instance['title'] ? $instance['title'] : '';
        $imgurl = $instance['imgurl'] ? $instance['imgurl'] : '';
        $aurl = $instance['aurl'] ? $instance['aurl'] : '';
        $meta = $instance['meta'] ? $instance['meta'] : '';
        echo $before_widget;
        ?>   
            <?php if(!empty($title)) {?>
            <h3><span><?php echo $title; ?></span></h3>
            <?php }?>
            
            <div class="p-1">
            <?php if(!empty($meta)) {?>
            <div class="special-box">
                <a href="<?php echo $aurl; ?>">
                    <div class="mask"></div>
                    <div class="image" style="background-image: url(<?php echo $imgurl; ?>);"></div>
                    <div class="title">
                        <p><?php echo $meta; ?></p>
                        <span>查看专题</span>
                    </div>
                </a>
            </div>
            <?php }?>
            </div>
        <?php
        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
    function form( $instance ) {
        @$title = esc_attr( $instance['title'] );
        @$aurl = esc_attr( $instance['aurl'] );
        @$meta = esc_attr( $instance['meta'] );
        @$imgurl = esc_attr( $instance['imgurl'] );
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    工具标题：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'meta' ); ?>">
                    专题内容：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'meta' ); ?>" name="<?php echo $this->get_field_name( 'meta' ); ?>" type="text" value="<?php echo $meta; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'aurl' ); ?>">
                    专题链接：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'aurl' ); ?>" name="<?php echo $this->get_field_name( 'aurl' ); ?>" type="text" value="<?php echo $aurl; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'imgurl' ); ?>">
                    图片链接：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'imgurl' ); ?>" name="<?php echo $this->get_field_name( 'imgurl' ); ?>" type="text" value="<?php echo $imgurl; ?>" />
                </label>
            </p>
        <?php
    }
}

add_action('widgets_init','dobby_register_widgets');
function dobby_register_widgets(){
    register_widget('dobby_widget_ad');
    register_widget('dobby_widget_tags');
    register_widget('dobby_widget_comments');
    register_widget('dobby_widget_special');
}
?>