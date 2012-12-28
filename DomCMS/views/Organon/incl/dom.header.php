<header class="navbar">
	<div class="navbar-inner">
    	<a class="btn btn-alt btn-primary btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        
        <!-- logo -->
        <a href="<?= base_url() ; ?>" class="brand" title="Back to dashboard">DOM CMS</a>
        
        <!-- everything we want to go away with 940px or less, place within here -->
        <div class="nav-collapse">
        	<!-- header navigation -->
        	<nav>
            	<ul role="navigation">
                	<li><a href="#"><span class="awe-leaf"></span>My Account</a></li>
                    <li><a href="#"><span class="awe-group"></span>My Bookmarks</a></li>
                    <li><a href="#"><span class="awe-picture"></span>My Settings</a></li>
                    <li><a href="#"><span class="awe-wrench"></span>Privacy</a></li>
                </ul>
            </nav>
            
            <a class="navbar-logout" href="#"><span class="awe-off"></span>Log out</a>
            
            <form class="form-search pull-right">
            	<input type="text" class="search-query" name="search" title="Enter the search term" placeholder="Search&#8230;" autocomplete="on" />
                <button type="submit" class="btn btn-alt btn-primary">Search</button>
            </form>
        </div>
     </div>
</header>