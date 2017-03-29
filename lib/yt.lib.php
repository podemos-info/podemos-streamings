<?php

function get_yt_id($yt_url){
  $res = preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $yt_url, $matches);
  return( $res ? $matches[1] : '' );
} 
 
function get_yt_thumb_url($youtube_id='h44P_nAxAqY', $thumbnail_type=6){
  if($youtube_id){
    $yt_domains = [ 'img.youtube.com',
	            'i.ytimg.com',
		    'i1.ytimg.com',
		    'i2.ytimg.com',
		    'i3.ytimg.com' ];
    $yt_domain = $yt_domains[ rand( 0, max( array_keys( $yt_domains ) ) ) ];
                         # [0-3] Each YouTube video has 4 generated images. They are predictably formatted as follows:
    $thumbnail_types = [ "https://$yt_domain/vi/<insert-youtube-video-id-here>/0.jpg",
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/1.jpg",
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/2.jpg",
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/3.jpg",
			 # [4] The first one in the list is a full size image and others are thumbnail images. The default thumbnail image (ie. one of 1.jpg, 2.jpg, 3.jpg) is:
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/default.jpg",
			 # [5] For the high quality version of the thumbnail use a url similar to this:
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/hqdefault.jpg",
			 # [6] There is also a medium quality version of the thumbnail, using a url similar to the HQ:
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/mqdefault.jpg",
			 # [7] There is also a medium quality version of the thumbnail, using a url similar to the HQ:
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/mqdefault_live.jpg",
			 # [8] For the standard definition version of the thumbnail, use a url similar to this:
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/sddefault.jpg",
			 # [9] For the maximum resolution version of the thumbnail use a url similar to this:
			 "https://$yt_domain/vi/<insert-youtube-video-id-here>/maxresdefault.jpg" ];

    # validate $thumbnail_type
    $thumbnail_type = $thumbnail_type > 0 && $thumbnail_type < count($thumbnail_types) ? $thumbnail_type : 6;
  }
  return( str_replace( '<insert-youtube-video-id-here>', $youtube_id, $thumbnail_types[$thumbnail_type] ) );
}

