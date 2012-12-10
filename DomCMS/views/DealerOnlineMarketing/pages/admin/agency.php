<div class="wrapper content-padding">
    <div id="dashboard" class="content-page">
        <h2>Agencies</h2>
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
                    <td></td>
                    <? if($userLvl >= 100000) { ?><td><a href="#">Edit</a></td><? } ?> 
                </tr>
        	<?php endforeach; ?>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>
</div>