<div class="wrapper content-padding">
    <div id="dashboard" class="content-page">
        <h2>Dashboard</h2>
        <?
			foreach($widgets as $widget) {
				echo '<div class="widget ' . strtolower($widget->MODULE_Name) . '">' . $widget->MODULE_Name . '</div>';	
			}
		?>
    </div>
</div>