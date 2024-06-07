<?php


use App\Lib\ClientInfo;

use App\Models\Answer;
use App\Models\Quizz;
use App\Notify\Notify;


function systemDetails()
{
    $system['name']          = 'changalab';
    $system['version']       = '2.2';
    $system['build_version'] = '4.3.9';
    return $system;
}




function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function calculateQuizScore($quizId)
{
    // Find the quiz
    $quiz = Quizz::find($quizId);

    // Initialize the total score and the count of correct answers
    $correctAnswersCount = 0;

    // Loop through each quiz detail
    foreach ($quiz->quizDetails as $quizDetail) {
        // Check if the user's answer is not null and is correct
        if (!is_null($quizDetail->user_answer) && Answer::find($quizDetail->user_answer)->is_correct) {
            // Increment the count of correct answers
            $correctAnswersCount++;
        }
    }

    // Calculate the percentage of correct answers
    $totalQuestions = $quiz->quizDetails->count();

    // Return the percentage of correct answers
    return ($correctAnswersCount / $totalQuestions) * 100;
}





function siteLogo($type = null)
{
    $template = session('template') ?? gs()->active_template;
    $name = $type ? "/logo_$type.png" : '/logo.png';
    return getImage(getFilePath('logoIcon') . "/$template" . $name);
}

function siteFavicon()
{
    $template = session('template') ?? gs()->active_template;
    return getImage(getFilePath('logoIcon') . "/$template" . '/favicon.png');
}


























function getIpInfo()
{
    $ipInfo = ClientInfo::ipInfo();
    return $ipInfo;
}


function osBrowser()
{
    $osBrowser = ClientInfo::osBrowser();
    return $osBrowser;
}








function notify($user, $templateName, $shortCodes = null, $sendVia = null, $createLog = true)
{
    $general = gs();
    $globalShortCodes = [
        'site_name' => $general->site_name,
        'site_currency' => $general->cur_text,
        'currency_symbol' => $general->cur_sym,
    ];

    if (gettype($user) == 'array') {
        $user = (object) $user;
    }

    $shortCodes = array_merge($shortCodes ?? [], $globalShortCodes);

    $notify = new Notify($sendVia);
    $notify->templateName = $templateName;
    $notify->shortCodes = $shortCodes;
    $notify->user = $user;
    $notify->createLog = $createLog;
    $notify->userColumn = isset($user->id) ? $user->getForeignKey() : 'user_id';
    $notify->send();
}

function getRealIP()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ($ip == '::1') {
        $ip = '127.0.0.1';
    }

    return $ip;
}



function dateSort($a, $b)
{
    return strtotime($a) - strtotime($b);
}






