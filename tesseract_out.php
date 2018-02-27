<?php
    require_once("TesseractOCR.php");

    function imagetotext($image) {
        $text = (new TesseractOCR($image))
            ->lang('eng', 'jpn', 'spa')
            ->run();
        return $text;
    }
?>
