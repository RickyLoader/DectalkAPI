<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/say/{tts}',function(Request $request, Response $response){
    $tts = $request->getAttribute('tts');
    $command = "say.exe -w tts.wav "."\"[:phoneme on]\" "."\"".$tts."\"";
    shell_exec("cd ../dectalk-software && ".$command);
    $file = "../dectalk-software/tts.wav";
    downloadFile($file);
});

function downloadFile($file){
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"".basename($file)."\""); 
    readfile($file);
    unlink($file);
}