<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{


	public function check_subscription_exists($user)
	{
		$this->db->select('ci_subscriptions.*');
		$this->db->from('ci_subscriptions');
		$this->db->where('ci_subscriptions.subscription_mail', $user);
		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}


	public function get_Banner_details()
	{
		$multiplewhere = array(
			'ci_banner.status' => 1,
		);


		$this->db->select('ci_banner.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_banner.sort_order', 'asc');

		return $this->db->get('ci_banner')->result();
	}



	public function get_ImgGallery_details($limit = 0,$category_id = 0)
	{
		$multiplewhere = array(
			'ci_image_gallery.status' => 1,
			'ci_image_gallery.gallery_category' => $category_id
		);

		if ($category_id == 0)
			unset($multiplewhere['ci_image_gallery.gallery_category']);


		$this->db->select('ci_image_gallery.*,ci_gallery_categories.category_name');
		$this->db->where($multiplewhere);
		$this->db->join('ci_gallery_categories', 'ci_gallery_categories.category_id = ci_image_gallery.gallery_category', 'left');

		$this->db->order_by('ci_image_gallery.sort_order', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_image_gallery')->result();
	}


	public function get_VideoGallery_details($limit = 0)
	{
		$multiplewhere = array(
			'ci_video_gallery.status' => 1
		);

		

		$this->db->select('ci_video_gallery.*');
		$this->db->where($multiplewhere);

		$this->db->order_by('ci_video_gallery.sort_order', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_video_gallery')->result();
	}


	public function get_Administration_details($limit = 0,$year_id = 0)
	{
		$multiplewhere = array(
			'ci_administration.status' => 1,
			'ci_administration.year' => $year_id
		);

		if ($year_id == 0)
			unset($multiplewhere['ci_administration.year']);


		$this->db->select('ci_administration.*,ci_designations.designation_name');
		$this->db->where($multiplewhere);
		$this->db->join('ci_designations', 'ci_designations.designation_id  = ci_administration.designation', 'left');
		$this->db->join('ci_years', 'ci_years.year_id  = ci_administration.year', 'left');

		$this->db->order_by('ci_administration.sort_order', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_administration')->result();
	}


	public function get_News_details($limit = 0,$category_id = 0)
	{
		$multiplewhere = array(
			'ci_news.status' => 1,
			'ci_news.category' => $category_id
		);

		if ($category_id == 0)
			unset($multiplewhere['ci_news.category']);


		$this->db->select('ci_news.*,ci_news_category.category_name');
		$this->db->where($multiplewhere);
		$this->db->join('ci_news_category', 'ci_news_category.category_id   = ci_news.category', 'left');

		$this->db->order_by('ci_news.sort_order', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_news')->result();
	}


	public function get_Events_details($limit = 0)
	{
		$multiplewhere = array(
			'ci_events.status' => 1
		);

		


		$this->db->select('ci_events.*');
		$this->db->where($multiplewhere);

		$this->db->order_by('ci_events.sort_order', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_events')->result();
	}

	public function get_latest_News_details($limit = 0,$category_id = 0)
	{
		$multiplewhere = array(
			'ci_news.status' => 1,
			'ci_news.category' => $category_id
		);

		if ($category_id == 0)
			unset($multiplewhere['ci_news.category']);


		$this->db->select('ci_news.*,ci_news_category.category_name');
		$this->db->where($multiplewhere);
		$this->db->join('ci_news_category', 'ci_news_category.category_id   = ci_news.category', 'left');

		$this->db->order_by('ci_news.news_id', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_news')->result();
	}


	public function get_latest_Events_details($limit = 0)
	{
		$multiplewhere = array(
			'ci_events.status' => 1,
		);

	

		$this->db->select('ci_events.*');
		$this->db->where($multiplewhere);

		$this->db->order_by('ci_events.event_id', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_events')->result();
	}


	public function get_News_details_by_id($news_id)
	{
		$multiplewhere = array(
			'ci_news.status' => 1,
			'ci_news.news_id' => $news_id
		);

		
		$this->db->select('ci_news.*,ci_news_category.category_name');
		$this->db->where($multiplewhere);
		$this->db->join('ci_news_category', 'ci_news_category.category_id   = ci_news.category', 'left');


		return $this->db->get('ci_news')->row();
	}


	public function get_Event_details_by_id($event_id)
	{
		$multiplewhere = array(
			'ci_events.status' => 1,
			'ci_events.event_id' => $event_id
		);

		
		$this->db->select('ci_events.*');
		$this->db->where($multiplewhere);


		return $this->db->get('ci_events')->row();
	}


	public function get_About_us_details()
	{
		$multiplewhere = array(
			'ci_about_us.status' => 1,
		);


		$this->db->select('ci_about_us.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_about_us')->row();
	}
















	function count_image_gallery_details($category = 0)
	{
		$where = array(
			'ci_image_gallery.status' => '1',
			'ci_gallery_categories.status' => '1'
		);
		if ($category > 0)
			$where['ci_image_gallery.gallery_category'] = $category;


		$this->db->where($where);
		$this->db->order_by("ci_image_gallery.sort_order", "asc");
		$this->db->join('ci_gallery_categories', 'ci_gallery_categories.category_id = ci_image_gallery.gallery_category', 'left');

		$this->db->where($where);

		$query = $this->db->get('ci_image_gallery');
		return $query->num_rows();
	}

	function fetch_image_gallery_details($limit, $start, $category = 0)
	{
		$where = array(
			'ci_image_gallery.status' => '1',
			'ci_gallery_categories.status' => '1'
		);
		if ($category > 0)
			$where['ci_image_gallery.gallery_category'] = $category;


		$this->db->where($where);
		$this->db->order_by("ci_image_gallery.sort_order", "asc");
		$this->db->limit($limit, $start);
		$this->db->join('ci_gallery_categories', 'ci_gallery_categories.category_id = ci_image_gallery.gallery_category', 'left');

		return $this->db->get('ci_image_gallery')->result();
	}











	public function get_Services()
	{
		$multiplewhere = array(
			'ci_services.status' => 1
		);


		$this->db->select('service_title,service_description,service_image');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_services')->result();
	}



	public function get_video_gallery()
	{
		$multiplewhere = array(
			'ci_video_gallery.status' => 1
		);


		$this->db->select('video_title,video_link,sort_order');
		$this->db->where($multiplewhere);
		$this->db->order_by('sort_order', 'asc');
		return $this->db->get('ci_video_gallery')->result();
	}


	public function select_Service_images_categories($sd_id)
	{
		$multiplewhere = array(
			'ci_service_images_cat.status' => 1,
			'ci_service_images_cat.details_id' => $sd_id
		);


		$this->db->select('ci_service_images_cat.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_service_images_cat.sort_order', 'asc');
		return $this->db->get('ci_service_images_cat')->result();
	}


	public function select_Service_images($sd_id)
	{
		$multiplewhere = array(
			'ci_service_images.status' => 1,
			'ci_service_images.sd_id' => $sd_id
		);


		$this->db->select('ci_service_images.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_service_images')->result();
	}


	public function get_Services_headings($services_id)
	{
		$multiplewhere = array(
			'ci_service_sub_heading.status' => 1,
			'ci_service_sub_heading.service_id' => $services_id
		);


		$this->db->select('ci_service_sub_heading.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_service_sub_heading.sort_order', 'asc');

		return $this->db->get('ci_service_sub_heading')->result();
	}


	public function get_Services_details($services_id, $heading_id)
	{
		$multiplewhere = array(
			'ci_services_details.status' => 1,
			'ci_services_details.details_id' => $services_id
		);

		$multiplewhere['ci_services_details.service_heading'] = $heading_id;

		$this->db->select('ci_services_details.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_services_details.sort_order', 'asc');
		return $this->db->get('ci_services_details')->result();
	}








	public function get_Blogs_details($blogs_id)
	{
		$multiplewhere = array(
			'ci_blogs.status' => 1,
			'ci_blogs.blogs_id' => $blogs_id
		);


		$this->db->select('ci_blogs.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_blogs')->row();
	}


	public function get_latest_Blogs($limit = 0)
	{
		$multiplewhere = array(
			'ci_blogs.status' => 1,
		);


		$this->db->select('ci_blogs.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_blogs.blogs_id', 'desc');
		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('ci_blogs')->result();
	}





	public function get_Expertise_details()
	{
		$multiplewhere = array(
			'ci_expertise.status' => 1,
		);


		$this->db->select('ci_expertise.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_expertise.sort_order', 'asc');
		return $this->db->get('ci_expertise')->result();
	}





	public function get_Image_gallery_details()
	{
		$multiplewhere = array(
			'ci_image_gallery.status' => 1,
		);


		$this->db->select('ci_image_gallery.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_image_gallery.sort_order', 'asc');
		return $this->db->get('ci_image_gallery')->result();
	}



	public function get_Image_gallery_by_Category($category_id, $limit = 0)
	{
		$multiplewhere = array(
			'ci_image_gallery.status' => 1,
			'ci_image_gallery.gallery_category' => $category_id
		);


		$this->db->select('ci_image_gallery.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_image_gallery.sort_order', 'asc');

		if ($limit > 0)
			$this->db->limit($limit);


		return $this->db->get('ci_image_gallery')->result();
	}



	public function get_Image_gallery_categories()
	{
		$multiplewhere = array(
			'ci_gallery_categories.status' => 1,
		);


		$this->db->select('ci_gallery_categories.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_gallery_categories.sort_order', 'asc');
		return $this->db->get('ci_gallery_categories')->result();
	}






	public function insert_contact_us($data)
	{
		$this->db->insert('ci_contact_messages', $data);
		return $this->db->affected_rows();
	}




	/*
	*
	*
	*/


	

	public function get_top_menu($tm_id){
		$multiplewhere = array(
		'ci_top_menu.status' => 1,
		'ci_top_menu.tm_id' => $tm_id
		);
		
	 
		$this->db->select('ci_top_menu.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_top_menu')->row();
	}



	public function select_sub_menu($mm_id){
		$multiplewhere = array(
		'ci_main_menu.status' => 1,
		'ci_main_menu.mm_id' => $mm_id,
		);
		
	 
		$this->db->select('ci_main_menu.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_main_menu')->row();
	}


	public function check_visitor_visited($data)
	{
		$multiplewhere = array(
			'visitors.visitor_ip' => $data["visitor_ip"],
			'visitors.visited_date' => $data["visited_date"],
		);


		$this->db->select('visitors.*');
		$this->db->where($multiplewhere);
		return $this->db->get('visitors')->num_rows();
	}


	public function insert_visit($data)
	{
		$this->db->insert('visitors', $data);
		return $this->db->affected_rows();
	}
}
