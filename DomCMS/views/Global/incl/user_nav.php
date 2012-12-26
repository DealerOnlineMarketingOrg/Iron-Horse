<div id="user_nav">
	<img src="<?= $avatar; ?>" alt="<?= $user['FirstName'] . ' ' . $user['LastName']; ?>" class="user_avatar" />
    <h2><?= $user['FirstName'] . ' ' . $user['LastName']; ?></h2>
    <div class="clear"></div>
    <nav>
    <?php foreach($nav as $item) { ?>
    	<a href="<?= $item->Href; ?>"><?= $item->Label; ?></a>
    <?php } ?>
    </nav>
    <div class="nav_toggle">&nbsp;</div>
</div>