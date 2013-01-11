<!-- header -->
<header>
    <div class="container<?= ((FLUIDLAYOUT) ? '-fluid' : ''); ?>">
        <div class="row<?= ((FLUIDLAYOUT) ? '-fluid' : ''); ?>">
            <div class="span3">
                <div class="main-logo"><a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>Assets/Global/imgs/login_logo.png" alt="DOM CMS"></a></div>
            </div>
            <div class="span5">
                <nav class="nav-icons">
                    <ul>
                        <li><a href="javascript:void(0)" class="ptip_s" title="Dashboard"><i class="icsw16-home"></i></a></li>
                        <li><a href="javascript:void(0)" class="ptip_s" title="Content"><i class="icsw16-create-write"></i></a></li>
                        <li><a href="javascript:void(0)" class="ptip_s" title="Mailbox"><i class="icsw16-mail"></i><span class="badge badge-info">6</span></a></li>
                        <li><a href="javascript:void(0)" class="ptip_s" title="Comments"><i class="icsw16-speech-bubbles"></i><span class="badge badge-important">14</span></a></li>
                        <li class="active"><span class="ptip_s" title="Statistics (active)"><i class="icsw16-graph"></i></span></li>
                        <li><a href="javascript:void(0)" class="ptip_s" title="Settings"><i class="icsw16-cog"></i></a></li>
                    </ul>
                 </nav>
            </div>
            <div class="span4">
                <div class="user-box">
                    <div class="user-box-inner">
                        <img src="<?= $avatar; ?>" alt="<?= $user->FirstName .', '. $user->LastName; ?>" class="user-avatar img-avatar" />
                        <div class="user-info">
                            Welcome, <strong><?= $user->FirstName; ?></strong>
                            <ul class="unstyled">
                                <li><a href="<?= base_url(); ?>">Settings</a></li>
                                <li>&middot;</li>
                                <li><a href="<?= base_url(); ?>logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
