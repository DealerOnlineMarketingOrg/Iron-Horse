<div class="wrapper content-padding">
    <div id="dashboard" class="content-page">
        <h2>Agencies</h2>
        <a href="<?= base_url(); ?>/agency/add" class="button green float_right">Add Agency</a>
        <table>
        	<thead>
            	<th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <? if($userLvl >= 100000) { ?>
                	<th>Edit</th>
                <? } ?>
            </thead>
            <tbody>
			<?php foreach($agencies as $agency) : ?>
                <tr>
                	<td><?= $agency->Name; ?></td>
                    <td><?= $agency->Description; ?></td>
                    <td><?= (($agency->Status != 1) ? 'Disabled' : 'Active'); ?></td>
                    <? if($userLvl >= 100000) { ?><td><a href="#" class="button red" style="display:block;">Edit</a></td><? } ?> 
                </tr>
        	<?php endforeach; ?>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>
</div>