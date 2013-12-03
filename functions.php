<?php
define('TEMPLATEURL',get_template_directory_uri());

Class Backbone_App{
	
	function __construct(){
		add_action('wp_enqueue_scripts', array($this,'bb_add_script') );
		$this->register_action();
		
	}
	function bb_add_script(){
		

		wp_deregister_script( 'backbone' );	
		wp_deregister_script( 'underscore' );		
		wp_register_script( 'backbone', TEMPLATEURL.'/js/lib/backbone.js', false, '1.1', 'false' );
		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'underscore', TEMPLATEURL.'/js/lib/underscore.js', false, '1.1', 'false' );
		wp_enqueue_script( 'backbone' );
		wp_register_script( 'bb', TEMPLATEURL.'/js/main.js', array ('jquery', 'underscore', 'backbone') , '1.0' , true );
		wp_enqueue_script('bb');
		wp_enqueue_script( 'json');
		
	}
	function bb_add_style(){

	}
	function register_action(){		 
		add_action( 'wp_head', array($this,'wp_head'));
		add_action( 'wp_ajax_bb-add-post',array($this, 'bb_add_post') );
		add_action( 'wp_ajax_nopriv_bb-add-post',array($this,'bb_add_post') );
	}
	function wp_head(){
		$config = array('ajaxURL'=>admin_url( 'admin-ajax.php' ));
		wp_localize_script( 'bb','bb_global', $config);
	}
	function bb_add_post(){
		
		$request = array();
		$request = $_GET;
		$request['post_status'] ='publish';
		$args = wp_parse_args( $request,array('post_type' => 'post','post_status' => 'publish'));

		$post_id = wp_insert_post( $request);
		if(!is_wp_error( $post_id )){
			$post 				= array();
			$post 				= get_post($post_id);
			$post->permalink 	= get_permalink( $post_id );
			
			wp_send_json(array('success'=>true,'data'=>$post));
		}
		wp_send_json(array('success'=>false,'msg'=> __('Insert post error') ));
			
	}

}
new Backbone_App(); 
;

 	
?>