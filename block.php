<?php

class HeadwayViewsBlock extends HeadwayBlockAPI {
	
	public $id = 'views';
	
	public $name = 'Views';
	
	public $core_block = true;
	
	public $options_class = 'HeadwayViewsBlockOptions';
	
	public $html_tag = 'div';
	
	protected $show_content_in_grid = true;
	
	function init_action($block_id) {
		
		$block = HeadwayBlocksData::get_block($block_id);
												
		$widget_area_name = HeadwayBlocksData::get_block_name($block) . ' &mdash; ' . 'Layout: ' . HeadwayLayout::get_name($block['layout']);
				
		$widget_area = array(
			'name'			 =>   $widget_area_name,
			'id' 			 =>   'widget-area-' . $block['id'],
			'before_widget'  =>   '<li id="%1$s" class="widget %2$s">' . "\n",
			'after_widget'   =>   '</li><!-- .widget -->' . "\n",
			'before_title'   =>   '<span class="widget-title view-title">',
			'after_title'    =>   '</span>' . "\n",
		);

		register_sidebar($widget_area);
		
	}
	
	function setup_elements() {
	}
	
	function content($block) {
		global $WP_Views;
		
		if(isset($WP_Views)) {
			if(isset($block['settings']['viewst'])) {
				$view_id = $block['settings']['viewst'];
				echo '<div class="view_widget">';
				echo render_view(array('id' => $view_id));
				echo '</div>';
			} else {
				echo 'Please select a View from your block options to be displayed in this block';
			}
		} else {
			echo "You need to install the <a href='http://wp-types.com'>Views plugin</a> in order to embed dynamic modules in your website.";
		}
		
	}
	
	
}