<?php

namespace App\Service;

class VideoHandler {

	/**
	 * Given a vimeo or youtube URL get the oembed info
	 *
	 * @param string $video_url
	 *
	 * @return null|\stdClass property html has the emebed iframe code or similar
	 */
	public function getVideoInfo( $video_url ) {

		$oembed = 'https://www.youtube.com/oembed';

		if (preg_match( '|^http(s)?://(.*?)vimeo.com|', $video_url )) {
			$oembed = 'https://vimeo.com/api/oembed.json';
		}

		$oembed .= '?format=json&url=' . urlencode( $video_url );

		$json_string = @file_get_contents( $oembed );

		/**
		 * @var null|\stdClass
		 */
		$obj = json_decode( $json_string );

		if ($obj == null || !$obj) {
			return null;
		}
		return $obj;
	}

	public static function getYoutubeDuration($video_id){
		$url = 'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key=AIzaSyArQjtprkPQ_VBWkJneqepUPoYs7tfpoNA&part=snippet,contentDetails';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        //print_t($response_a); if you want to get all video details
        return  $response_a->items[0]->contentDetails->duration; //get video duaration
	}

	public static function vimeoVideoDuration($vimeoId) {
        $authorization = 'ff91f902c53f1c3a7a711840a8ece0fa';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vimeo.com/videos/{$vimeoId}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer {$authorization}",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if (empty($err)) {
            $info = json_decode($response);
            if(isset($info->duration)){
                return gmdate("i:s", $info->duration);
            }
        }
        return false;
    }

	public static function getVimeoVideoDuration($video_url) {

		$video_id = (int)substr(parse_url($video_url, PHP_URL_PATH), 1);
	 
		$json_url = 'http://vimeo.com/api/v2/video/' . $video_id . '.xml';
	 
		$ch = curl_init($json_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		$data = new SimpleXmlElement($data, LIBXML_NOCDATA);
	 
		if (!isset($data->video->duration)) {
			return null;
		}
	 
		$duration = $data->video->duration;
	 
		return $duration; // in seconds
	 }

	public static function covtime($yt){
		$yt=str_replace(['P','T'],'',$yt);
		foreach(['D','H','M','S'] as $a){
			$pos=strpos($yt,$a);
			if($pos!==false) ${$a}=substr($yt,0,$pos); else { ${$a}=0; continue; }
			$yt=substr($yt,$pos+1);
		}
		if($D>0){
			$M=str_pad($M,2,'0',STR_PAD_LEFT);
			$S=str_pad($S,2,'0',STR_PAD_LEFT);
			return ($H+(24*$D)).":$M:$S"; // add days to hours
		} elseif($H>0){
			$M=str_pad($M,2,'0',STR_PAD_LEFT);
			$S=str_pad($S,2,'0',STR_PAD_LEFT);
			return "$H:$M:$S";
		} else {
			$S=str_pad($S,2,'0',STR_PAD_LEFT);
			return "$M:$S";
		}
	}

	public static function getVideoThumbnail($video_url){
		try {
			if (preg_match('|^http(s)?://(.*?)vimeo.com|', $video_url)) {
				$provider = 'vimeo';
				$video_url_params = parse_url($video_url);
				$video_id = str_replace('/', '', $video_url_params['path']);
			} else {
				$provider = 'youtube';
				$video_url_params = parse_url($video_url);
				parse_str($video_url_params['query'], $params);
				$video_id = $params['v'];
			}
			
			if($provider == 'youtube'){
				$video_thumbnail = "https://img.youtube.com/vi/".$video_id."/hqdefault.jpg";
				return $video_thumbnail;
			}else if($provider == 'vimeo'){
				$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$video_id.".php"));
				return $hash[0]['thumbnail_large'];
			}
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	public static function getLocalVideoThumbnail($seconds , $video_path, $thumbnail){
		$ffmpeg = \FFMpeg\FFMpeg::create();
		$video = $ffmpeg->open($movie);
		$frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($sec));
		return $frame->save($thumbnail);
	}
}