<?php

function generateQR(string $slug)
{
    if (!is_dir("../qrs")) {
        mkdir("../qrs", 0777, true);
    }

    $url = "https://glowing-space-garbanzo-wvv9769rwx7gcg64r-8000.app.github.dev/app/contacto/?slug=" . $slug;

    $file = "../qrs/$slug.svg";

    if (file_exists($file)) {
        return;
    }

    $api = "https://api.qrserver.com/v1/create-qr-code/?format=svg&size=600x600&data=" . urlencode($url);

    $svg = file_get_contents($api);

    if ($svg !== false) {
        file_put_contents($file, $svg);
    }
}