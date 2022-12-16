<?php
function sendEmailNotification($to, $toName, $content, $subject="", $attached=array()) {
    include ($_SERVER["DOCUMENT_ROOT"] . "/include/system/email-send.php");
    $message["to"]=$to;
    $message["to_name"]=$toName;
    $message["subject"]=$subject;
    $message["content"]="<html><body>
                <p>
                ".$content."
                </p>
                </body></html>";
    $mail->addAddress($message["to"], $message["to_name"]);
    $mail->Subject = $message["subject"];
    $mail->msgHTML($message["content"]);

    foreach ($attached as $source => $name) {
        $mail->AddAttachment( $source , $name );
    }

    $mail->send();
    $mail->clearAddresses();
}