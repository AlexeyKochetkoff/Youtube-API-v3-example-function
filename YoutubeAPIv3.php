<?php
/*you must setup youtube api to your project*/
require_once 'Google/Client.php';

/*add more definitions if needed, maybe set up predefined values to it*/
class YoutubeVideo {
	public $url="";
	public $channelTitle="";
	public $thumbnail="";
	public $duration="";
	public $title="";
	public $description="";
	public $likes="";
	public $dislikes="";
	public $publishedAt="";
	public $commentCount="";
        public $favoriteCount="";
}

/*samples, replace with yours*/
$id1 = 'eUg6QdKaK8A';
$id2 = 'YETj5AkDC5I';
$id3 = 'xL3HYoLQNtI';
$id4 = 'dp-Py4G1hAg';
$id5 = 'LVZt2bDhOcs';

function video_info($id)
	{		
	$api_key = 'your Youtube API browser key here';
	$channel = json_decode(file_get_contents(
    "https://www.googleapis.com/youtube/v3/videos?id=$id&key=$api_key&part=snippet,contentDetails,statistics,status"));
	//$comments =json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/commentThreads?part=id,snippet,replies&maxResults=100&videoId=$id&key=$api_key"));

	//var_dump($channel);
	//var_dump($comments);

	$videoinf = new YoutubeVideo();
	$videoinf->url = "https://www.youtube.com/watch?v=".$channel->items[0]->id;
	
	$videoinf->channelTitle = $channel->items[0]->snippet->channelTitle;
	$videoinf->thumbnail = $channel->items[0]->snippet->thumbnails->medium->url;
	$videoinf->duration = $channel->items[0]->contentDetails->duration;
	$videoinf->title = $channel->items[0]->snippet->title;
	$videoinf->description = $channel->items[0]->snippet->description;
	$videoinf->likes = $channel->items[0]->statistics->likeCount;
	$videoinf->dislikes = $channel->items[0]->statistics->dislikeCount;
	$videoinf->commentCount = $channel->items[0]->statistics->commentCount;
	$videoinf->favoriteCount = $channel->items[0]->statistics->favoriteCount;
	$videoinf->publishedAt = $channel->items[0]->snippet->publishedAt;

echo "<h1>"."After video id: ".$id." gathered next info:\n"."</h1>";
echo "Picture of the video(default):".'<img src="'.$channel->items[0]->snippet->thumbnails->medium->url.'">'."\n";
echo "<h1>"."channel Title:".$channel->items[0]->snippet->channelTitle."\n"."</h1>";
echo "<h1>"."title of the video:".$channel->items[0]->snippet->title."\n"."</h1>";
        print('<object width="425" height="350" data="http://www.youtube.com/v/'.$id.'" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/" /></object>');

echo "<h1>"."\n"."video URL:"."</h1>"."https://www.youtube.com/watch?v=".$channel->items[0]->id."\n";
//echo "Comments".$comments."\n";
	
	
	echo "<h1>"."duration:"."</h1>".$channel->items[0]->contentDetails->duration."\n";
	
	echo "<h1>"."description:"."</h1>".$channel->items[0]->snippet->description."\n";
	echo "<h1>"."Число лайков: "."</h1>".$channel->items[0]->statistics->likeCount.".\n";
        echo "<h1>"."like Count: "."</h1>".$channel->items[0]->statistics->dislikeCount.".\n";
	echo "<h1>"."comment Count: "."</h1>".$channel->items[0]->statistics->commentCount.".\n";
	echo "<h1>"."favorite Count "."</h1>".$channel->items[0]->statistics->favoriteCount."\n"."</h1>";
	echo "<h1>"."published At "."</h1>".$channel->items[0]->snippet->publishedAt."\n";
	echo "<h1>"."------------------\n<br>"."</h1>";
	return($videoinf);}

video_info($id1);
video_info($id2);
video_info($id3);
video_info($id4);
video_info($id5);

?>
