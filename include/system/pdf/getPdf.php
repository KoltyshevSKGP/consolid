<?php
$json = file_get_contents("php://input");

if (isset($_POST['url'])) {

    $link = $_POST['url'];
    $to = $_SERVER['DOCUMENT_ROOT'] . "/pdf/"  . "test.pdf";
    $command = "google-chrome --headless --disable-gpu --run-all-compositor-stages-before-draw --print-to-pdf-no-header --print-to-pdf='$to' $link" ;
    shell_exec ($command);

    $result['pdf_url'] = $_SERVER['SERVER_NAME'] . "/pdf/"  . "test.pdf" ;
    echo json_encode($result);

}

else {


    $data = json_decode($json, true);

    $link = $data['source'];
    $to = $_SERVER['DOCUMENT_ROOT'] . "/pdf/"  . "output.pdf";
    $command = "google-chrome --headless --disable-gpu --run-all-compositor-stages-before-draw --print-to-pdf-no-header --print-to-pdf='$to' $link" ;
    shell_exec ($command);

    $content = file_get_contents($to);
    header('Content-Type: application/pdf');
    header('Content-Length: '.strlen( $content ));
    header('Content-disposition: inline; filename="' .  "test" . '"');
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    echo $content;
}




