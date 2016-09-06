<?php
    $to = "good.deal.thanks@gmail.com";
    $subject = "Контактная форма";
    $txt = "Имя: " . $_POST["name"] . " \n" .  "Телефон: " . $_POST["phone"] . " \n" .  "Сообщение: " . $_POST["message"] ;

    mail($to,$subject,$txt);
?>