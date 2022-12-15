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
}