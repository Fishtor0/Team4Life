<?php

$myArticle = fopen('../articles/newArticle.txt', 'r') or die('Unable to open article');

echo fread($myArticle, filesize('../articles/newArticle.txt'));
fclose($myArticle);
?>