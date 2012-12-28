<div class="sidebar">
    <figure class="user-profile">
        <img alt="User Avatar" src="<?= $avatar; ?>" />
        <figcaption>
            <a href="#"><?= $user->FirstName . ' ' . $user->LastName; ?></a>
            <em><?= $user->AccessLevel; ?></em>
            <ul class="user-profile-actions">
                <li><a href="#" title="Open mailbox"><span class="awe-envelope-alt"></span></a></li>
                <li><a href="#" title="Personal settings"><span class="awe-cogs"></span></a></li>
                <li><a href="#" title="Hide Sidebar"><span class="awe-eye-close"></span></a></li>
                <li><a href="#" title="Logout"><span class="awe-signout"></span></a></li>
            </ul>
        </figcaption>
    </figure>        
    <ul class="sidebar-actionbar">
        <li><a href="#">Mailbox</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="<?= base_url(); ?>logout">Logout</a></li>
        <li><a href="#">Hide All</a></li>
    </ul>
    <nav class="main-navigation" role="navigation">
        <ul>
            <?php
                foreach($nav as $item) :
                    
                    
                    
                    
                    
                    
                endforeach;
            ?>
        </ul>
    </nav>
        
        
        