<?php
//
// index page : category listing and project overview
//
require BUNZ_TPL_DIR . 'header.inc.php';

//
// About the project (title, version, mission statement...)
// Configure these in res/settings.ini
//
?>
<div class="row">
    <article class="col s12 m6">
        <header class="section no-pad-bot">
            <section class="section primary-base z-depth-5 waves-effect tooltipped"
                     data-tooltip="Go to project website: <?= PROJECT ?>"
                     onclick="(function(evt){ if(!(evt.target instanceof HTMLAnchorElement)){ window.location='<?= PROJECT ?>'; }})(event);">
                <h1><?= BUG TRACKING SYSTEM ?></h1>
                <h6><em><?= PROJECT, ' v', VERSION ?></em></h6>
            </section>
        </header>
        <section class="section row no-pad-top">
            <p class="z-depth-5 col s4 section primary-lighten-3">version <?= VERSION ?></p>
            <p class="z-depth-5 col s8 section primary-text right-align tooltipped" 
               data-tooltip="mission statement"><em><?= BUG FINDING_MISSION_STATEMENT ?></em></p>
        </section>
    </article>
<?php
//
// Tag Cloud, other things might appear here later
//
if(count(Cache::read('tags')))
{
?>
    <article class="section col s12 m6">
        <header class="section secondary-base z-depth-2">
            <h4 class="icon-tags">A Tag Cloud or Something</h4>
        </header>
        <section class="section shade-text">
            <div class="section secondary-text z-depth-3"
                 style="overflow-y: auto; max-height: 12em; text-align: justify"
                 id="tagCloud" 
                 data-uri="<?= BUNZ_HTTP_DIR ?>search">Loading...</div>
        </section>
    </article>
    <script src="<?= BUNZ_JS_DIR ?>tagCloud.js"></script>
<?php
}
?>
</div>
<?php
//
// Category Listing
//
if(empty($this->data['categories']))
{
?>
        <div class="z-depth-5 alert-text section icon-attention center-align">No categories have been created yet! <a class="btn secondary-base waves-effect icon-plus" href="<?= BUNZ_HTTP_DIR ?>cpanel#categories">Go make one!</a></div>
<?php
} else {
    $i = 0; 
    $cards_per_row = 2; // use this to create how many of these cards per row

    foreach($this->data['categories'] as $cat)
    {
        $stats = $this->data['stats'][$cat['id']];
        $stats['percent_resolved'] = $stats['total_issues'] > 0 
            ? round(($stats['total_issues'] - $stats['open_issues'])/$stats['total_issues'],2)*100 . '%' 
            : 'n/a';
        echo $i == 0 ? '<div class="row">' : ''
//
// "Card" heading 
//
?>
    <div class="col s12 m6">
        <article>
            <header class="section no-pad-top">
                <section class='section col s12 z-depth-5 category-<?= $cat['id'] ?>-base waves-effect' onclick="(function(evt){ if(!(evt.target instanceof HTMLAnchorElement)){ window.location='<?=BUNZ_HTTP_DIR,'report/category/',$cat['id']?>'; }})(event);">
                    <a href="<?=BUNZ_HTTP_DIR,'post/category/',$cat['id']?>" class="btn-large waves-effect btn btn-floating z-depth-5 right category-<?= $cat['id'] ?>-base" title="submit new"><i class="icon-plus"></i></a>
                    <h2><a href="<?=BUNZ_HTTP_DIR,'report/category/',$cat['id']?>" class="<?= $cat['icon'] ?>"><?= $cat['title'] ?></a></h2>
                    <h6><?= $cat['caption'] ?></h6>
                </section>
            </header>
            <section class="section row center no-pad-top">
<?php
//
// "Card" body (stats)
//
        if($stats['last_activity'])
        {
?>
                <p class="section col category-<?= $cat['id'] ?>-lighten-1 s3 z-depth-2 tooltipped" 
                          data-position="right" data-tooltip="<?= $stats['open_issues'] ?> open issue<?= 
                            $stats['open_issues'] == 1 ? '' : 's' ?>">
                    <span><i class="icon-unlock"></i><br/><?= $stats['open_issues'] ?></span>
                </p>
                <p class="section col category-<?= $cat['id'] ?>-lighten-2 s3 z-depth-3 tooltipped"
                          data-position="right" data-tooltip="percentage resolved: <?= $stats['percent_resolved'] ?>">
                    <span><i class="icon-ok"></i><br/><?= $stats['percent_resolved']?></span>
                </p>
                <p class="section col category-<?= $cat['id'] ?>-lighten-3 s3 z-depth-4 tooltipped" 
                          data-position="left" data-tooltip="<?= $stats['total_issues'] ?> total issue<?= 
                            $stats['total_issues'] == 1 ? '' : 's' ?>">
                    <span><i class="icon-doc-text-inv"></i><br/><?= $stats['total_issues'] ?></span>
                </p>
                <p class="section col category-<?= $cat['id'] ?>-lighten-4 s3 z-depth-5 tooltipped" 
                          data-position="left" data-tooltip="<?= $stats['unique_posters'] ?> unique poster<?= 
                            $stats['unique_posters'] == 1 ? '' : 's' ?>">
                    <span><i class="icon-users"></i><br/><?= $stats['unique_posters'] ?></span>
                </p>
                <p class="section col category-<?= $cat['id'] ?>-lighten-5 s12 z-depth-5">
                    <span><i class="icon-time"></i><?= datef($stats['last_activity'],'top') ?></span>
                </p>
<?php
        } else {
?>
                <p class="section col shade-text s12 right-align"><em>Nothing has been posted here yet!</em></p>
<?php
    }
?>
            </section>
        </article>
    </div>
<?php
        if($i++ == $cards_per_row || end($this->data['categories']) === $cat)
        {
            echo '</div>';
            $i = 0;
        } else
            $i++;
    }
}

require BUNZ_TPL_DIR . 'footer.inc.php';
