<?php 
namespace Instagram;

// use Instagram\Model;

/**
* 
*/
class Main
{
	private $accessToken;
	private $mediaCount = 8;

	public $pagination;
	public $data;
	public $error;

	function __construct($accessToken)
	{
		$this->accessToken = $accessToken;
	}

	public function getRecentPost()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.instagram.com/v1/users/self/media/recent?access_token=".$this->accessToken."&count=".$this->mediaCount,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Cache-Control: no-cache",
		    "Postman-Token: da2f603f-5802-4ce2-a1cf-130bb07392dc"
		  ),
		));
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, CURLAUTH_BASIC );
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  $this->error = "An error occureed, " . $err;

		  return false;
		} else {
		  $responseIG = json_decode($response);

		  $this->pagination = $responseIG->pagination;
		  $this->data = $responseIG->data;

		  return true;
		}
	} 

	public function setLimit($limit =  false){
		if($limit){
			$this->mediaCount = $limit;
		}
	}

}

?>