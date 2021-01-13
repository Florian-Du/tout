<?php

    echo "florian";
    $message = message("wesh bien ou quoi ?");
    echo $message;

    function message($message) :string {
        return "florian a dit ".$message;
    }