<?php

function generateQR(string $slug)
{
    if (!is_dir("../qrs")) {
        mkdir("../qrs", 0777, true);
    }

    $url = "/app/contacto/?slug=" . $slug;

    $file = "../qrs/$slug.svg";

    $api = "https://api.qrserver.com/v1/create-qr-code/?format=svg&size=600x600&data=" . urlencode($url);

    $ch = curl_init($api);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $svg = curl_exec($ch);

    curl_close($ch);

    if ($svg) {
        file_put_contents($file, $svg);
    }
}
