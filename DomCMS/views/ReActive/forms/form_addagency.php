<div class="full-width">
	<div class="box">
    	<div class="inner">
        	<form name="add_agency" id="add_agency" class="validate">
            	<div class="titlebar"><span class="icon awesome white browser"></span><span class="w-icon">Add Agency</span></div>
                <div class="contents">
                	<div class="row">
                    	<label>Agency Name</label>
                        <div class="field-box"><input name="AGENCY_Name" type="text" class="large" placeholder="Agency Name" class="validate[required,onlyLetterSp] required text" /></div>
                    </div>
                    <div class="clear"></div>
                    <div class="row last">
                    	<label>Agency Description</label>
                        <div class="field-box"><textarea name="AGENCY_Notes" style="font-size:11px;" placeholder="Use this for Notes about the agency or a simple description for other users to use."></textarea></div>
                    </div>
                    <input type="hidden" name="AGENCY_Created" value="<?= date(FULL_MILITARY_DATETIME); ?>" />
                    <input type="hidden" name="AGENCY_Active" value="1" />
                </div>
                <div class="bar-big">
                	<input type="submit" value="Submit" />
                    <input type="reset" value="Reset" />
                </div>
            </form>
        </div>
    </div>
</div>