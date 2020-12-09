<?php
/*code for widget*/
function wpb_widgets_init() {
    register_sidebar(array('name' => __('Sidebar Left', 'learningapp'), 'id' => 'sidebar-left', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="card-title mb-0">', 'after_title' => '</h4>',));
    register_sidebar(array('name' => __('Sidebar Right', 'learningapp'), 'id' => 'sidebar-right', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="card-title mb-0">', 'after_title' => '</h4>',));
    register_sidebar(array('name' => __('Footer Widget-1', 'learningapp'), 'id' => 'footer-widget-1', 'before_widget' => '<aside id="%1$s" class="widget %2$s footer-widget-1">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="card-title mb-0">', 'after_title' => '</h4>',));
    register_sidebar(array('name' => __('Footer Widget-2', 'learningapp'), 'id' => 'footer-widget-2', 'before_widget' => '<aside id="%1$s" class="widget %2$s footer-widget-2">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="card-title mb-0">', 'after_title' => '</h4>',));
    register_sidebar(array('name' => __('Footer Widget-3', 'learningapp'), 'id' => 'footer-widget-3', 'before_widget' => '<aside id="%1$s" class="widget %2$s footer-widget-3">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="card-title mb-0">', 'after_title' => '</h4>',));
    register_sidebar(array('name' => __('Footer Widget-4', 'learningapp'), 'id' => 'footer-widget-4', 'before_widget' => '<aside id="%1$s" class="widget %2$s footer-widget-4">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="card-title mb-0">', 'after_title' => '</h4>',));
    register_sidebar(array('name' => __('copyright', 'learningapp'), 'id' => 'copyright', 'before_widget' => '<aside id="%1$s" class="widget %2$s copyright">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="card-title mb-0">', 'after_title' => '</h4>',));
}
add_action('widgets_init', 'wpb_widgets_init');
add_action('widgets_init', array('Course_Widget', 'register'));
add_action('widgets_init', array('Category_Widget', 'register'));
add_action('widgets_init', array('Exams_Categories', 'register'));
add_action('widgets_init', array('Recent_Posts', 'register'));
add_action('widgets_init', array('Search_Widget', 'register'));
add_action('widgets_init', array('Author_Biography_Widget', 'register'));
add_action('widgets_init', array('Learning_Feature_Widget', 'register'));
add_action('widgets_init', array('Testimonials_Widget', 'register'));
add_action('widgets_init', array('Footer_copyright', 'register'));
add_action('widgets_init', array('Footer_News_Letter', 'register'));
add_action('widgets_init', array('Footer_SocialLinks', 'register'));
add_action('widgets_init', array('Footer_Menu', 'register'));

class Search_Widget extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Search Learning App', array('description' => 'Widget for Searching posts and pages'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        //echo $args['before_widget'];
        $title = ($instance['title'] != "") ? $args['before_title'] . $instance['title'] . $args['after_title'] : "";
        print ('<div class="card card-default paper-shadow shadow-sm mb-3">
                <div class="card-body">
                    <form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '">
        				<div class="input-group input-group-sm">
                            <input type="text" value="" name="s" id="forumSearch" class="form-control" placeholder="Search ...">
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">
                                <i class="fab fa-search"></i>
                              </button>
                            </div>
                        </div>
        			</form>
    			</div>
			</div>');
       // echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}

class Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
        $widget_ops = array(
            'classname'                   => 'recent_posts',
            'description'                 => __( 'Your site&#8217;s most recent Posts.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'recent_posts', __( 'Recent Posts Learning App' ), $widget_ops );
        $this->alt_option_name = 'recent_posts';
    }

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$r = new WP_Query(
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>
		<?php echo $args['before_widget']; ?>
		<div class="card card-default paper-shadow shadow-sm mb-3">
		<div class="card-header py-3">
		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		</div>
		<ul class="list-group list-group-menu">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title = get_the_title( $recent_post->ID );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				?>
				<li class="list-group-item">
					<a href="<?php the_permalink( $recent_post->ID ); ?>"><i class="fab fa-chevron-right"></i> <?php echo $title; ?></a>
					<?php if ( $show_date ) : ?>
						<span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
		<?php
	}
	public static function register() {
        register_widget(__CLASS__);
    }
}

class Category_Widget extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Categories Learning App', array('description' => 'Widget for displaying categories posts and pages'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
       // echo $args['before_widget'];
        $title = ($instance['title'] != "") ? $args['before_title'] . $instance['title'] . $args['after_title'] : "";
        $output = "";
        $categories = get_categories(array('orderby' => 'name', 'parent' => 0));
        print ($title . '<ul class="list-group list-group-menu">');
        foreach ($categories as $category) {
            $output.= "";
            printf('<li class="list-group-item"><a href="%1$s"><i class="fab fa-chevron-right fa-fw"></i> %2$s</a></li>', esc_url(get_category_link($category->term_id)), esc_html($category->name));
        }
        print ('</ul>');
       // echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}


class Exams_Categories extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Exams Categories Learning App', array('description' => 'Widget for displaying exams categories for plan posts'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        //echo $args['before_widget'];
        $title = ($instance['title'] != "") ? $args['before_title'] . $instance['title'] . $args['after_title'] : "";
		$title = trim ($title);
        $output = "";
        $categories = get_terms(['taxonomy' => "exams", 'hide_empty' => false, ]);
        print ('<div class="card card-default paper-shadow shadow-sm mb-3">');
        printf('<div class="card-header py-3">%s</div>', $title);
        //print ('<div class="card-body ">');
        print ('<ul class="list-group list-group-menu">');
        foreach ($categories as $i => $category) {
            $border = "border-right-0 border-left-0 border-bottom-0";
            if ($i == 0) {
                $border.= " border-top-0";
            }
			$border = '';
            printf('<li class="list-group-item %s"><a href="%s" class="p"><i class="fab fa-chevron-right"></i> %s</a></li>', $border, esc_url(get_category_link($category->term_id)), esc_html($category->name));
        }
        print ('</ul>');
        //print ('</div>');
        print ('</div>');
        //echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}

class Author_Biography_Widget extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Author Biography', array('description' => 'Widget for author biography course pages'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $AuthorName = isset($instance['AuthorName']) ? $instance['AuthorName'] : '';
        $AuthorImage = isset($instance['AuthorImage']) ? $instance['AuthorImage'] : false;
        $Description = isset($instance['Description']) ? $instance['Description'] : '';
        $settings = array('media_buttons' => false, 'textarea_rows' => 3, 'textarea_name' => $this->get_field_name('Description'), 'teeny' => true,);
?>
        <p>
            <label for="<?php echo $this->get_field_id('AuthorName'); ?>"><?php _e('Author Name:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('AuthorName'); ?>" name="<?php echo $this->get_field_name('AuthorName'); ?>" value="<?php echo $AuthorName; ?>" />
        </p>
        <label for="<?php echo $this->get_field_id('AuthorImage'); ?>"><?php _e('Author Image:') ?></label>
        <input type="hidden" id="<?php echo $this->get_field_id('AuthorImage'); ?>" class="author-image" name="<?php echo $this->get_field_name('AuthorImage'); ?>" value="<?php echo $AuthorImage; ?>" />
        <div class="media-widget-control">
            <div class="media-widget-preview media_image">
    			<div class="attachment-media-view">
    			    <?php if ($AuthorImage == false): ?>
                    <div class="placeholder">No image selected</div>
                    <?php
					else: ?>
                    <div class="preview-box">
                    <?php echo wp_get_attachment_image($AuthorImage, 'full', false, array('id' => 'preview-image')); ?>
                    </div>
                    <?php
        endif; ?>
                </div>
    		</div>
    		<p class="media-widget-buttons">
                <button type="button" id="button-delete" class="button button-delete <?php echo ($AuthorImage != false) ? 'not-selected' : 'selected'; ?>">Remove</button>
    			<button type="button" class="button select-media not-selected">Add/Replace</button>
            </p>
    		<div class="media-widget-fields">
    		</div>
        </div>
        <label for="<?php echo $this->get_field_id('Description'); ?>"><?php _e('Description:') ?></label>
        <?php
        wp_editor($Description, $this->get_field_id('Description'), $settings);
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
       // echo $args['before_widget'];
        print ('<div class="panel-body">
              <div class="media v-middle">
                <div class="media-left">
                  ' . wp_get_attachment_image($instance['AuthorImage'], array(60, 60), false, array('class' => 'img-circle')) . '
                </div>
                <div class="media-body">
                  <h4 class="text-title margin-none"><a href="#">' . $instance['AuthorName'] . '</a></h4>
                  <span class="caption text-light">Biography</span>
                </div>
              </div>
              <br/>
              <div class="expandable expandable-indicator-white expandable-trigger">
                <div class="expandable-content">
                  ' . $instance['Description'] . '
                </div>
              </div>
            </div>');
        //echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['AuthorName'] = strip_tags(stripslashes($new_instance['AuthorName']));
        $instance['AuthorImage'] = strip_tags(stripslashes($new_instance['AuthorImage']));
        $instance['Description'] = $new_instance['Description'];
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}

class Course_Widget extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Course Widget', array('description' => 'Widget for course pages'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo '<div class="panel-heading">';
            echo $args['before_title'] . $instance['title'] . $args['after_title'];
            echo '</div>';
        }
        print ('<div class="panel-body">
              <p class="text-caption">
                <i class="fab fa-clock-o fa-fw"></i> 4 hrs &nbsp;
                <i class="fab fa-calendar fa-fw"></i> 21/10/14
                <br/>
                <i class="fab fa-user fa-fw"></i> Instructor: Adrian Demian
                <br/>
                <i class="fab fa-mortar-board fa-fw"></i> Max. students: 50
                <br/>
                <i class="fab fa-check fa-fw"></i> Attending: 30
              </p>
            </div>
            <hr class="margin-none" />
            <div class="panel-body text-center">
              <p><a class="btn btn-success btn-lg paper-shadow relative" data-z="1" data-hover-z="2" data-animated href="website-take-course.html">Start Course</a></p>
              <p class="text-body-2">or <a href="#">buy course for $1</a></p>
            </div>
            <ul class="list-group">
              <li class="list-group-item">
                <a href="#" class="text-light"><i class="fab fa-facebook fa-fw"></i> Share on facebook</a>
              </li>
              <li class="list-group-item">
                <a href="#" class="text-light"><i class="fab fa-twitter fa-fw"></i> Tweet this course</a>
              </li>
            </ul>');
        echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}

class Learning_Feature_Widget extends WP_Widget {
    private $font_awesome_icons = array("glass" => "&#xf000;", "music" => "&#xf001;", "search" => "&#xf002;", "envelope-o" => "&#xf003;", "heart" => "&#xf004;", "star" => "&#xf005;", "star-o" => "&#xf006;", "user" => "&#xf007;", "film" => "&#xf008;", "th-large" => "&#xf009;", "th" => "&#xf00a;", "th-list" => "&#xf00b;", "check" => "&#xf00c;", "remove" => "&#xf00d;", "search-plus" => "&#xf00e;", "search-minus" => "&#xf010;", "power-off" => "&#xf011;", "signal" => "&#xf012;", "gear" => "&#xf013;", "trash-o" => "&#xf014;", "home" => "&#xf015;", "file-o" => "&#xf016;", "clock-o" => "&#xf017;", "road" => "&#xf018;", "download" => "&#xf019;", "arrow-circle-o-down" => "&#xf01a;", "arrow-circle-o-up" => "&#xf01b;", "inbox" => "&#xf01c;", "play-circle-o" => "&#xf01d;", "rotate-right" => "&#xf01e;", "refresh" => "&#xf021;", "list-alt" => "&#xf022;", "lock" => "&#xf023;", "flag" => "&#xf024;", "headphones" => "&#xf025;", "volume-off" => "&#xf026;", "volume-down" => "&#xf027;", "volume-up" => "&#xf028;", "qrcode" => "&#xf029;", "barcode" => "&#xf02a;", "tag" => "&#xf02b;", "tags" => "&#xf02c;", "book" => "&#xf02d;", "bookmark" => "&#xf02e;", "print" => "&#xf02f;", "camera" => "&#xf030;", "font" => "&#xf031;", "bold" => "&#xf032;", "italic" => "&#xf033;", "text-height" => "&#xf034;", "text-width" => "&#xf035;", "align-left" => "&#xf036;", "align-center" => "&#xf037;", "align-right" => "&#xf038;", "align-justify" => "&#xf039;", "list" => "&#xf03a;", "dedent" => "&#xf03b;", "indent" => "&#xf03c;", "video-camera" => "&#xf03d;", "picture-o" => "&#xf03e;", "pencil" => "&#xf040;", "map-marker" => "&#xf041;", "adjust" => "&#xf042;", "tint" => "&#xf043;", "pencil-square-o" => "&#xf044;", "share-square-o" => "&#xf045;", "check-square-o" => "&#xf046;", "arrows" => "&#xf047;", "step-backward" => "&#xf048;", "fast-backward" => "&#xf049;", "backward" => "&#xf04a;", "play" => "&#xf04b;", "pause" => "&#xf04c;", "stop" => "&#xf04d;", "forward" => "&#xf04e;", "fast-forward" => "&#xf050;", "step-forward" => "&#xf051;", "eject" => "&#xf052;", "chevron-left" => "&#xf053;", "chevron-right" => "&#xf054;", "plus-circle" => "&#xf055;", "minus-circle" => "&#xf056;", "times-circle" => "&#xf057;", "check-circle" => "&#xf058;", "question-circle" => "&#xf059;", "info-circle" => "&#xf05a;", "crosshairs" => "&#xf05b;", "times-circle-o" => "&#xf05c;", "check-circle-o" => "&#xf05d;", "ban" => "&#xf05e;", "arrow-left" => "&#xf060;", "arrow-right" => "&#xf061;", "arrow-up" => "&#xf062;", "arrow-down" => "&#xf063;", "share" => "&#xf064;", "expand" => "&#xf065;", "compress" => "&#xf066;", "plus" => "&#xf067;", "minus" => "&#xf068;", "asterisk" => "&#xf069;", "exclamation-circle" => "&#xf06a;", "gift" => "&#xf06b;", "leaf" => "&#xf06c;", "fire" => "&#xf06d;", "eye" => "&#xf06e;", "eye-slash" => "&#xf070;", "warning" => "&#xf071;", "plane" => "&#xf072;", "calendar" => "&#xf073;", "random" => "&#xf074;", "comment" => "&#xf075;", "magnet" => "&#xf076;", "chevron-up" => "&#xf077;", "chevron-down" => "&#xf078;", "retweet" => "&#xf079;", "shopping-cart" => "&#xf07a;", "folder" => "&#xf07b;", "folder-open" => "&#xf07c;", "arrows-v" => "&#xf07d;", "arrows-h" => "&#xf07e;", "bar-chart-o" => "&#xf080;", "twitter-square" => "&#xf081;", "facebook-square" => "&#xf082;", "camera-retro" => "&#xf083;", "key" => "&#xf084;", "gears" => "&#xf085;", "comments" => "&#xf086;", "thumbs-o-up" => "&#xf087;", "thumbs-o-down" => "&#xf088;", "star-half" => "&#xf089;", "heart-o" => "&#xf08a;", "sign-out" => "&#xf08b;", "linkedin-square" => "&#xf08c;", "thumb-tack" => "&#xf08d;", "external-link" => "&#xf08e;", "sign-in" => "&#xf090;", "trophy" => "&#xf091;", "github-square" => "&#xf092;", "upload" => "&#xf093;", "lemon-o" => "&#xf094;", "phone" => "&#xf095;", "square-o" => "&#xf096;", "bookmark-o" => "&#xf097;", "phone-square" => "&#xf098;", "twitter" => "&#xf099;", "facebook" => "&#xf09a;", "github" => "&#xf09b;", "unlock" => "&#xf09c;", "credit-card" => "&#xf09d;", "rss" => "&#xf09e;", "hdd-o" => "&#xf0a0;", "bullhorn" => "&#xf0a1;", "bell" => "&#xf0f3;", "certificate" => "&#xf0a3;", "hand-o-right" => "&#xf0a4;", "hand-o-left" => "&#xf0a5;", "hand-o-up" => "&#xf0a6;", "hand-o-down" => "&#xf0a7;", "arrow-circle-left" => "&#xf0a8;", "arrow-circle-right" => "&#xf0a9;", "arrow-circle-up" => "&#xf0aa;", "arrow-circle-down" => "&#xf0ab;", "globe" => "&#xf0ac;", "wrench" => "&#xf0ad;", "tasks" => "&#xf0ae;", "filter" => "&#xf0b0;", "briefcase" => "&#xf0b1;", "arrows-alt" => "&#xf0b2;", "group" => "&#xf0c0;", "link" => "&#xf0c1;", "cloud" => "&#xf0c2;", "flask" => "&#xf0c3;", "cut" => "&#xf0c4;", "copy" => "&#xf0c5;", "paperclip" => "&#xf0c6;", "save" => "&#xf0c7;", "square" => "&#xf0c8;", "bars" => "&#xf0c9;", "list-ul" => "&#xf0ca;", "list-ol" => "&#xf0cb;", "strikethrough" => "&#xf0cc;", "underline" => "&#xf0cd;", "table" => "&#xf0ce;", "magic" => "&#xf0d0;", "truck" => "&#xf0d1;", "pinterest" => "&#xf0d2;", "pinterest-square" => "&#xf0d3;", "google-plus-square" => "&#xf0d4;", "google-plus" => "&#xf0d5;", "money" => "&#xf0d6;", "caret-down" => "&#xf0d7;", "caret-up" => "&#xf0d8;", "caret-left" => "&#xf0d9;", "caret-right" => "&#xf0da;", "columns" => "&#xf0db;", "sort" => "&#xf0dc;", "sort-desc" => "&#xf0dd;", "sort-asc" => "&#xf0de;", "envelope" => "&#xf0e0;", "linkedin" => "&#xf0e1;", "undo" => "&#xf0e2;", "legal" => "&#xf0e3;", "dashboard" => "&#xf0e4;", "comment-o" => "&#xf0e5;", "comments-o" => "&#xf0e6;", "flash" => "&#xf0e7;", "sitemap" => "&#xf0e8;", "umbrella" => "&#xf0e9;", "paste" => "&#xf0ea;", "lightbulb-o" => "&#xf0eb;", "exchange" => "&#xf0ec;", "cloud-download" => "&#xf0ed;", "cloud-upload" => "&#xf0ee;", "user-md" => "&#xf0f0;", "stethoscope" => "&#xf0f1;", "suitcase" => "&#xf0f2;", "bell-o" => "&#xf0a2;", "coffee" => "&#xf0f4;", "cutlery" => "&#xf0f5;", "file-text-o" => "&#xf0f6;", "building-o" => "&#xf0f7;", "hospital-o" => "&#xf0f8;", "ambulance" => "&#xf0f9;", "medkit" => "&#xf0fa;", "fighter-jet" => "&#xf0fb;", "beer" => "&#xf0fc;", "h-square" => "&#xf0fd;", "plus-square" => "&#xf0fe;", "angle-double-left" => "&#xf100;", "angle-double-right" => "&#xf101;", "angle-double-up" => "&#xf102;", "angle-double-down" => "&#xf103;", "angle-left" => "&#xf104;", "angle-right" => "&#xf105;", "angle-up" => "&#xf106;", "angle-down" => "&#xf107;", "desktop" => "&#xf108;", "laptop" => "&#xf109;", "tablet" => "&#xf10a;", "mobile" => "&#xf10b;", "circle-o" => "&#xf10c;", "quote-left" => "&#xf10d;", "quote-right" => "&#xf10e;", "spinner" => "&#xf110;", "circle" => "&#xf111;", "reply" => "&#xf112;", "github-alt" => "&#xf113;", "folder-o" => "&#xf114;", "folder-open-o" => "&#xf115;", "smile-o" => "&#xf118;", "frown-o" => "&#xf119;", "meh-o" => "&#xf11a;", "gamepad" => "&#xf11b;", "keyboard-o" => "&#xf11c;", "flag-o" => "&#xf11d;", "flag-checkered" => "&#xf11e;", "terminal" => "&#xf120;", "code" => "&#xf121;", "reply-all" => "&#xf122;", "star-half-o" => "&#xf123;", "location-arrow" => "&#xf124;", "crop" => "&#xf125;", "code-fork" => "&#xf126;", "chain-broken" => "&#xf127;", "question" => "&#xf128;", "info" => "&#xf129;", "exclamation" => "&#xf12a;", "superscript" => "&#xf12b;", "subscript" => "&#xf12c;", "eraser" => "&#xf12d;", "puzzle-piece" => "&#xf12e;", "microphone" => "&#xf130;", "microphone-slash" => "&#xf131;", "shield" => "&#xf132;", "calendar-o" => "&#xf133;", "fire-extinguisher" => "&#xf134;", "rocket" => "&#xf135;", "maxcdn" => "&#xf136;", "chevron-circle-left" => "&#xf137;", "chevron-circle-right" => "&#xf138;", "chevron-circle-up" => "&#xf139;", "chevron-circle-down" => "&#xf13a;", "html5" => "&#xf13b;", "css3" => "&#xf13c;", "anchor" => "&#xf13d;", "unlock-alt" => "&#xf13e;", "bullseye" => "&#xf140;", "ellipsis-h" => "&#xf141;", "ellipsis-v" => "&#xf142;", "rss-square" => "&#xf143;", "play-circle" => "&#xf144;", "ticket" => "&#xf145;", "minus-square" => "&#xf146;", "minus-square-o" => "&#xf147;", "level-up" => "&#xf148;", "level-down" => "&#xf149;", "check-square" => "&#xf14a;", "pencil-square" => "&#xf14b;", "external-link-square" => "&#xf14c;", "share-square" => "&#xf14d;", "compass" => "&#xf14e;", "caret-square-o-down" => "&#xf150;", "caret-square-o-up" => "&#xf151;", "caret-square-o-right" => "&#xf152;", "euro" => "&#xf153;", "gbp" => "&#xf154;", "dollar" => "&#xf155;", "rupee" => "&#xf156;", "jpy" => "&#xf157;", "rouble" => "&#xf158;", "won" => "&#xf159;", "bitcoin" => "&#xf15a;", "file" => "&#xf15b;", "file-text" => "&#xf15c;", "sort-alpha-asc" => "&#xf15d;", "sort-alpha-desc" => "&#xf15e;", "sort-amount-asc" => "&#xf160;", "sort-amount-desc" => "&#xf161;", "sort-numeric-asc" => "&#xf162;", "sort-numeric-desc" => "&#xf163;", "thumbs-up" => "&#xf164;", "thumbs-down" => "&#xf165;", "youtube-square" => "&#xf166;", "youtube" => "&#xf167;", "xing" => "&#xf168;", "xing-square" => "&#xf169;", "youtube-play" => "&#xf16a;", "dropbox" => "&#xf16b;", "stack-overflow" => "&#xf16c;", "instagram" => "&#xf16d;", "flickr" => "&#xf16e;", "adn" => "&#xf170;", "bitbucket" => "&#xf171;", "bitbucket-square" => "&#xf172;", "tumblr" => "&#xf173;", "tumblr-square" => "&#xf174;", "long-arrow-down" => "&#xf175;", "long-arrow-up" => "&#xf176;", "long-arrow-left" => "&#xf177;", "long-arrow-right" => "&#xf178;", "apple" => "&#xf179;", "windows" => "&#xf17a;", "android" => "&#xf17b;", "linux" => "&#xf17c;", "dribbble" => "&#xf17d;", "skype" => "&#xf17e;", "foursquare" => "&#xf180;", "trello" => "&#xf181;", "female" => "&#xf182;", "male" => "&#xf183;", "gratipay" => "&#xf184;", "sun-o" => "&#xf185;", "moon-o" => "&#xf186;", "archive" => "&#xf187;", "bug" => "&#xf188;", "vk" => "&#xf189;", "weibo" => "&#xf18a;", "renren" => "&#xf18b;", "pagelines" => "&#xf18c;", "stack-exchange" => "&#xf18d;", "arrow-circle-o-right" => "&#xf18e;", "arrow-circle-o-left" => "&#xf190;", "caret-square-o-left" => "&#xf191;", "dot-circle-o" => "&#xf192;", "wheelchair" => "&#xf193;", "vimeo-square" => "&#xf194;", "turkish-lira" => "&#xf195;", "plus-square-o" => "&#xf196;", "space-shuttle" => "&#xf197;", "slack" => "&#xf198;", "envelope-square" => "&#xf199;", "wordpress" => "&#xf19a;", "openid" => "&#xf19b;", "institution" => "&#xf19c;", "graduation-cap" => "&#xf19d;", "yahoo" => "&#xf19e;", "google" => "&#xf1a0;", "reddit" => "&#xf1a1;", "reddit-square" => "&#xf1a2;", "stumbleupon-circle" => "&#xf1a3;", "stumbleupon" => "&#xf1a4;", "delicious" => "&#xf1a5;", "digg" => "&#xf1a6;", "pied-piper" => "&#xf1a7;", "pied-piper-alt" => "&#xf1a8;", "drupal" => "&#xf1a9;", "joomla" => "&#xf1aa;", "language" => "&#xf1ab;", "fax" => "&#xf1ac;", "building" => "&#xf1ad;", "child" => "&#xf1ae;", "paw" => "&#xf1b0;", "spoon" => "&#xf1b1;", "cube" => "&#xf1b2;", "cubes" => "&#xf1b3;", "behance" => "&#xf1b4;", "behance-square" => "&#xf1b5;", "steam" => "&#xf1b6;", "steam-square" => "&#xf1b7;", "recycle" => "&#xf1b8;", "automobile" => "&#xf1b9;", "cab" => "&#xf1ba;", "tree" => "&#xf1bb;", "spotify" => "&#xf1bc;", "deviantart" => "&#xf1bd;", "soundcloud" => "&#xf1be;", "database" => "&#xf1c0;", "file-pdf-o" => "&#xf1c1;", "file-word-o" => "&#xf1c2;", "file-excel-o" => "&#xf1c3;", "file-powerpoint-o" => "&#xf1c4;", "file-image-o" => "&#xf1c5;", "file-archive-o" => "&#xf1c6;", "file-audio-o" => "&#xf1c7;", "file-video-o" => "&#xf1c8;", "file-code-o" => "&#xf1c9;", "vine" => "&#xf1ca;", "codepen" => "&#xf1cb;", "jsfiddle" => "&#xf1cc;", "support" => "&#xf1cd;", "circle-o-notch" => "&#xf1ce;", "rebel" => "&#xf1d0;", "empire" => "&#xf1d1;", "git-square" => "&#xf1d2;", "git" => "&#xf1d3;", "hacker-news" => "&#xf1d4;", "tencent-weibo" => "&#xf1d5;", "qq" => "&#xf1d6;", "wechat" => "&#xf1d7;", "send" => "&#xf1d8;", "send-o" => "&#xf1d9;", "history" => "&#xf1da;", "circle-thin" => "&#xf1db;", "header" => "&#xf1dc;", "paragraph" => "&#xf1dd;", "sliders" => "&#xf1de;", "share-alt" => "&#xf1e0;", "share-alt-square" => "&#xf1e1;", "bomb" => "&#xf1e2;", "soccer-ball-o" => "&#xf1e3;", "tty" => "&#xf1e4;", "binoculars" => "&#xf1e5;", "plug" => "&#xf1e6;", "slideshare" => "&#xf1e7;", "twitch" => "&#xf1e8;", "yelp" => "&#xf1e9;", "newspaper-o" => "&#xf1ea;", "wifi" => "&#xf1eb;", "calculator" => "&#xf1ec;", "paypal" => "&#xf1ed;", "google-wallet" => "&#xf1ee;", "cc-visa" => "&#xf1f0;", "cc-mastercard" => "&#xf1f1;", "cc-discover" => "&#xf1f2;", "cc-amex" => "&#xf1f3;", "cc-paypal" => "&#xf1f4;", "cc-stripe" => "&#xf1f5;", "bell-slash" => "&#xf1f6;", "bell-slash-o" => "&#xf1f7;", "trash" => "&#xf1f8;", "copyright" => "&#xf1f9;", "at" => "&#xf1fa;", "eyedropper" => "&#xf1fb;", "paint-brush" => "&#xf1fc;", "birthday-cake" => "&#xf1fd;", "area-chart" => "&#xf1fe;", "pie-chart" => "&#xf200;", "line-chart" => "&#xf201;", "lastfm" => "&#xf202;", "lastfm-square" => "&#xf203;", "toggle-off" => "&#xf204;", "toggle-on" => "&#xf205;", "bicycle" => "&#xf206;", "bus" => "&#xf207;", "ioxhost" => "&#xf208;", "angellist" => "&#xf209;", "cc" => "&#xf20a;", "shekel" => "&#xf20b;", "meanpath" => "&#xf20c;", "buysellads" => "&#xf20d;", "connectdevelop" => "&#xf20e;", "dashcube" => "&#xf210;", "forumbee" => "&#xf211;", "leanpub" => "&#xf212;", "sellsy" => "&#xf213;", "shirtsinbulk" => "&#xf214;", "simplybuilt" => "&#xf215;", "skyatlas" => "&#xf216;", "cart-plus" => "&#xf217;", "cart-arrow-down" => "&#xf218;", "diamond" => "&#xf219;", "ship" => "&#xf21a;", "user-secret" => "&#xf21b;", "motorcycle" => "&#xf21c;", "street-view" => "&#xf21d;", "heartbeat" => "&#xf21e;", "venus" => "&#xf221;", "mars" => "&#xf222;", "mercury" => "&#xf223;", "transgender" => "&#xf224;", "transgender-alt" => "&#xf225;", "venus-double" => "&#xf226;", "mars-double" => "&#xf227;", "venus-mars" => "&#xf228;", "mars-stroke" => "&#xf229;", "mars-stroke-v" => "&#xf22a;", "mars-stroke-h" => "&#xf22b;", "neuter" => "&#xf22c;", "facebook-official" => "&#xf230;", "pinterest-p" => "&#xf231;", "whatsapp" => "&#xf232;", "server" => "&#xf233;", "user-plus" => "&#xf234;", "user-times" => "&#xf235;", "hotel" => "&#xf236;", "viacoin" => "&#xf237;", "train" => "&#xf238;", "subway" => "&#xf239;", "medium" => "&#xf23a;");
    private $colors = array('bg-amber-100' => array('background-color' => '#ffecb3;'), 'bg-amber-200' => array('background-color' => '#ffe082;'), 'bg-amber-300' => array('background-color' => '#ffd54f;'), 'bg-amber-400' => array('background-color' => '#ffca28;'), 'bg-amber-500' => array('background-color' => '#ffc107;'), 'bg-amber-600' => array('background-color' => '#ffb300;'), 'bg-amber-700' => array('background-color' => '#ffa000;'), 'bg-amber-800' => array('background-color' => '#ff8f00;'), 'bg-amber-900' => array('background-color' => '#ff6f00;'), 'bg-amber-A100' => array('background-color' => '#ffe57f;'), 'bg-amber-A200' => array('background-color' => '#ffd740;'), 'bg-amber-A400' => array('background-color' => '#ffc400;'), 'bg-amber-A700' => array('background-color' => '#ffab00;'), 'bg-blue-100' => array('background-color' => '#bbdefb;'), 'bg-blue-200' => array('background-color' => '#90caf9;'), 'bg-blue-300' => array('background-color' => '#64b5f6;'), 'bg-blue-400' => array('background-color' => '#42a5f5;'), 'bg-blue-500' => array('background-color' => '#2196f3;'), 'bg-blue-600' => array('background-color' => '#1e88e5;'), 'bg-blue-700' => array('background-color' => '#1976d2;'), 'bg-blue-800' => array('background-color' => '#1565c0;'), 'bg-blue-900' => array('background-color' => '#0d47a1;'), 'bg-blue-A100' => array('background-color' => '#82b1ff;'), 'bg-blue-A200' => array('background-color' => '#448aff;'), 'bg-blue-A400' => array('background-color' => '#2979ff;'), 'bg-blue-A700' => array('background-color' => '#2962ff;'), 'bg-blue-grey-100' => array('background-color' => '#cfd8dc;'), 'bg-blue-grey-200' => array('background-color' => '#b0bec5;'), 'bg-blue-grey-300' => array('background-color' => '#90a4ae;'), 'bg-blue-grey-400' => array('background-color' => '#78909c;'), 'bg-blue-grey-500' => array('background-color' => '#607d8b;'), 'bg-blue-grey-600' => array('background-color' => '#546e7a;'), 'bg-blue-grey-700' => array('background-color' => '#455a64;'), 'bg-blue-grey-800' => array('background-color' => '#37474f;'), 'bg-blue-grey-900' => array('background-color' => '#263238;'), 'bg-brown-100' => array('background-color' => '#d7ccc8;'), 'bg-brown-200' => array('background-color' => '#bcaaa4;'), 'bg-brown-300' => array('background-color' => '#a1887f;'), 'bg-brown-400' => array('background-color' => '#8d6e63;'), 'bg-brown-500' => array('background-color' => '#795548;'), 'bg-brown-600' => array('background-color' => '#6d4c41;'), 'bg-brown-700' => array('background-color' => '#5d4037;'), 'bg-brown-800' => array('background-color' => '#4e342e;'), 'bg-brown-900' => array('background-color' => '#3e2723;'), 'bg-cyan-100' => array('background-color' => '#b2ebf2;'), 'bg-cyan-200' => array('background-color' => '#80deea;'), 'bg-cyan-300' => array('background-color' => '#4dd0e1;'), 'bg-cyan-400' => array('background-color' => '#26c6da;'), 'bg-cyan-500' => array('background-color' => '#00bcd4;'), 'bg-cyan-600' => array('background-color' => '#00acc1;'), 'bg-cyan-700' => array('background-color' => '#0097a7;'), 'bg-cyan-800' => array('background-color' => '#00838f;'), 'bg-cyan-900' => array('background-color' => '#006064;'), 'bg-cyan-A100' => array('background-color' => '#84ffff;'), 'bg-cyan-A200' => array('background-color' => '#18ffff;'), 'bg-cyan-A400' => array('background-color' => '#00e5ff;'), 'bg-cyan-A700' => array('background-color' => '#00b8d4;'), 'bg-deep-orange-100' => array('background-color' => '#ffccbc;'), 'bg-deep-orange-200' => array('background-color' => '#ffab91;'), 'bg-deep-orange-300' => array('background-color' => '#ff8a65;'), 'bg-deep-orange-400' => array('background-color' => '#ff7043;'), 'bg-deep-orange-500' => array('background-color' => '#ff5722;'), 'bg-deep-orange-600' => array('background-color' => '#f4511e;'), 'bg-deep-orange-700' => array('background-color' => '#e64a19;'), 'bg-deep-orange-800' => array('background-color' => '#d84315;'), 'bg-deep-orange-900' => array('background-color' => '#bf360c;'), 'bg-deep-orange-A100' => array('background-color' => '#ff9e80;'), 'bg-deep-orange-A200' => array('background-color' => '#ff6e40;'), 'bg-deep-orange-A400' => array('background-color' => '#ff3d00;'), 'bg-deep-orange-A700' => array('background-color' => '#dd2c00;'), 'bg-deep-purple-100' => array('background-color' => '#d1c4e9;'), 'bg-deep-purple-200' => array('background-color' => '#b39ddb;'), 'bg-deep-purple-300' => array('background-color' => '#9575cd;'), 'bg-deep-purple-400' => array('background-color' => '#7e57c2;'), 'bg-deep-purple-500' => array('background-color' => '#673ab7;'), 'bg-deep-purple-600' => array('background-color' => '#5e35b1;'), 'bg-deep-purple-700' => array('background-color' => '#512da8;'), 'bg-deep-purple-800' => array('background-color' => '#4527a0;'), 'bg-deep-purple-900' => array('background-color' => '#311b92;'), 'bg-deep-purple-A100' => array('background-color' => '#b388ff;'), 'bg-deep-purple-A200' => array('background-color' => '#7c4dff;'), 'bg-deep-purple-A400' => array('background-color' => '#651fff;'), 'bg-deep-purple-A700' => array('background-color' => '#6200ea;'), 'bg-green-100' => array('background-color' => '#c8e6c9;'), 'bg-green-200' => array('background-color' => '#a5d6a7;'), 'bg-green-300' => array('background-color' => '#81c784;'), 'bg-green-400' => array('background-color' => '#66bb6a;'), 'bg-green-500' => array('background-color' => '#4caf50;'), 'bg-green-600' => array('background-color' => '#43a047;'), 'bg-green-700' => array('background-color' => '#388e3c;'), 'bg-green-800' => array('background-color' => '#2e7d32;'), 'bg-green-900' => array('background-color' => '#1b5e20;'), 'bg-green-A100' => array('background-color' => '#b9f6ca;'), 'bg-green-A200' => array('background-color' => '#69f0ae;'), 'bg-green-A400' => array('background-color' => '#00e676;'), 'bg-green-A700' => array('background-color' => '#00c853;'), 'bg-grey-100' => array('background-color' => '#f5f5f5;'), 'bg-grey-200' => array('background-color' => '#eeeeee;'), 'bg-grey-300' => array('background-color' => '#e0e0e0;'), 'bg-grey-400' => array('background-color' => '#bdbdbd;'), 'bg-grey-500' => array('background-color' => '#9e9e9e;'), 'bg-grey-600' => array('background-color' => '#757575;'), 'bg-grey-700' => array('background-color' => '#616161;'), 'bg-grey-800' => array('background-color' => '#424242;'), 'bg-grey-900' => array('background-color' => '#212121;'), 'bg-indigo-100' => array('background-color' => '#c5cae9;'), 'bg-indigo-200' => array('background-color' => '#9fa8da;'), 'bg-indigo-300' => array('background-color' => '#7986cb;'), 'bg-indigo-400' => array('background-color' => '#5c6bc0;'), 'bg-indigo-500' => array('background-color' => '#3f51b5;'), 'bg-indigo-600' => array('background-color' => '#3949ab;'), 'bg-indigo-700' => array('background-color' => '#303f9f;'), 'bg-indigo-800' => array('background-color' => '#283593;'), 'bg-indigo-900' => array('background-color' => '#1a237e;'), 'bg-indigo-A100' => array('background-color' => '#8c9eff;'), 'bg-indigo-A200' => array('background-color' => '#536dfe;'), 'bg-indigo-A400' => array('background-color' => '#3d5afe;'), 'bg-indigo-A700' => array('background-color' => '#304ffe;'), 'bg-light-blue-100' => array('background-color' => '#b3e5fc;'), 'bg-light-blue-200' => array('background-color' => '#81d4fa;'), 'bg-light-blue-300' => array('background-color' => '#4fc3f7;'), 'bg-light-blue-400' => array('background-color' => '#29b6f6;'), 'bg-light-blue-500' => array('background-color' => '#03a9f4;'), 'bg-light-blue-600' => array('background-color' => '#039be5;'), 'bg-light-blue-700' => array('background-color' => '#0288d1;'), 'bg-light-blue-800' => array('background-color' => '#0277bd;'), 'bg-light-blue-900' => array('background-color' => '#01579b;'), 'bg-light-blue-A100' => array('background-color' => '#80d8ff;'), 'bg-light-blue-A200' => array('background-color' => '#40c4ff;'), 'bg-light-blue-A400' => array('background-color' => '#00b0ff;'), 'bg-light-blue-A700' => array('background-color' => '#0091ea;'), 'bg-light-green-100' => array('background-color' => '#dcedc8;'), 'bg-light-green-200' => array('background-color' => '#c5e1a5;'), 'bg-light-green-300' => array('background-color' => '#aed581;'), 'bg-light-green-400' => array('background-color' => '#9ccc65;'), 'bg-light-green-500' => array('background-color' => '#8bc34a;'), 'bg-light-green-600' => array('background-color' => '#7cb342;'), 'bg-light-green-700' => array('background-color' => '#689f38;'), 'bg-light-green-800' => array('background-color' => '#558b2f;'), 'bg-light-green-900' => array('background-color' => '#33691e;'), 'bg-light-green-A100' => array('background-color' => '#ccff90;'), 'bg-light-green-A200' => array('background-color' => '#b2ff59;'), 'bg-light-green-A400' => array('background-color' => '#76ff03;'), 'bg-light-green-A700' => array('background-color' => '#64dd17;'), 'bg-lime-100' => array('background-color' => '#f0f4c3;'), 'bg-lime-200' => array('background-color' => '#e6ee9c;'), 'bg-lime-300' => array('background-color' => '#dce775;'), 'bg-lime-400' => array('background-color' => '#d4e157;'), 'bg-lime-500' => array('background-color' => '#cddc39;'), 'bg-lime-600' => array('background-color' => '#c0ca33;'), 'bg-lime-700' => array('background-color' => '#afb42b;'), 'bg-lime-800' => array('background-color' => '#9e9d24;'), 'bg-lime-900' => array('background-color' => '#827717;'), 'bg-lime-A100' => array('background-color' => '#f4ff81;'), 'bg-lime-A200' => array('background-color' => '#eeff41;'), 'bg-lime-A400' => array('background-color' => '#c6ff00;'), 'bg-lime-A700' => array('background-color' => '#aeea00;'), 'bg-orange-100' => array('background-color' => '#ffe0b2;'), 'bg-orange-200' => array('background-color' => '#ffcc80;'), 'bg-orange-300' => array('background-color' => '#ffb74d;'), 'bg-orange-400' => array('background-color' => '#ffa726;'), 'bg-orange-500' => array('background-color' => '#ff9800;'), 'bg-orange-600' => array('background-color' => '#fb8c00;'), 'bg-orange-700' => array('background-color' => '#f57c00;'), 'bg-orange-800' => array('background-color' => '#ef6c00;'), 'bg-orange-900' => array('background-color' => '#e65100;'), 'bg-orange-A100' => array('background-color' => '#ffd180;'), 'bg-orange-A200' => array('background-color' => '#ffab40;'), 'bg-orange-A400' => array('background-color' => '#ff9100;'), 'bg-orange-A700' => array('background-color' => '#ff6d00;'), 'bg-pink-100' => array('background-color' => '#f8bbd0;'), 'bg-pink-200' => array('background-color' => '#f48fb1;'), 'bg-pink-300' => array('background-color' => '#f06292;'), 'bg-pink-400' => array('background-color' => '#ec407a;'), 'bg-pink-500' => array('background-color' => '#e91e63;'), 'bg-pink-600' => array('background-color' => '#d81b60;'), 'bg-pink-700' => array('background-color' => '#c2185b;'), 'bg-pink-800' => array('background-color' => '#ad1457;'), 'bg-pink-900' => array('background-color' => '#880e4f;'), 'bg-pink-A100' => array('background-color' => '#ff80ab;'), 'bg-pink-A200' => array('background-color' => '#ff4081;'), 'bg-pink-A400' => array('background-color' => '#f50057;'), 'bg-pink-A700' => array('background-color' => '#c51162;'), 'bg-purple-100' => array('background-color' => '#e1bee7;'), 'bg-purple-200' => array('background-color' => '#ce93d8;'), 'bg-purple-300' => array('background-color' => '#ba68c8;'), 'bg-purple-400' => array('background-color' => '#ab47bc;'), 'bg-purple-500' => array('background-color' => '#9c27b0;'), 'bg-purple-600' => array('background-color' => '#8e24aa;'), 'bg-purple-700' => array('background-color' => '#7b1fa2;'), 'bg-purple-800' => array('background-color' => '#6a1b9a;'), 'bg-purple-900' => array('background-color' => '#4a148c;'), 'bg-purple-A100' => array('background-color' => '#ea80fc;'), 'bg-purple-A200' => array('background-color' => '#e040fb;'), 'bg-purple-A400' => array('background-color' => '#d500f9;'), 'bg-purple-A700' => array('background-color' => '#aa00ff;'), 'bg-red-100' => array('background-color' => '#ffcdd2;'), 'bg-red-200' => array('background-color' => '#ef9a9a;'), 'bg-red-300' => array('background-color' => '#e57373;'), 'bg-red-400' => array('background-color' => '#ef5350;'), 'bg-red-500' => array('background-color' => '#f44336;'), 'bg-red-600' => array('background-color' => '#e53935;'), 'bg-red-700' => array('background-color' => '#d32f2f;'), 'bg-red-800' => array('background-color' => '#c62828;'), 'bg-red-900' => array('background-color' => '#b71c1c;'), 'bg-red-A100' => array('background-color' => '#ff8a80;'), 'bg-red-A200' => array('background-color' => '#ff5252;'), 'bg-red-A400' => array('background-color' => '#ff1744;'), 'bg-red-A700' => array('background-color' => '#d50000;'), 'bg-teal-100' => array('background-color' => '#b2dfdb;'), 'bg-teal-200' => array('background-color' => '#80cbc4;'), 'bg-teal-300' => array('background-color' => '#4db6ac;'), 'bg-teal-400' => array('background-color' => '#26a69a;'), 'bg-teal-500' => array('background-color' => '#009688;'), 'bg-teal-600' => array('background-color' => '#00897b;'), 'bg-teal-700' => array('background-color' => '#00796b;'), 'bg-teal-800' => array('background-color' => '#00695c;'), 'bg-teal-900' => array('background-color' => '#004d40;'), 'bg-teal-A100' => array('background-color' => '#a7ffeb;'), 'bg-teal-A200' => array('background-color' => '#64ffda;'), 'bg-teal-A400' => array('background-color' => '#1de9b6;'), 'bg-teal-A700' => array('background-color' => '#00bfa5;'), 'bg-yellow-100' => array('background-color' => '#fff9c4;'), 'bg-yellow-200' => array('background-color' => '#fff59d;'), 'bg-yellow-300' => array('background-color' => '#fff176;'), 'bg-yellow-400' => array('background-color' => '#ffee58;'), 'bg-yellow-500' => array('background-color' => '#ffeb3b;'), 'bg-yellow-600' => array('background-color' => '#fdd835;'), 'bg-yellow-700' => array('background-color' => '#fbc02d;'), 'bg-yellow-800' => array('background-color' => '#f9a825;'), 'bg-yellow-900' => array('background-color' => '#f57f17;'), 'bg-yellow-A100' => array('background-color' => '#ffff8d;'), 'bg-yellow-A200' => array('background-color' => '#ffff00;'), 'bg-yellow-A400' => array('background-color' => '#ffea00;'), 'bg-yellow-A700' => array('background-color' => '#ffd600;'),);
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Learning Features', array('description' => 'Learning Features for course page below left widget'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : "What you'll learn";
        $SubTitle = isset($instance['SubTitle']) ? $instance['SubTitle'] : "A minus obcaecati optio pariatur porro";
        $ListIcon = isset($instance['ListIcon']) ? $instance['ListIcon'] : array();
        $ListColor = isset($instance['ListColor']) ? $instance['ListColor'] : array();
        $ListText = isset($instance['ListText']) ? $instance['ListText'] : array();
        $i = 0;
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('SubTitle'); ?>"><?php _e('Sub Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('SubTitle'); ?>" name="<?php echo $this->get_field_name('SubTitle'); ?>" value="<?php echo $SubTitle; ?>" />
        </p>
        <h4>List Group Items</h4>
        <?php do { ?>
        <div class="list-item-fields">
            <p>
                <label for="<?php echo $this->get_field_id('ListIcon') . '[' . $i . ']'; ?>"><?php _e('List Icon:') ?></label>
                <select class="widefat font-awesome-icon" id="<?php echo $this->get_field_id('ListIcon') . '[' . $i . ']'; ?>" name="<?php echo $this->get_field_name('ListIcon') . '[]'; ?>">
					<option>— Select Icon —</option>
					<?php
            foreach ($this->font_awesome_icons as $name => $code) {
                echo '<option value="' . $name . '" ' . selected($ListIcon[$i], $name, FALSE) . '>' . $name . '&emsp;&emsp;' . $code . '</option>';
            }
?>
				</select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('ListColor') . '[' . $i . ']'; ?>"><?php _e('List color:') ?></label>
                <select class="widefat list-color" id="<?php echo $this->get_field_id('ListColor') . '[' . $i . ']'; ?>" name="<?php echo $this->get_field_name('ListColor') . '[]'; ?>">
					<option value="0">— Select Color —</option>
					<?php foreach ($this->colors as $name => $property) {
                $optionColor = ($this->colorLevel($name)) ? 'color:#ffffff;' : 'color:#000000';
                echo '<option value="' . $name . '" ' . selected($ListColor[$i], $name, FALSE) . ' style="background-color:' . $property['background-color'] . $optionColor . '">' . substr("$name", 3) . '</option>';
            }
?>
				</select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('ListText') . '[' . $i . ']'; ?>"><?php _e('List Text:') ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('ListText') . '[' . $i . ']'; ?>" name="<?php echo $this->get_field_name('ListText') . '[]'; ?>"><?php echo $ListText[$i]; ?></textarea>
            </p>
            <?php if ($i > 0): ?>
            <p class="align-right"><button type="button" class="button button-delete delete-item">Delete</button></p>
            <?php
            endif; ?>
        </div>
        <?php $i++;
        } while ($i < count($ListIcon));
?>
        <button type="button" class="button add-more-item">Add More Item</button>
        <?php
    }
    private function colorLevel($ColorName) {
        $colorLevels = array('500', '600', '700', '800', '900');
        foreach ($colorLevels as $Level) {
            if (strpos($ColorName, $Level) !== FALSE) {
                echo 'here';
                return true;
            }
        }
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
       // echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . $instance['title'] . $args['after_title'];
        }
        if (!empty($instance['title'])) {
            echo '<p class="text-subhead text-light">' . $instance['SubTitle'] . '</p>';
        }
        if (!empty($instance['ListIcon'])) {
            echo '<ul class="list-group relative paper-shadow" data-hover-z="0.5" data-animated>';
            foreach ($instance['ListIcon'] as $i => $ListIcon) {
                echo '<li class="list-group-item">
                  <div class="media v-middle">
                    <div class="media-left">
                      <div class="icon-block s30 ' . $instance['ListColor'][$i] . ' text-white img-circle">
                        <i class="fab fa-' . $ListIcon . '"></i>
                      </div>
                    </div>
                    <div class="media-body text-body-2">
                      ' . $instance['ListText'][$i] . '
                    </div>
                  </div>
                </li>';
            }
            echo '</ul>';
        }
       // echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['SubTitle'] = strip_tags(stripslashes($new_instance['SubTitle']));
        $instance['ListIcon'] = array();
        if (isset($new_instance['ListIcon'])) {
            foreach ($new_instance['ListIcon'] as $value) {
                if ('' !== trim($value)) $instance['ListIcon'][] = $value;
            }
        }
        $instance['ListColor'] = array();
        if (isset($new_instance['ListColor'])) {
            foreach ($new_instance['ListColor'] as $value) {
                if ('' !== trim($value)) $instance['ListColor'][] = $value;
            }
        }
        $instance['ListText'] = array();
        if (isset($new_instance['ListText'])) {
            foreach ($new_instance['ListText'] as $value) {
                if ('' !== trim($value)) $instance['ListText'][] = $value;
            }
        }
        //$instance['ListColor'] = sanitize_key($new_instance['ListColor']);
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}

class Testimonials_Widget extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'LearningApp Testimonials', array('description' => 'Testimonials for course page below right widget'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : "Testimonials";
        $SubTitle = isset($instance['SubTitle']) ? $instance['SubTitle'] : "A few words from our past students";
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('SubTitle'); ?>"><?php _e('Sub Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('SubTitle'); ?>" name="<?php echo $this->get_field_name('SubTitle'); ?>" value="<?php echo $SubTitle; ?>" />
        </p>
        <?php
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div class="pull-right"><a class="btn btn-white btn-circle paper-shadow relative" data-z="1" href="#"><i class="md md-add"></i></a></div>';
        if (!empty($instance['title'])) {
            echo '<h2 class="text-headline margin-none">' . $instance['title'] . '</h2>';
        }
        if (!empty($instance['SubTitle'])) {
            echo '<p class="text-subhead text-light">' . $instance['SubTitle'] . '</p>';
        }
        $attr = array('posts_per_page' => - 1, 'post_type' => 'testimonials', 'orderby' => 'date', 'order' => 'ASC');
        $testimonials = get_posts($attr);
        echo '<div class="slick-basic slick-slider" data-items="1" data-items-lg="1" data-items-md="1" data-items-sm="1" data-items-xs="1">';
        foreach ($testimonials as $i => $testimonial) {
            $client_name = get_field('client_name', $testimonial->ID);
            $client_image = get_field('client_image', $testimonial->ID);
            $rating = get_field('rating', $testimonial->ID);
            echo '<div class="item"><div class="testimonial"><div class="panel panel-default"><div class="panel-body"><p>' . $testimonial->post_content . '</p></div></div>';
            echo '<div class="media v-middle">
                      <div class="media-left">
                        ' . wp_get_attachment_image($client_image, array(40, 40), false, array('class' => 'img-circle width-40')) . '
                      </div>
                      <div class="media-body">
                        <p class="text-subhead margin-v-5-0">
                          <strong>' . $testimonial->post_title . ' <span class="text-muted">@ ' . $client_name . '</span></strong>
                        </p>
                        <p class="small">';
            for ($i = 1;$i <= 5;$i++) {
                if ($i <= $rating) echo '<span class="fab fa-fw fa-star text-yellow-800"></span>';
                else echo '<span class="fab fa-fw fa-star-o text-yellow-800"></span>';
            }
            echo '</p>
                      </div>
                    </div>';
?>
                  </div>
                </div>
        <?php
        }
        echo '</div>';
        echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['SubTitle'] = strip_tags(stripslashes($new_instance['SubTitle']));
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}
class Footer_copyright extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Footer Copyright', array('description' => 'Footer Copyright Text'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $copyright = isset($instance['copyright']) ? $instance['copyright'] : '';
        $copyright = esc_attr($copyright);
        printf('<p><label for="%1$s">%2$s</label><br />

            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('copyright'), 'Copyright Text', $this->get_field_name('copyright'), $copyright);
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        print $instance['copyright'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['copyright'] = $new_instance['copyright'];
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}
class Footer_News_Letter extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Footer News Letter', array('description' => 'Adds a News Letter on Footer'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
        </p>
        <?php
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) echo $args['before_title'] . $instance['title'] . $args['after_title'];
        print '<div class="form-group"><div class="input-group"><input type="email" class="form-control" placeholder="Enter email here..."><span class="input-group-btn"><button class="btn btn-grey-800" type="button">Subscribe</button></span></div></div>';
        echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}
class Footer_SocialLinks extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Footer Social Links', array('description' => 'Adds Footer Social Links'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        printf('<p><label for="%1$s">%2$s</label>

            <input type="text" class="widefat" id="%1$s" name="%3$s" value="%4$s" />

            </p>', $this->get_field_id('title'), 'Title:', $this->get_field_name('title'), $title);
        $facebook = isset($instance['facebook']) ? $instance['facebook'] : '';
        $facebook = esc_attr($facebook);
        printf('<p><label for="%1$s">%2$s</label><br />

            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('facebook'), 'Facebook URL', $this->get_field_name('facebook'), $facebook); //twitter google_plus
        $dribbble = isset($instance['dribbble']) ? $instance['dribbble'] : '';
        $dribbble = esc_attr($dribbble);
        printf('<p><label for="%1$s">%2$s</label><br />

            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('dribbble'), 'Dribbble URL', $this->get_field_name('dribbble'), $dribbble);
        $twitter = isset($instance['twitter']) ? $instance['twitter'] : '';
        $twitter = esc_attr($twitter);
        printf('<p><label for="%1$s">%2$s</label><br />

            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('twitter'), 'Twitter URL', $this->get_field_name('twitter'), $twitter);
        $google_plus = isset($instance['google_plus']) ? $instance['google_plus'] : '';
        $google_plus = esc_attr($google_plus);
        printf('<p><label for="%1$s">%2$s</label><br />

            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('google_plus'), 'Google Plus URL', $this->get_field_name('google_plus'), $google_plus);
        $youtube_play = isset($instance['youtube']) ? $instance['youtube'] : '';
        $youtube_play = esc_attr($youtube_play);
        printf('<p><label for="%1$s">%2$s</label><br />

            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('youtube'), 'Youtube URL', $this->get_field_name('youtube'), $youtube_play);
        $whatsapp_ed_id   = $this->get_field_id( 'whatsapp' );
        $whatsapp_ed_name = $this->get_field_name( 'whatsapp' );
        $whatsapp = isset($instance['whatsapp']) ? $instance['whatsapp'] : '';
        $whatsapp = esc_attr($whatsapp);
        printf('<div style="margin: 1em 0;"><label>%s</label><br />', 'WhatsApp Share Content');
        wp_editor($whatsapp, $whatsapp_ed_id, array('textarea_name' => $whatsapp_ed_name, 'media_buttons' => false, 'teeny'=> true, 'textarea_rows' => 5, 'wpautop'=>false, 'tinymce'=> false, ) );
        printf('</div>');
        $cp_rgt = isset($instance['cp_rgt']) ? $instance['cp_rgt'] : '';
        $cp_rgt = esc_attr($cp_rgt);
        printf('<p><label for="%1$s">%2$s</label><br />
        

            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('cp_rgt'), 'Copyright Text', $this->get_field_name('cp_rgt'), $cp_rgt);
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) echo $args['before_title'] . $instance['title'] . $args['after_title'];
        print '<br/><p>' . (($instance['facebook'] !== '') ? '<a href="' . $instance['facebook'] . '" target="_blank" class="btn fb-btn btn-circle"><i class="fab fa-facebook-f"></i></a> ' : '') . (($instance['dribbble'] !== '') ? '<a href="' . $instance['dribbble'] . '" target="_blank" class="btn btn-pink-500 dribble-btn btn-circle"><i class="fab fa-dribbble"></i></a> ' : '') . (($instance['twitter'] !== '') ? '<a href="' . $instance['twitter'] . '" target="_blank" class="btn btn-blue-500 twiter-btn btn-circle"><i class="fab fa-twitter"></i></a> ' : '') . (($instance['google_plus'] !== '') ? '<a href="' . $instance['google_plus'] . '" target="_blank" class="btn btn-danger gplus-btn btn-circle"><i class="fab fa-google-plus-g"></i></a> ' : '') . (($instance['youtube'] !== '') ? '<a href="' . $instance['youtube'] . '" target="_blank" class="btn btn-danger youtube-btn btn-circle"><i class="fab fa-youtube"></i></a> ' : '') . (($instance['whatsapp'] !== '') ? '<a href="whatsapp://send?text=' . urlencode($instance['whatsapp']) . '" class="btn btn-success whatsapp-btn btn-circle d-lg-none"><i class="fab fa-whatsapp"></i></a> ' : '') . '</p>';
        print '<p  class="text-subhead">' . $instance['cp_rgt'] . '</p>';
        echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = esc_html($new_instance['title']);
        $instance['facebook'] = esc_html($new_instance['facebook']);
        $instance['dribbble'] = esc_html($new_instance['dribbble']);
        $instance['twitter'] = esc_html($new_instance['twitter']);
        $instance['google_plus'] = esc_html($new_instance['google_plus']);
        $instance['youtube'] = esc_html($new_instance['youtube']);
        $instance['whatsapp'] = esc_html($new_instance['whatsapp']);
        $instance['cp_rgt'] = esc_html($new_instance['cp_rgt']);
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}
class Footer_Menu extends WP_Widget {
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct(strtolower(__CLASS__), 'Footer Menu', array('description' => 'Adds Footer Menu above the Bottom Footer'));
    }
    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : '';
        // Get menus
        $menus = wp_get_nav_menus(array('orderby' => 'name'));
        // If no menus exists, direct the user to go and create some.
        if (!$menus) {
            echo '<p>' . sprintf(__('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php')) . '</p>';
            return;
        }
?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
                <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
                    <option value="0"><?php _e('&mdash; Select &mdash;') ?></option>
            <?php
        foreach ($menus as $menu) {
            echo '<option value="' . $menu->term_id . '"' . selected($nav_menu, $menu->term_id, false) . '>' . esc_html($menu->name) . '</option>';
        }
?>
                </select>
            </p>
            <?php
    }
    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        // Get menu
        $nav_menu = !empty($instance['nav_menu']) ? wp_get_nav_menu_object($instance['nav_menu']) : false;
        if (!$nav_menu) return;
        /** This filter is documented in wp-includes/default-widgets.php */
        $instance['title'] = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        echo $args['before_widget'];
        if (!empty($instance['title'])) echo $args['before_title'] . $instance['title'] . $args['after_title'];
        wp_nav_menu(array('fallback_cb' => '', 'menu' => $nav_menu, 'container_class' => 'soma_container', 'menu_class' => 'list-unstyled',));
        echo $args['after_widget'];
    }
    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['nav_menu'] = (int)$new_instance['nav_menu'];
        return $instance;
    }
    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }
}
