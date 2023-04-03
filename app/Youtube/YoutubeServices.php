<?php

namespace App\Youtube;

use DateInterval;
use Illuminate\Support\Facades\Http;

class YoutubeServices
{
    private $key = null;
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function handleYoutubeVideoDuration($video_url)
    {
        //code embed
        // https://www.youtube.com/embed/j-_WrFxbpnQ
        //recupere id à partir de $video_url

        preg_match('/v=([a-zA-Z0-9_-]+)/', $video_url, $matches);
        $id = $matches[1];

        // appel à l'api de youtube pour recuperer la duree

        $response = Http::get("https://www.googleapis.com/youtube/v3/videos?key={$this->key}&id={$id}&part=contentDetails");
        $duration = json_decode($response)->items[0]->contentDetails->duration;

        // convertir la duree en secondes
        // $duration_in_seconds = strtotime("1970-01-01T{$duration}Z") - strtotime('1970-01-01T00:00:00Z');
        $interval = new DateInterval($duration);

        return $interval->s + $interval->i * 60 + $interval->h * 3600;
    }
}
