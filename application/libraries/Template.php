<?php
	class Template {
		protected $_ci;

		function __construct() {
			$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
		}

		function views($template = NULL, $data = NULL) {
			if ($template != NULL) {
				// head
				$data['_meta'] 					= $this->_ci->load->view('admin/_layouts/_meta', $data, TRUE);
				$data['_css'] 					= $this->_ci->load->view('admin/_layouts/_css', $data, TRUE);
				
				// Header
				$data['_navbar'] 				= $this->_ci->load->view('admin/_layouts/_navbar', $data, TRUE);
				$data['_sidebar'] 				= $this->_ci->load->view('admin/_layouts/_sidebar', $data, TRUE);
				$data['_preloader'] 				= $this->_ci->load->view('admin/_layouts/_preloader', $data, TRUE);
				

				//Content
				$data['_message'] 		= $this->_ci->load->view('admin/_layouts/_message', $data, TRUE);
				$data['_mainContent'] 		= $this->_ci->load->view($template, $data, TRUE);
				$data['_content'] 				= $this->_ci->load->view('admin/_layouts/_content', $data, TRUE);
				
				//Footer
				$data['_footer'] 				= $this->_ci->load->view('admin/_layouts/_footer', $data, TRUE);
				
				//JS
				$data['_js'] 					= $this->_ci->load->view('admin/_layouts/_js', $data, TRUE);

				echo $data['_template'] 		= $this->_ci->load->view('admin/_layouts/_template', $data, TRUE);

				remove_flashdata();

			}
		}



		function home_views($template = NULL, $data = NULL) {
			if ($template != NULL) {

				// head
				$data['_meta'] 					= $this->_ci->load->view('home/_layouts/_meta', $data, TRUE);
				$data['_css'] 					= $this->_ci->load->view('home/_layouts/_css', $data, TRUE);
				
				// Header
				$data['_header'] 				= $this->_ci->load->view('home/_layouts/_header', $data, TRUE);
				$data['_preloader'] 				= $this->_ci->load->view('home/_layouts/_preloader', $data, TRUE);
				
				

				//Content
				$data['_breadcrumb'] 				= $this->_ci->load->view('home/_layouts/_breadcrumb', $data, TRUE);

				$data['_mainContent'] 		= $this->_ci->load->view($template, $data, TRUE);
				$data['_content'] 				= $this->_ci->load->view('home/_layouts/_content', $data, TRUE);
				
				//Donation
				$data['_donation'] 				= $this->_ci->load->view('home/_layouts/_donation', $data, TRUE);

				//Footer
				$data['_footer'] 				= $this->_ci->load->view('home/_layouts/_footer', $data, TRUE);
				
				//JS
				$data['_js'] 					= $this->_ci->load->view('home/_layouts/_js', $data, TRUE);

				

				echo $data['_template'] 		= $this->_ci->load->view('home/_layouts/_template', $data, TRUE);
			}
		}
	}
?>