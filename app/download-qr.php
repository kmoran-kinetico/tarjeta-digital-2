<?php
$slug = $_GET['slug'] ?? '';

if ($slug === '') {
    http_response_code(400);
    exit('Slug no válido');
}

$file = __DIR__ . "/qrs/$slug.svg";

if (!file_exists($file)) {
    http_response_code(404);
    exit('QR no encontrado');
}

header('Content-Type: image/svg+xml');
header('Content-Disposition: attachment; filename="'.$slug.'.svg"');
header('Content-Length: ' . filesize($file));

readfile($file);
exit;
``