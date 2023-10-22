<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title><?= BUG TRACKING SYSTEM, ': ', BUG ?></title>
    </head>
    <body>
        <header>
            <h1><?= BUG TRACKER ?> version <?= BUG TRACKING SYSTEM?></h1>
            <h2><?= PROJECT ?></h2>
            <h3><?=MISSION_STATEMENT ?></h3>
        </header>
        <main>
            <h4>Category Listing</h4>
<?php
if(empty($this->data['categories']))
{
?>
            <p>No categories have been created yet. <a href="<?= HTTP_DIR ?>cpanel">Go to the control panel and make one</a>.</p>
<?php
} else {
    echo "\t\t\t<ol>\n";

    foreach($this->data['categories'] as $cat)
    {
/**
 * other available variables in $this->data
   ['category' => 'color' => a 6 digit hex for colors
                  'icon'  => a className for webfont icons
    'stats'    => 'total_issues' => number of reports in category
                  'unique_posters' => number of unique emails in category
                  'last_activity' => latest time a report was touched in cat.
                  'open_issues' => number of open reports in category
**/
?>
                <li>
                    <a href="<?= 
BUNZ_HTTP_DIR ?>report/category/<?= $cat['id'] ?>"><?= $cat['title'] ?></a>
                    <p><?= $cat['caption'] ?></p>
                </li>
<?php
    }
    echo "\t\t\t</ol>\n";
}
?>
        </main>
    </body>
</html>
