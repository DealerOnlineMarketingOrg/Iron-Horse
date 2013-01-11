<div class="full-width">
	<div class="box">
    	<div class="inner">
        	<form name="add_agency" id="add_agency" class="validate">
            	<div class="titlebar"><span class="icon awesome white browser"></span><span class="w-icon">Edit Agency</span></div>
                <div class="contents">
                	<div class="row">
                    	<label>Agency Name</label>
                        <div class="field-box"><input name="AGENCY_Name" type="text" class="large" value="<?= $agency->Name; ?>" class="validate[required,onlyLetterSp] required text" /></div>
                    </div>
                    <div class="clear"></div>
                    <div class="row">
                    	<label>Agency Description</label>
                        <div class="field-box"><textarea name="AGENCY_Notes" style="font-size:11px;"><?= $agency->Description; ?></textarea></div>
                    </div>
                    <div class="row last">
                    	<label>Enable or Disable</label>
                        <div class="field-box"><input type="checkbox" name="AGENCY_Active" value="<?= $agency->Status; ?>" class="ios" <?= (($agency->Status != '0') ? 'checked="checked"' : ''); ?> /> </div>
                        <div class="clear"></div>    
                    </div>
                    <input type="hidden" name="AGENCY_Created" value="<?= $agency->Created; ?>" />
                </div>
                <div class="bar-big">
                	<input type="submit" value="Submit" />
                    <input type="reset" value="Reset" />
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		$('div.iPhoneCheckHandle').click(function() {
			if($('input.ios').val() == '1') {
				$('input.ios').val('0');	
			}else {
				$('input.ios').val('1');	
			}
		});
	});
	
	function checkit() {
		if($('input.ios').is(':checked')) {
			$('input.ios').val('1');	
		}else {
			$('input.ios').val('0');	
		}
	}
</script>