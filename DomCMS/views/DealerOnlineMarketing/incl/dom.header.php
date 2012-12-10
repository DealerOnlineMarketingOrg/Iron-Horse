<div id="header">
    <div class="wrapper relative">
        <h1 id="DOM"><span>Dealer Online Marketing</span></h1>
            <div id="clientSwitch">
            <select id="client" class="select">
                <?= $dropdown ?>
            </select>
        </div>
        <div id="clientTags">
        	<select id="tags" class="select">
            	<option value="0" class="parent">Green Team</option>
                <option value="1" class="child">Red Team</option>
                <option value="2" class="child">Purple Team</option>
                <option value="3" class="child">Blue Team</option>
            </select>
        </div>
        <div id="userNav" class="insetShadow">
            <h5 class="textShadow"><?= get_welcome_message(); ?></h5>
            <ul>
            	<li><a href="<?= base_url(); ?>account/preferences">Preferences</a></li>
                <li><a href="#">My Account</a></li>
                <li><a href="<?= base_url(); ?>logout">Logout</a></li>
            </ul>
        </div>
        <div id="siteSearch">
        	<input type="text" value="Search" class="input" onfocus="if(this.value == 'Search') { this.value = '' }" onblur="if(this.value == '') { this.value = 'Search' }"/>
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