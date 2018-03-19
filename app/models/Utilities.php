<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends CI_Model{
	public $now;
	public $now_date;
    public $post_table;
    public $page_table;
    public $media_table;
    public $category_table;
    public $post_category_table;
    public $menu_table;
    public $menu_pages_table;
    public $ad_table;
    public $gallery_table;
    public $breakingnews_table;
    public $member_table;

    public $log_table;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Dhaka");
        $this->now = date('Y-m-d H:i:s', time());
        $this->now_date = date('Y-m-d', time());
        
        $this->post_table = "tbl_posts";
        $this->category_table = "tbl_categorys";
        $this->post_category_table = "tbl_post_categorys";
        $this->page_table = "tbl_pages";
        $this->media_table = "tbl_medias";
        $this->news_page_table = "tbl_news_pages";
        $this->news_box_position_table = "tbl_news_box_position";
        $this->menu_table = "tbl_menus";
        $this->menu_pages_table = "tbl_menus_pages";
        $this->ad_table = "tbl_adds";
        $this->gallery_table = "tbl_gallerys";
        $this->breakingnews_table = "tbl_breakings";
        $this->member_table = "tbl_members";

        $this->log_table = "tbl_logs";
	}
	public function getCatLink($catName)
	{
		return base_url()."category/".$catName;
	}

	function eng_to_bng($input) 
    {
        $eng = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','am', 'pm');
        $bang = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', ' রোববার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'পূর্বাহ্ন', 'অপরাহ্ন');
        return str_replace($eng, $bang, $input);
    }

    public function get_has_password($password) {
        $options = array(
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        );
        $hashPass = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hashPass;
    }

	public function pr($arr){
		echo "<pre>";
		print_r($arr);
		exit;
	}

	// start global methods
    public function insert($tableName, $data) {
        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }

    public function update($tableName, $id, $data, $field="id") {
        $this->db->where($field, $id);
        return $this->db->update($tableName, $data);
    }

    public function delete($tableName, $id, $field="id") {
        $this->db->where($field, $id);
        return $this->db->delete($tableName);
    }
    // end global methods 


    public function get_all($tableName, $options=array()) {
        if(isset($options["select"]) && !empty($options["select"])){
            $this->db->select($options["select"]);
        }
        if(isset($options["where"]) && !empty($options["where"])){
            $this->db->where($options["where"]);
        }
        if(isset($options["like"]) && !empty($options["like"])){
            $this->db->like($options["like"]);
        }
        if(isset($options["limit"]) && !empty($options["limit"])){
            $this->db->limit($options["limit"]);
        }
        if(isset($options["order_by"]) && !empty($options["order_by"])){
            $this->db->order_by($options["order_by"]);
        }
        if(isset($options["output"]) && !empty($options["output"])){
            return $this->db->get($tableName)->$options["output"]();
        }else{
            return $this->db->get($tableName)->result();
        }
    }

    
    public function get_all_by_id($tableName,$id) {
        $this->db->where('id', $id);
        $query_result = $this->db->get($tableName);
        return $query_result->result();
    }


    public function get_id_by_slug($table_name, $slug) {
        $this->db->select("id");
        $this->db->where('slug', $slug);
        $query_result = $this->db->get($table_name);
        $result = $query_result->result();
        return empty($result) ? "" : $result[0]->id;
    }

    public function get_slug_by_id($table_name, $id) {
        $this->db->select("slug");
        $this->db->where('id', $id);
        $query_result = $this->db->get($table_name);
        $result = $query_result->result();
        return empty($result) ? "" : $result[0]->slug;
    }

    public function home_box_pages_list()
    {
    	$this->db->select("id,slug");
    	$this->db->where('status', 1);
    	$this->db->where('parent_id', 0);
        $query_result = $this->db->get($this->page_table);
        return $query_result->result();
    }

    public function get_post($category_id, $type="list", $limit=50, $options=array()) // for latest news and most reader news
    {
    	$category_slug = "(select slug from ".$this->category_table." where id=(select category_id from ".$this->post_category_table." where post_id = ".$this->post_table.".id limit 1) ) as category_slug, ";
		$this->db->select("id,title, $category_slug (select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id, created, updated");
		$this->db->from($this->post_table);
		$this->db->join($this->post_category_table, $this->post_category_table.".post_id=".$this->post_table.".id", "inner");
		$this->db->where("category_id", $category_id);
		$this->db->where("status",1);
		if($type=="most_reader")
		{
			$this->db->like("created", $this->now_date);
			$this->db->or_like("updated", $this->now_date);
			$yesterday_date = date( 'Y-m-d', strtotime( $this->now_date . ' -1 day' ) );
			$this->db->or_like("created", $yesterday_date);
			$this->db->order_by("created", "DESC");
			$this->db->order_by("reader_hit", "DESC");
		}
		if($type == "archive")
		{
			$this->db->like("created", $options["date"]);
		}		
		$this->db->order_by("id", "DESC");
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
    }

    public function get_post_details($id) // news details by id
    {
    	$category_slug = "(select slug from ".$this->category_table." where id=(select category_id from ".$this->post_category_table." where post_id = ".$this->post_table.".id limit 1) ) as category_slug, ";
		$this->db->select("id, title, tag, content, ".$category_slug." (select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id, created, updated");
		$this->db->from($this->post_table);
		$this->db->where("status",1);
		$this->db->where("id",$id);
		$query = $this->db->get();
		return $query->row();
    }

    public function get_related_news($news_id, $tags) // related news list in details page
    {
    	$page_slug = "(select slug from ".$this->page_table." where id=(select page_id from ".$this->news_page_table." where news_id = ".$this->news_table.".id limit 1) ) as page_slug, ";
		$this->db->select("id, title, sub_title, title_color, sub_title_color, tag, reporter, news, ".$page_slug." (select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id, created, updated");
		$this->db->from($this->news_table);
		$this->db->where("status",1);
		//$this->db->where("id <>", $news_id);
		if(!empty($tags))
		{
			foreach($tags as $key=>$tag)
			{
				$key==0 ? $this->db->like("tag",$tag) : $this->db->or_like("tag",$tag);
			}
		}
		$this->db->limit(8);
		$this->db->having("id <>", $news_id);
			
		$query = $this->db->get();
		return $query->result_array();
    }

    public function make_text($string)
    {
    	return trim(strip_tags(html_entity_decode($string)));
    }

	public function home_lead_data() // for home page lead
	{
		// $this->load->dbutil();
		//$this->db->cache_on();
		$page_slug = "(select slug from ".$this->page_table." where id=(select page_id from ".$this->news_page_table." where news_id = ".$this->news_table.".id limit 1) ) as page_slug, ";
		$this->db->select("id,title,sub_title,home_position,title_color,sub_title_color,news, tag, ".$page_slug." (select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id, created, updated");
		$this->db->from($this->news_table);
		$this->db->where("status",1);
		$this->db->where_in("home_position",array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','100'));
		$this->db->order_by("home_position", "ASC");
		$this->db->order_by("id", "DESC");
		$this->db->limit(16);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;

		$data = array();
		foreach($query->result_array() as $row){
			if($row['home_position']<=3 )$word_limit=18;			
			else $word_limit=12;			
			$news_data= implode(' ', array_slice(explode(' ', $this->make_text($row['news'])), 0, $word_limit));
			$row["news"] = $news_data;
			$data[] = $row;
		}
		//$this->pr($data); exit;
		return $data;
	}

	public function category_data($page_id, $limit=13, $type="inner_page", $more=array()){ // for category page or news list by page id
		//$this->db->cache_on();
		$this->db->select($this->news_table.".id,".$this->news_table.".title, sub_title, home_position, title_color,sub_title_color,news, tag, (select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id, ".$this->news_table.".created, ".$this->news_table.".updated");
		$this->db->from($this->news_table);
		$this->db->join($this->news_page_table, $this->news_page_table.".news_id=".$this->news_table.".id","inner");
		$this->db->where($this->news_table.".status",1);
		$this->db->where($this->news_page_table.".page_id",$page_id);
		if($type=="inner_page"){
			$this->db->order_by($this->news_table.".inner_lead", "DESC");
			$this->db->order_by($this->news_table.".updated", "DESC");
		}
		$this->db->order_by($this->news_table.".id", "DESC");
		if(!empty($more)){
			if(isset($more["limit"]))
			$this->db->limit($more["limit"], $more["start"]);
		}else{
			$this->db->limit($limit);
		}

		$query = $this->db->get();
		$data = array();
		foreach($query->result_array() as $row){
			$word_limit=30;			
			$news_data= implode(' ', array_slice(explode(' ', $this->make_text($row['news'])), 0, $word_limit));
			$row["news"] = $news_data;
			$data[] = $row;
		}
		//$this->pr($data); exit;
		return $data;
	}

	public function home_category_data($page_id, $page_slug, $limit=6){ // home page category box news
		//$this->db->cache_on();
		$this->db->select("position,".$this->news_table.".id,".$this->news_table.".title, sub_title, home_position, title_color,sub_title_color,news, tag, (select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id, ".$this->news_table.".created, ".$this->news_table.".updated");
		$this->db->from($this->news_table);
		$this->db->join($this->news_box_position_table,$this->news_box_position_table.".news_id=".$this->news_table.".id","inner");
		$this->db->where_in("position", array('1','2','3','4','5','6'));
		$this->db->where("home_box",1);
		$this->db->where("page_id", $page_id);
		$this->db->where("status",1);
		$this->db->order_by("position","ASC");
		$this->db->order_by("updated","DESC");
		$this->db->limit($limit);
		$query = $this->db->get();
		
		$data = array();
		foreach($query->result_array() as $row){
			$word_limit=30;			
			$news_data= implode(' ', array_slice(explode(' ', $this->make_text($row['news'])), 0, $word_limit));
			$row["news"] = $news_data;
			$row["page_slug"] = $page_slug;
			$data[] = $row;
		}
		//$this->pr($data); exit;
		return $data;
	}

	public function gallery_list($type="image", $limit=10)
	{	
		//$this->db->cache_on();
		$this->db->select("title, permalink, video_id, (select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id");
		$this->db->from($this->gallery_table);
		$this->db->where("status",1);
		$this->db->where("gallery_type", $type);
		$this->db->order_by("order_id",'ASC');
		$this->db->order_by("id",'DESC');
		$this->db->limit($limit);
		$query = $this->db->get();		
		return $query->result_array();
	//$db->close();
	}

	public function get_advertisement($page)
	{		
		$this->db->select("google_code,permalink,position,add_type,(select media_type from ".$this->media_table." where id=media_id ) as media_type, (select image from ".$this->media_table." where id=media_id ) as image, media_id");
		$this->db->from($this->ad_table);
		$this->db->where("add_page",$page);
		$this->db->where("status",1);
		$this->db->order_by("position","ASC");
		$query = $this->db->get();

		$ad = array();
		foreach($query->result_array() as $row){
			$ad[$row['position']] = array(
				"google_code" 	=> $row["google_code"],
				"permalink" 	=> $row["permalink"],
				"image" 		=> $row["image"],
				"add_type" 		=> $row["add_type"],
				"media_type" 		=> $row["media_type"],
				"media_id" 		=> $row["media_id"]
			);
		}
		return $ad;		
	}

	public function get_breaking_news()
	{
		$page_slug = "(select slug from ".$this->page_table." where id=(select page_id from ".$this->news_page_table." where news_id = ".$this->news_table.".id limit 1) ) as page_slug ";
		$this->db->select("id,title,$page_slug");
		$this->db->from($this->news_table);
		$this->db->where("shironam",1);
		$this->db->where("status",1);
		$this->db->order_by("id","DESC");
		$this->db->limit(15);
		$query = $this->db->get();
		$data["shironam"] = $query->result_array();

		$page_slug = "(select slug from ".$this->page_table." where id=(select page_id from ".$this->news_page_table." where ".$this->news_page_table.".news_id = ".$this->breakingnews_table.".news_id limit 1) ) as page_slug ";
		$this->db->select("news_id,title,$page_slug");
		$this->db->from($this->breakingnews_table);
		$this->db->where("status",1);
		$this->db->order_by("id","DESC");
		$this->db->limit(10);
		$query = $this->db->get();
		$data["breaking"] = $query->result_array();

		return $data;
	}

	// visitor count
	public function add_browse_info($page, $ip="", $address="", $news_id="")
	{
		$this->db->where("page_name", $page);
		if($ip != "")
		$this->db->where("ip_address", $ip);
		if($news_id != "")
		$this->db->where("news_id", $news_id);
		$this->db->where("visit_date", $this->now_date);
		$query = $this->db->get($this->log_table);
		$num_rows = $query->num_rows();

		$this->db->trans_start();
		if($num_rows>0){
			$data = $query->row();
			$visit_no = $data->visit_no + 1;
			$this->db->where("page_name", $page);
			if($ip != "")
			$this->db->where("ip_address", $ip);
			if($news_id != "")
			$this->db->where("news_id", $news_id);
			$this->db->where("visit_date", $this->now_date);
			$this->db->update($this->log_table, array("visit_no"=>$visit_no,"updated"=>$this->now,"device"=>$_SERVER["HTTP_USER_AGENT"]));
		}else{
			$data["page_name"] = $page;
			$data["ip_address"] = $ip;
			$data["address"] = $address;
			$data["news_id"] = $news_id;
			$data["visit_no"] = 1;
			$data["device"] = $_SERVER["HTTP_USER_AGENT"];
			$data["visit_date"] = $this->now_date;
			$data["created"] = $this->now;
			$this->db->insert($this->log_table, $data);
		}

		if($page == "details" && $news_id != "")
		{
			$this->db->query("update ".$this->news_table." set reader_hit=reader_hit+1 where id=".$news_id);
		}

		$this->db->trans_complete();

		return $this->db->trans_status();

	}

}