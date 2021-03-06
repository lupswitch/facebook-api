<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Facebook extends REST_Controller {

	public function __construct(){
		
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index(){}
	
	
	// Get video details using facebook video id 
	/* 
		Parameter :
			id = facebook video id
			key = access_token generated by devloper account.
	*/
	public function video_get(){
		
		$id = $this->get('id');
		$access_token = $this->get('key');		
		
		if(empty($id)){
			$this->response(array('status' => 'failure', 'message' => 'video id required'),400);
		}elseif(empty($access_token)){
			$this->response(array('status' => 'failure', 'message' => 'Key is required'),400);
		}else{
			$url = 'https://graph.facebook.com/v2.10/'.$id.'?access_token='.$access_token.'&fields=id,title,description,embed_html,source,picture,updated_time';
			$response = json_decode(file_get_contents($url),true);
			$this->response(array('status' => 'success', 'data' => $response),200);
		}
	}
	
	// Get video like count
	/* 
		Parameter :
			id = facebook video id
			key = access_token generated by devloper account.
	*/
	public function like_get(){
		
		$id = $this->get('id');
		$access_token = $this->get('key');
				
		if(empty($id)){
			$this->response(array('status' => 'failure', 'message' => 'video id required'),400);
		}elseif(empty($access_token)){
			$this->response(array('status' => 'failure', 'message' => 'Key is required'),400);
		}else{
			$url = 'https://graph.facebook.com/v2.10/'.$id.'/likes?access_token='.$access_token.'&summary=total_count&limit=1';
			$response = json_decode(file_get_contents($url),true);
			$this->response(array('status' => 'success', 'like_count' => $response['summary']['total_count']),200);
		}
	}
	
	// Get all videos from facebook page
	/*
		Parameter :
			id = facebook page id
			key = access_token generated by devloper account.
	*/
	public function all_video_get(){
		
		$id = $this->get('id');
		$access_token = $this->get('key');
		$limit = (isset($_GET['limit']) ? $_GET['limit'] : '1');
		
		if(empty($id)){
			$this->response(array('status' => 'failure', 'message' => 'page id required'),400);
		}elseif(empty($access_token)){
			$this->response(array('status' => 'failure', 'message' => 'Key is required'),400);
		}else{
			echo $url = 'https://graph.facebook.com/v2.10/'.$id.'/videos?access_token='.$access_token.'&fields=id,title,description,embed_html,source,picture,updated_time&limit='.$limit.'';
			$response = json_decode(file_get_contents($url),true);
			$this->response(array('status' => 'success', 'data' => $response),200);
		}
	}
	
}
?>
