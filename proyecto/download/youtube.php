<?php


Class Downloader {


    public function getYouTubeCode($url) {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $vars );
        return $vars['v'];
    }

    public function processVideo($vid) {
        parse_str(file_get_contents("https://youtube.com/get_video_info?video_id=".$vid),$info);


        $playabilityJson = json_decode($info['player_response']);
        $formats = $playabilityJson->streamingData->formats;
        $adaptiveFormats = $playabilityJson->streamingData->adaptiveFormats;

        //Checking playable or not
        $IsPlayable = $playabilityJson->playabilityStatus->status;

        //writing to log file
        if(strtolower($IsPlayable) != 'ok') {
            $log = date("c")." ".$info['player_response']."\n";
            file_put_contents('./video.log', $log, FILE_APPEND);
        }

        $result = array();

        if(!empty($info) && $info['status'] == 'ok' && strtolower($IsPlayable) == 'ok') {
            $i=0;
            foreach($adaptiveFormats as $stream) {

                $videoURL = $stream->url;
                $type = explode(";", $stream->mimeType);

                $quality='';
                if(!empty($stream->quality)) {
                    $quality = $stream->quality;
                }

                $OpcionesVideo[$i]['link'] = $videoURL;
                $OpcionesVideo[$i]['type'] = $type[0];
                $OpcionesVideo[$i]['quality'] = $quality;
                $i++;
            }
            $j=0;
            foreach($formats as $stream) {

                $videoURL = $stream->url;
                $type = explode(";", $stream->mimeType);

                $quality='';
                if(!empty($stream->quality)) {
                    $quality = $stream->quality;
                }

                $OpcionesVideoOrg[$j]['link'] = $videoURL;
                $OpcionesVideoOrg[$j]['type'] = $type[0];
                $OpcionesVideoOrg[$j]['quality'] = $quality;
                $j++;
            }
            //aqui basicamente le decimos que en info tiene que mostrar el titulo del video, en adaptative formats, son las opciones en
            //que se puede descargar el video y por ultimo pero no menos importante, en formats, nos uestra las opcuines de calidad de descarga
            $result['videos'] = array(
                'info'=>$info,
                'adapativeFormats'=>$OpcionesVideo,
                'formats'=>$OpcionesVideoOrg
            );
            
            
            return $result;
        }
        else {
            return;
        }
    }

}