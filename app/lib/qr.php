<?php

function generateQR(string $slug)
{
    if (!is_dir("../qrs")) {
        mkdir("../qrs", 0777, true);
    }

    $file = "../qrs/$slug.svg";

    $api = "https://api.qrserver.com/v1/create-qr-code/?format=svg&size=600x600&data=test";

    $svg = @file_get_contents($api);

    var_dump($svg !== false);

    exit;
}
