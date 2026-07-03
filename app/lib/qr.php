<?php

function generateQR(string $slug)
{
    if (!is_dir("../qrs")) {
        mkdir("../qrs", 0777, true);
    }

    $file = "../qrs/$slug.svg";

    file_put_contents(
        $file,
        '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200">
            <rect width="200" height="200" fill="black"/>
        </svg>'
    );
}
