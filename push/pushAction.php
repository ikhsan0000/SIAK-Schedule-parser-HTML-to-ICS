<?php
require __DIR__ . '/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

$payload = 'Test Payload';
//subscribtion masih hardcoded
$sub_json = '{"endpoint":"https://fcm.googleapis.com/fcm/send/cyntsSOKRLg:APA91bE8NKABOP8XQWYrT2LESv3EagAiBRiAqDexYUfqtD4Jj2TLctZAzZoaVljVq9EeaXYFP-7uPgpAxMrl2Om4SIFM1T1BeMDWUnWCB3xeHTjk5__6QMll82DkplNV3Uz1-YZm6iLN","expirationTime":null,"keys":{"p256dh":"BH0r_rOSXneAQ0RgYuV1ZHS998qpLqsBj63ZTmJypfbM3ywnuHfoMzHYVD8hysqdqHWqXg9Dc0oFVPz-Q5WsCn8","auth":"gXl52B1TYPB5pQ1bGzxcCw"}}';
$subscription = Subscription::create(json_decode($sub_json,true));

$auth = [
    'VAPID' => [
        'subject' => 'mailto:scheduie@ui.ac.id', // can be a mailto: or your website address
        'publicKey' => 'BAbYNfFpKahAqgknAeLfokoC2g2lwYBz9mraqhr4JN--zwFYC2jYZ6Fq7v0LFEvGOLyDan-aYr9gZBSdgdlN1Cg', // (recommended) uncompressed public key P-256 encoded in Base64-URL
        'privateKey' => 'S9CO1QHicojnUp5t5cJfyWyiHc_xYnKKvdM3d5zQB6U', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
    ],
];

$webPush = new WebPush($auth);
$res = $webPush->sendOneNotification($subscription, $payload, ['TTL' => 5000]);

?>
