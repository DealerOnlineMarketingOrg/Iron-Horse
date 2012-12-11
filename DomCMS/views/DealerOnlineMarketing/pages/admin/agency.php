<div class="wrapper content-padding">
    <div id="dashboard" class="content-page">
        <h2>Agencies</h2>
        <a id="add_agency_btn" href="javascript:void(0)" class="button green float_right">+</a>
        <table>
        	<thead>
            	<th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <? if($userLvl >= 100000) { ?>
                	<th style="text-align:center;">Edit</th>
                <? } ?>
            </thead>
            <tbody>
			<?php foreach($agencies as $agency) : ?>
                <tr>
                	<td><?= $agency->Name; ?></td>
                    <td><?= $agency->Description; ?></td>
                    <td><?= (($agency->Status != 1) ? 'Disabled' : 'Active'); ?></td>
                    <? if($userLvl >= 100000) { ?><td style="text-align:center;"><a href="#" class="button blue">Edit</a></td><? } ?> 
                </tr>
        	<?php endforeach; ?>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>
</div>