<html lang="en-US">
<?php include 'DOMCMS/views/Beoro/incl/header.php'; ?>
	<body class="bg_d">
    	<div class="main-wrapper">
        	<?php 
				//Horizontal navigation
				include 'DOMCMS/views/Beoro/incl/nav.php'; 
				//Mast header
				include 'DOMCMS/views/Beoro/incl/mast_head.php';
				//Content Page
				include 'DOMCMS/views/pages/' . $page . '.php';
			?>
            <div class="footer_space">&nbsp;</div>
        </div>
        <?php include 'DOMCMS/views/incl/footer.php'; ?>
    </body>
 </html>