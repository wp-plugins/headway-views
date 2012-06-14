<?php

class HeadwayViewsBlockOptions extends HeadwayBlockOptionsAPI {
	
	public $tabs = array(
		'options' => 'Options'
	);

	public $inputs = array(
		'options' => array(
			'options' => array(
				'type' => 'textarea',
				'name' => 'options',
				'label' => 'Options',
				'default' => null
			),
			'views' => array(
				'type' => 'select',
				'name' => 'viewst',
				'label' => 'Select View',
				'default' => 'left',
				'options' => array(
					'' => 'Views not installed'
				)
			),
		)
	);
	
	function modify_arguments($args) {
		global $WP_Views;
		if(isset($WP_Views)) {
	        $views = $WP_Views->get_views();       
	
	        $view_options = array('' => 'Select View:');
	        foreach($views as $view) {
	        	if(!empty($view->post_title)) {
	        		$view_options[$view->ID] = $view->post_title;
	        	}
	        }
	        
	        $this->inputs['options']['views']['options'] = $view_options;
		
        	$this->tab_notices['options'] = 'To create a new View, please navigate to <a href="'. admin_url('post-new.php?post_type=view'). '">Dashboard -> Views -> Add New View</a>.';
		} else {
			$this->tab_notices['options'] = 'Get Views - the single most powerful Content filtering and listing plugin here: <a href="http://wp-types.com">http://wp-types.com</a>';
		}
	}
	
}