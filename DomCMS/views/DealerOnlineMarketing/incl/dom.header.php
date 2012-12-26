<div id="header">
    <div class="wrapper relative">
        <h1 id="DOM"><span>Dealer Online Marketing</span></h1>
            <div id="clientSwitch">
            <select id="client" class="select" name="dealer_dropdown">
               <? //= dealer_selector(); ?>
            </select>
        </div>
         <div id="clientTags">
        <?php 
		/* future check of sessionid
		(('0' == '0') ? $str = tag_selector() : $str='' ) ; 
		echo $str;	 */ 
		?>
        </div>
        <div id="userNav" class="insetShadow">
            <h5 class="textShadow"><?= get_welcome_message(); ?></h5>
            <ul>
            	<li><a href="<?= base_url(); ?>account/preferences">Preferences</a></li>
                <li><a href="#">My Account</a></li>
                <li><a href="<?= base_url(); ?>logout">Logout</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#header h1').click(function() {
            window.location = '<?= base_url(); ?>';
        })
        $('#client').change(function() {
        var name = $(this).find('option:selected').text();
        $.ajax({
            url:'/ajax/name_changer',
            data:({Agency:name}),
            method:'post',
            success:function(data) {
               $('div#orgInfo h5').text(data); 
            }
        });
    });

    })
</script>