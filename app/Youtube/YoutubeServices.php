<?php

namespace App\Youtube;

use Illuminate\Support\Facades\Http;

class YoutubeServices {

private $key = null;

public function __construct($key)
{
    $this->key = $key;
}
public function handleYoutubeVideoDuration($video_url){
    //code embed
    // https://www.youtube.com/embed/j-_WrFxbpnQ
//recupere id à partir de $video_url



//preg_match('/embed\/(.+)/',$video_url,$matches );
preg_match('/v=([a-zA-Z0-9_-]+)/', $video_url, $matches);
//dd($video_url,$matches);


 // appel à l'api de youtube pour recuperer la duree

    $response = Http::get('https://www.googleapis.com/youtube/v3/videos?key=AIzaSyDzA_w7U_77ZBny9ZwrkCFrivhA3ePEz8c&id=j-_WrFxbpnQ&t=6s&part=contentDetails');
//$duration = $response->json()['items'][0]->contentDetails->duration;
// recupere duration
$decoded = json_decode($response);
dd($decoded->items[0]->contentDetails->duration);


// recupere l'id à partir de $video_url




// appel à l'api de youtubr pour recuperer la duree

// converir la duree en secondes

}


}
