<?php
    // Composerでインストールしたライブラリを一括読み込み
    require_once __DIR__ . '/vendor/autoload.php';

    // アクセストークンを使いCurlHTTPClientをインスタンス化
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('Q7MRWn2e8qYk9eDYc93B82E8MiNtiI9PS61wPxAAJajbzdaqgSC4yMOwuKgb1i6AerTo7BGUW/bic+KoTXRrTfctspHWrph8d5eWO4BKNYhNeO64NyrcHvjwWaBgbbVWLZ70a6MAS6QQyZLrlxkEtwdB04t89/1O/w1cDnyilFU=');

    //CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '8b9ad7685804618e91f86a10fd368d71']);

    // LINE Messaging APIがリクエストに付与した署名を取得
    $signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

    //署名をチェックし、正当であればリクエストをパースし配列へ、不正であれば例外処理
    $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);

    foreach ($events as $event) {
        // メッセージを返信
        $response = $bot->replyMessage(
            $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->getText())  
        );
    }