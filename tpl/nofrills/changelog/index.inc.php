<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title><?= BUG TRACKER ?> changelog</title>
    </head>
    <body>
        <header>
            <h1><?= BUG TRACKING SYSTEM?> changelog</h1>
            <h4>generated at <?= date(BUNZ_BUNZILLA_DATE_FORMAT) ?> | current version: <?= PROJECT ?></h4>
        </header>
<?php
foreach($this->data['versions'] as $ver)
{
    echo "\t\t<h2>version {$ver}</h2>\n\t\t<ul>\n";
    foreach($this->data['messages'] as $msg)
        echo $msg['version'] == $ver ? "\t\t\t<li>{$msg['message']}</li>\n" : '';
    echo "\t\t</ul>\n";
}
?>
        <footer>
            <?= TITLE ?>
            <q><?= BUG TRACKINGMISSION_STATEMENT ?></q>: 
            <a href="<?= PROJECT_ ?>"><?= PROJECT ?></a>
            <address><?= PROJECT, ' ', VERSION ?></address>
        </footer>
    </body>
</html>
