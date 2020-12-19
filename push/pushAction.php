<?php
require __DIR__ . '/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

$payload = 'Tanggal Cuti Bersama Direvisi!';
//subscribtion masih hardcoded

//Multiple Endpoints
$endpoint_1 = '{"endpoint":"https://fcm.googleapis.com/fcm/send/eNdGm-uxrs0:APA91bFzU7-0XWEPVDWlwpRa9ucCx7L3nqw03ZGYmuGeUwcqSz2E2JHTLomjuNsNblVCPfLq9xk7uvfCBIpqyOsMnrIWgoNdGEgLgArGNERX94mH1bdxVOsCqZv9PxrMq7b3A1fGigOX","expirationTime":null,"keys":{"p256dh":"BEFggd33kdauoJcKfjdovPym2T2WH5vXa44rHGCo938yFLuLTIy27CvgDL7si9ZptlFNKLIYBwRIV0TEL_erOEk","auth":"92n-4JqXuEIo7jotdupCiw"}}';
$endpoint_2 = '{"endpoint":"https://updates.push.services.mozilla.com/wpush/v2/gAAAAABf2GWMMLD9VFZ15BlE80ZWWOGBWrv5Uipg2RwCxtuzQUq1zR6Gy3_O_z_jay3vS9yTnmmbrsZ9HM4QUshGYns7fyyH4hVHe3RH5BnD_Z3RdvQ-PkjErkE-r8M6mfI_U6FmiWOn5RUSsh32lS8BnLsoq39bS-P51vRQ_TuRXuWwOoxd08g","keys":{"auth":"f2boP5GUcDcglBfKvH4PcQ","p256dh":"BA9oq5USTdOxTKt-qopTjaX2AKIyRsbNfs19C0fDX5VTb4pFp9sbrM_reJkogpYWh9CS4cxt1BPS16yb8E4BUgo"}}';
$endpoint_3 = '{"endpoint":"https://fcm.googleapis.com/fcm/send/daF-ub1UopU:APA91bHaeCKlqS3e1poyTj76Ms_wv5mMzivDrl2jWY9b8aiJvjSnMKXTxuSdhD1bGEoj2QtJ3PVw2wJDDKMtB_IReFdj8awjV_2lEK9r1UTyLP5mQJ9X49Yi_eet_OZbwBO1EWxOXeLz","expirationTime":null,"keys":{"p256dh":"BMs3Focb3gn4TLIGxhMkHslnj3oArZpLn53EL0EHfD7aTVbRxzTrKQOXm6ITqAsxkOYe06ynvj13vp9C7PZ0u0c","auth":"tQ8QecQ-F21zW6_FFbyk2w"}}';

// Satu Endpoint
// $subscription = Subscription::create(json_decode($endpoint_1,true));

$subscriptions = [
    Subscription::create(json_decode($endpoint_1,true)),
    Subscription::create(json_decode($endpoint_2,true)),
    Subscription::create(json_decode($endpoint_3,true))
];

$auth = [
    'VAPID' => [
        'subject' => 'mailto:scheduie@ui.ac.id', // can be a mailto: or your website address
        'publicKey' => 'BAbYNfFpKahAqgknAeLfokoC2g2lwYBz9mraqhr4JN--zwFYC2jYZ6Fq7v0LFEvGOLyDan-aYr9gZBSdgdlN1Cg', // (recommended) uncompressed public key P-256 encoded in Base64-URL
        'privateKey' => 'S9CO1QHicojnUp5t5cJfyWyiHc_xYnKKvdM3d5zQB6U', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
    ],
];

$webPush = new WebPush($auth);

// Send to one Endpoint
// $res = $webPush->sendOneNotification($subscription, $payload, ['TTL' => 5000]);

//Send to multiple Endpoints
foreach ($subscriptions as $sub)
{
    $res = $webPush->queueNotification($sub, $payload, ['TTL' => 5000]);

}

foreach ($webPush->flush() as $report) {
    $endpoint = $report->getRequest()->getUri()->__toString();

    if ($report->isSuccess()) {
        echo "[v] Message sent successfully for subscription {$endpoint}. <br>";
    } else {
        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
    }
}

?>
<!-- <script>window.location.replace("push.html");</script> -->
