<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
//session_start();
class Fbpost {
    private $fbObject;
	function __construct() {
		$dir = dirname(__FILE__);
		//echo $dir; exit;
		if(DEV_MODE===FALSE){
			//require_once str_replace('/application/libraries','',__DIR__) . '/facebook-sdk/autoload.php';
			require_once str_replace('/application/libraries','',$dir) . '/facebook-sdk/autoload.php';
			$this->fbObject = new Facebook\Facebook([
			  'app_id' => '208244456221262',
			  'app_secret' => '63a468fa57f6b719c6fdcb58e43d065b',
			  'default_graph_version' => 'v2.5', // v2.4
			]);
		}
    }
	
	public function fblogin(){
		$fb = $this->fbObject;
		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email','publish_actions','publish_pages','manage_pages']; // Optional permissions
		$loginUrl = $helper->getLoginUrl(base_url().'index.php/login/fbcallback', $permissions);

		echo '<h1 style="padding:20% 0; text-align:center;"><a href="' . htmlspecialchars($loginUrl) . '">Please Log in with Facebook as a projonmonews admisistrator!</a></h1>';
	}
	
	public function fbcallback(){
		$fb = $this->fbObject;

		$helper = $fb->getRedirectLoginHelper(); 
		
		//echo "<pre>";
		//print_r($helper);exit;
		
		try {  
			$accessToken = $helper->getAccessToken();  
		} catch(Facebook\Exceptions\FacebookResponseException $e) {  
			// When Graph returns an error  
			echo 'Graph returned an error: ' . $e->getMessage();  
			exit;  
		} catch(Facebook\Exceptions\FacebookSDKException $e) {  
			// When validation fails or other local issues  
			echo 'Facebook SDK returned an error: ' . $e->getMessage();  
			exit;  
		}  

		if (! isset($accessToken)) {  
			if ($helper->getError()) {  
				header('HTTP/1.0 401 Unauthorized');  
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			} else {  
				header('HTTP/1.0 400 Bad Request');  
				echo 'Bad request';  
			}  
			exit;  
		} 

		
		// development
		$fb->setDefaultAccessToken($accessToken);
		try {
		  //$response = $fb->get('/829408803845124');
		  $response = $fb->get('/me?fields=accounts');
		  $userNode = $response->getGraphUser();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		echo "<pre>";
		print_r($response);
		print_r($response->getBody());
		print_r($response->getDecodedBody()); exit;
		$responsBody = $response->getDecodedBody();
		//print_r($responsBody['accounts']["data"][0]);
		$newsAccessToken = $responsBody['accounts']["data"][0]['access_token'];
	
		
		
		
		//exit;
		
		
	/*
		
		// Logged in 
		
		//echo '<h3>Access Token</h3>';
		//	echo $accessToken->getValue();
		//var_dump($accessToken->getValue());  

		// The OAuth 2.0 client handler helps us manage access tokens  
		$oAuth2Client = $fb->getOAuth2Client();  

		// Get the access token metadata from /debug_token  
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);  
		//echo '<h3>Metadata</h3>';  
		//var_dump($tokenMetadata);  

		// Validation (these will throw FacebookSDKException's when they fail)  
		//$tokenMetadata->validateAppId($config['app_id']);  
		$tokenMetadata->validateAppId('1091943457506393');  
		// If you know the user ID this access token belongs to, you can validate it here  
		// $tokenMetadata->validateUserId('123');  
		$tokenMetadata->validateExpiration();   

		if (! $accessToken->isLongLived()) {  
			// Exchanges a short-lived access token for a long-lived one  
			try {  
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);  
			} catch (Facebook\Exceptions\FacebookSDKException $e) {  
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>";  
				exit;  
			} 
			//echo '<h3>Long-lived</h3>';  
			//var_dump($accessToken->getValue());  
		}
		*/

		//$_SESSION['fb_access_token'] = (string) $accessToken; 
		$CI =& get_instance();
		//$CI->session->set_userdata(array('fb_access_token'=>$accessToken->getValue()));		
		$CI->session->set_userdata(array('fb_access_token'=>$newsAccessToken));		 // news
		
		// updating access token
		$CI->db->where('type', 'fb_access_token');
        $CI->db->update('settings', array('description'=>$newsAccessToken));		

		
		redirect('news_post','refresh');
		
		// User is logged in with a long-lived access token.  
		// You can redirect them to a members-only page.  
		// header('Location: https://example.com/members.php');
	}
	
	public function post($data=array())
    {
		$CI =& get_instance();
		$fb = $this->fbObject;
		if(!empty($data)){
			$linkData = [
			  'link' => $data['link'],
			  'message' => $data['message'],
			  'picture' => $data['picture']
			];
		}else{
			$linkData = [
			  'link' => 'http://projonmo.news/',
			  'message' => 'Welcome To Projonmonews',
			  'picture' => 'http://projonmo.news/images/logo.png'
			];
		}

		  
		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->post('/829408803845124/feed', $linkData, $CI->session->userdata('fb_access_token'));
		  //$response = $fb->post('/829408803845124/feed', $linkData, "CAAHKOhedJn0BAPiMBChDj1qLgWUOHvBTtIMqAZCPZAE6X7EZC43ssE5bPaASKzUMlaw3SQejInVSxysgu7fASQWaOAmSD7erbFCwMZBTb7Yi74weAbDraz4K7R5YSVm87FeOrwtz4Bfwna0P1Teiw2ZCDAQmsEzaWL7uAGXw2NlXEvjvf92tmekSpEredZCM8wFkuOnmdLZBwZDZD");
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  //exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  //exit;
		}
		//print_r($linkData);
    }

}

/* End of file Fbpost.php */