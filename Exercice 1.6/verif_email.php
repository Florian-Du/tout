<?php
    if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        $to = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        verif($to , $subject , $message);
        
    }

    function verif($to, $subject, $message) {
        $binaire = 0;
        if (filter_var($to , FILTER_VALIDATE_EMAIL)) {
            $binaire = $binaire + 4;
        }if ($subject =='^[:allnum]{1-180}$') {
            echo "lalalal";
        }
    }
?>