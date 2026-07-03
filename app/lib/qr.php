function generateQR(string $slug)
{
    if (!is_dir("../qrs")) {
        mkdir("../qrs", 0777, true);
    }

    file_put_contents("../qrs/test.txt", "funciona");

    return;
}
