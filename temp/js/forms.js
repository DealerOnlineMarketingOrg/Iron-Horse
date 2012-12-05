var count = 0;
function forgotPassword(){
	$('#loginForm_Failure').hide();
	$('#loginForm_Box').hide('fast', 'easeInOutCirc');
	$('#passwordForm_Box').show('fast', 'easeInOutCirc');
	$('#passwordForm_Username').val($('#loginForm_Username').val());
};
function showSpinner(){
	$('#SpinnerWrapper').show('fast', 'easeInOutCirc');
};
function hideSpinner(){
	$('#SpinnerWrapper').hide('fast', 'easeInOutCirc');
};
function showLogin(){
	$('#loginFail').hide('fast', 'easeInOutCirc');
	$('#userFail').hide('fast', 'easeInOutCirc');
	$('#emailFail').hide('fast', 'easeInOutCirc');
	$('#loginForm_Failure').hide();
	$('#passwordReset_Box').hide('fast', 'easeInOutCirc');
	$('#newPassword_Fail').hide('fast', 'easeInOutCirc');
	$('#newPassword_Invalid').hide('fast', 'easeInOutCirc');
	$('#passwordForm_Box').hide('fast', 'easeInOutCirc');
	$('#loginForm_Box').show('fast', 'easeInOutCirc');
	$('#username').val('');
	$('#password').val('');
};
function lostPassword(){
	showSpinner();
	var emailAddress = $('#passwordForm_Username').val();
	var re = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (re.test(emailAddress)){
		$('#emailFail').hide();
		$.post('./connections/lostgate.php', {'email': emailAddress}, function(data){
			if (data == 0){
				hideSpinner();
				$('#userFail').show('fast', 'easeInOutCirc');
			}
			else {
				hideSpinner();
				$('#userFail').hide();
				$('#passwordForm_Box').hide('fast', 'easeInOutCirc');
				$('#passwordReset_Box').show('fast', 'easeInOutCirc');
				$('#newPassword_Fail').hide();
				$('#newPassword_Invalid').hide();
			}
		});
	}
	else {
		hideSpinner();
		$('#userFail').hide();
		$('#emailFail').show('fast', 'easeInOutCirc');
	}
};
function checkEmail(){
	var username = $('#loginForm_Username').val();
	var re = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (re.test(username)){
		return true;
	}
	else {
		return false;
	}
};
function submitPassword(){
	showSpinner();
	var password = $('#newPassword_Field1').val();
	var check = $('#newPassword_Field2').val();
	var username = $('#loginForm_Username').val();
	
	if (password == check){
		$.post('lib/scribe.php', {'username': username, 'password': password}, function(data){
			if (!data){
				hideSpinner();
				$('#newPassword_Invalid').hide();
				$('#newPassword_Fail').show('fast', 'easeInOutCirc');
			}
			else {
				$.get('./includes/login/log.php');
				$.post('./includes/login/sessionStart.php', {'username': username}, function(data){
					console.log('data returned, loading new page.');
					$('body').html(data);
					$('#mainContent_Loc_Bar_Add').hide();
					$('#mainNotification_Area').hide();
					$('#sidebar_Nav_Box').accordion({
						collapsible: true,
						navigation: true,
						active: false,
						autoheight: true 
					});
					dropdownLoad();
				});
				hideSpinner();
			}
		});
	}
	else {
		hideSpinner();
		$('#newPassword_Fail').hide();
		$('#newPassword_Invalid').show('fast', 'easeInOutCirc');
	}
}
function checkPassword(){
	showSpinner();
	var username = $('#loginForm_Username').val();
	var password = $('#loginForm_Password').val();
	
	console.log("check email");
	if (checkEmail()){
		console.log("email ok, post");
		$.post('lib/gatekeeper.php', {'username': username, 'password': password}, function(data){
			console.log("data returned: " + data);
			if (!data){
				console.log("login fail");
				hideSpinner();
				loginFail();
				$('#loginForm_Password').val('');
				count++;
				if (count >= 5){
					$('#loginForm_Box').hide('fast', 'easeInOutCirc');
					$('#passwordForm_Box').show('fast', 'easeInOutCirc');
					$('#loginForm_Failure').hide();
					$('#loginFail').show();
					$('#back2_Login').hide();
					count = 0;
				}
			}
			else if (data == "generated"){
				console.log("generated password");
				hideSpinner();
				$('#loginForm_Box').hide('fast', 'easeInOutCirc');
				$('#newPassword_Box').show('fast', 'easeInOutCirc');
				$('#newPassword_Fail').hide();
				$('#newPassword_Invalid').hide();
			}
			else {
				console.log("valid password, login successful");
				var valid = true;
				$.post('./includes/login/sessionStart.php', {'username': username}, function(data){
					$('body').html(data);
					$('#mainContent_Loc_Bar_Add').hide();
					$('#mainNotification_Area').hide();
					$('#sidebar_Nav_Box').accordion({
						collapsible: true,
						navigation: true,
						active: false,
						autoheight: true 
					});
					dropdownLoad();
					//fix for now
					$('#contentManager_Link').addClass('disableLink');
				});
				$.get('./includes/login/log.php');
				hideSpinner();
			}
		});
	}
	else {
		console.log("email invalid");
		hideSpinner();
		invalidUsername();
	}
};
function invalidUsername(){
	$('#loginForm_Failure').show('fast', 'easeInOutCirc');
};
function loginFail(){
	$('#loginForm_Failure').show('fast', 'easeInOutCirc');
};
function topLogout_Link(){
	$.get('./includes/login/logout.php', function(data){
		window.location = 'index.php';
	});
};
function dashboard(){
	$.get('./includes/main/modules/dashboard/dashboard.php', function(data){
		$('#mainContent_Body_Contents').html(data);
		$('#mainContent_Loc_Bar_Add').hide();
		$('#mainNotification_Area').hide();
		$('#sidebar_Nav_Box').accordion({
			collapsible: true,
			navigation: true,
			active: false,
			autoheight: true 
		});
		
		var selection = $("#dealerDropdown_Value").val();
		if (selection.substring(0,1) != 'c'){
			$("#contentManager_Link").addClass("disableLink");
			
		}
		//fix for now
		$('#contentManager_Link').addClass('disableLink');
		$('#adminTools_Link').removeClass('selected');
		$('#dashboard_Link').addClass('selected');
	});
};

function widget(){
	$.get('./includes/main/modules/widget/widget.php', function(data){
		$('#topWidget_Wrapper').html(data); });
		//console.log('testing of widget');
};

function sidebar(){
	console.log("call of sidebar");
	$.get('./includes/main/modules/sidebar/sidebar.php', function(data){
		//console.log("replace of sidebar");
		$('#sidebar_Nav').hide();
		$('#sidebar_Nav').html(data);
		$('#sidebar_Nav').show();
	});
	//console.log("end of sidebar");
};

//								//
//------------------------------//
//		Client Selection		//
//------------------------------//
//								//

function changeClient(){
	var selection = $("#selectDealer_Dropdown").val();
	
	$.post('./includes/header/dropdown/change.php', {'selection': selection}, function(data){
		dashboard();
	});
}

function changeTag(){
	var selection = $("#selectTag_Dropdown").val();
	
	$.post('./includes/header/dropdown/change_tag.php', {'selection': selection}, function(data){
		dashboard();
	});
}

function selectClient_Users(selected){
	
	$.post('./includes/main/modules/admin_tool/user/useradmin.php', {'selected': selected}, function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('USERS');
		if (selected.substr(0,1) == 'c'){
			$("#mainContent_Loc_Bar_Add").show();
		}
		$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addUser()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		$('a').removeClass('selected');
		$('#adminTools_Link').addClass('selected');
	});
}

function hideNotification(){
	$('#mainNotification_Area').hide('fast', 'easeInOutCirc');
}

//						//
//----------------------//
//		Admin Tools		//
//----------------------//
//						//

function adminTools(){
	$.get('./includes/main/modules/admin_tool/admin_tool.php', function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('CLIENTS');
		$("#mainContent_Loc_Bar_Add").show();
		$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addClient()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		$('a').removeClass('selected');
		$('#adminTools_Link').addClass('selected');
		
		$.get('./includes/header/menu/navigation.php', function(data){
			
		$("#leftNavigation").html(data);
		$('#adminTools_Link').addClass('selected');
		$('#dashboard_Link').removeClass('selected');
		$('#contentManager_Link').addClass('disableLink');
		});
	});
}
function groupAdmin(){
	$.get('./includes/main/modules/admin_tool/group/groupadmin.php', function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('ORGANIZATIONS');
		$("#mainContent_Loc_Bar_Add").show();
		$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addGroup()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		$('a').removeClass('selected');
		$('#adminTools_Link').addClass('selected');
	});
}
function orgAdmin(){
	$.get('./includes/main/modules/admin_tool/org/orgadmin.php', function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('GROUPS');
		$("#mainContent_Loc_Bar_Add").show();
		$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addOrg()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		$('a').removeClass('selected');
		$('#adminTools_Link').addClass('selected');
	});
}
function clientAdmin(){
	$.get('./includes/main/modules/admin_tool/client/clientadmin.php', function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
	});
}
function userAdmin(){
	$.get('./includes/main/modules/admin_tool/user/useradmin.php', function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
	});
}
function permAdmin(){
	$.get('./includes/main/modules/admin_tool/permission/permadmin.php', function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
	});
}
function websiteAdmin(){
	$.get('./includes/main/modules/admin_tool/website/websiteadmin.php', function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('WEBSITES');
		var selected = $("#dealerDropdown_Value") .find("dt a span.value").html();
		if (selected.substr(0,1) == 'c'){
			$("#mainContent_Loc_Bar_Add").show();
			$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addWebsite()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		}
		else {
			$("#mainContent_Loc_Bar_Add").hide();
		}
	});
}
function contactAdmin(){
	$.get('./includes/main/modules/admin_tool/contact/contactadmin.php', function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('CONTACTS');
		
		var selected = $("#dealerDropdown_Value") .find("dt a span.value").html();
		
		if (selected.substr(0,1) == 'c'){
			$("#mainContent_Loc_Bar_Add").show();
			$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addContact()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		}
		else {
			$("#mainContent_Loc_Bar_Add").hide();
		}
	});
}

//						//
//----------------------//
//		Group Tools		//
//----------------------//
//						//

function addGroup(){
	$.get('./includes/main/modules/admin_tool/group/add_group.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function addNew_Group(){
	var groupName = $("#addNew_Group_Name").val();
	var groupDesc = $("#addNew_Group_Desc").val();
	
	$.post('./includes/main/modules/admin_tool/add.php', {'groupName': groupName, 'groupDesc': groupDesc, 'formID': 'addNew_Group'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Organization successfully added!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
	});
}
function editGroup(groupID){
	$.post('./includes/main/modules/admin_tool/group/edit_group.php', {'groupID': groupID}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function editThis_Group(){
	var groupName = $("#editGroup_Name").val();
	var groupDesc = $("#editGroup_Desc").val();
	var groupID = $("#groupID").val();
	
	$.post('./includes/main/modules/admin_tool/edit.php', {'groupName': groupName, 'groupDesc': groupDesc, 'formID': 'editThis_Group', 'groupID': groupID}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Organization successfully edited!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
	});
}
function disableThis_Group(){
	var groupID = $("#groupID").val();
	
	$.post('./includes/main/modules/admin_tool/disable.php', {'groupID': groupID, 'formID': 'disableThis_Group'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Organization successfully disabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
	});
}
function enableThis_Group(){
	var groupID = $("#groupID").val();
	
	$.post('./includes/main/modules/admin_tool/enable.php', {'groupID': groupID, 'formID': 'enableThis_Group'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Organization successfully enabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			groupAdmin();
		}
	});
}

//						//
//----------------------//
//	Organization Tools	//
//----------------------//
//						//

function addOrg(){
	$.get('./includes/main/modules/admin_tool/org/add_org.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function addNew_Org(){
	var orgName = $("#addNew_Org_Name").val();
	var groupID = $("#addNew_Org_Group").val();
	var groupID2 = $("#groupID2").val();
	
	$.post('./includes/main/modules/admin_tool/add.php', {'orgName': orgName, 'groupID': groupID, 'formID': 'addNew_Org'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Group successfully added!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
	});
}
function editOrg(orgID){
	$.post('./includes/main/modules/admin_tool/org/edit_org.php', {'orgID': orgID}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function editThis_Org(){
	var orgName = $("#editOrg_Name").val();
	var groupID = $("#editOrg_Group").val();
	var groupID2 = $("#groupID2").val();
	var orgID = $("#orgID").val();
	
	$.post('./includes/main/modules/admin_tool/edit.php', {'orgName': orgName, 'orgID': orgID, 'formID': 'editThis_Org', 'groupID': groupID, 'groupID2': groupID2}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Group successfully edited!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
	});
}
function disableThis_Org(){
	var orgID = $("#orgID").val();
	
	$.post('./includes/main/modules/admin_tool/disable.php', {'orgID': orgID, 'formID': 'disableThis_Org'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Group successfully disabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
	});
}
function enableThis_Org(){
	var orgID = $("#orgID").val();
	
	$.post('./includes/main/modules/admin_tool/enable.php', {'orgID': orgID, 'formID': 'enableThis_Org'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Group successfully disabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			orgAdmin();
		}
	});
}

//							//
//--------------------------//
//		Client Tools		//
//--------------------------//
//							//

function addClient(){
	$.get('./includes/main/modules/admin_tool/client/add_client.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function addNew_Client(){
	var clientName = $("#clientName").val();
	var clientAddress = $("#clientAddress").val();
	var clientAddress1 = $("#clientAddress1").val();
	var clientCity = $("#clientCity").val();
	var clientState = $("#clientState").val();
	var clientZip = $("#clientZip").val();
	var clientPhone_Sales = $("#clientPhone_Sales").val();
	var clientPhone_Service = $("#clientPhone_Service").val();
	var clientComment = $("#clientComment").val();
	var clientUrl = $("#clientUrl").val();
	var clientUrl1 = $("#clientUrl1").val();
	var clientCode = $("#clientCode").val();
	var orgID = $("#orgID").val();
		
	$.post('./includes/main/modules/admin_tool/add.php', {'clientName': clientName, 'clientAddress': clientAddress,'clientAddress1': clientAddress1, 'clientCity': clientCity,'clientState': clientState, 'clientZip': clientZip, 'clientPhone_Sales': clientPhone_Sales, 'clientPhone_Service': clientPhone_Service, 'clientComment': clientComment, 'clientUrl': clientUrl, 'clientUrl1': clientUrl1, 'clientCode': clientCode, 'orgID': orgID, 'formID': 'addNew_Client'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Client successfully added!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
	});
}
function editClient(clientID){
	$.post('./includes/main/modules/admin_tool/client/edit_client.php', {'clientID': clientID}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function editThis_Client(){
	var clientName = $("#clientName").val();
	var clientAddress = $("#clientAddress").val();
	var clientAddress1 = $("#clientAddress1").val();
	var clientCity = $("#clientCity").val();
	var clientState = $("#clientState").val();
	var clientZip = $("#clientZip").val();
	var clientPhone_Sales = $("#clientPhone_Sales").val();
	var clientPhone_Service = $("#clientPhone_Service").val();
	var clientComment = $("#clientComment").val();
	var clientUrl = $("#clientUrl").val();
	var clientUrl1 = $("#clientUrl1").val();
	var clientCode = $("#clientCode").val();
	var clientID = $("#clientID").val();
	var orgID = $("#orgID").val();
	
	$.post('./includes/main/modules/admin_tool/edit.php', {'clientName': clientName, 'clientAddress': clientAddress, 'clientAddress1': clientAddress1, 'clientCity': clientCity,'clientState': clientState, 'clientZip': clientZip, 'clientPhone_Sales': clientPhone_Sales, 'clientPhone_Service': clientPhone_Service, 'clientComment': clientComment, 'clientUrl': clientUrl, 'clientUrl1': clientUrl1, 'orgID': orgID, 'clientCode': clientCode, 'clientID': clientID, 'formID': 'editThis_Client'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Client successfully edited!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
	});
}
function disableThis_Client(){
	var clientID = $("#clientID").val();
	
	$.post('./includes/main/modules/admin_tool/disable.php', {'clientID': clientID, 'formID': 'disableThis_Client'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Client successfully disabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
	});
}
function enableThis_Client(){
	var clientID = $("#clientID").val();
	
	$.post('./includes/main/modules/admin_tool/enable.php', {'clientID': clientID, 'formID': 'enableThis_Client'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Client successfully enabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
	});
}

function viewClient(id){
	$.post('./includes/main/modules/admin_tool/client/view_client.php', {'id': id}, function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
	});
}

//						//
//----------------------//
//		User Tools		//
//----------------------//
//						//

function addUser(){
	$.get('./includes/main/modules/admin_tool/user/add_user.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function addNew_User(){
	var userName = $("#userName").val();
	var firstName = $("#firstName").val();
	var lastName = $("#lastName").val();
	var phoneNumber = $("#phoneNumber").val();
	var permID = $("#permID").val();
	var cID = $("#cID").val();
		
	$.post('./includes/main/modules/admin_tool/add.php', {'userName': userName, 'firstName': firstName, 'lastName': lastName, 'phoneNumber': phoneNumber, 'permID': permID, 'cID': cID, 'formID': 'addNew_User'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("User successfully added!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
	});
}
function editUser(userID){
	$.post('./includes/main/modules/admin_tool/user/edit_user.php', {'userID': userID}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function editThis_User(){
	var firstName = $("#firstName").val();
	var lastName = $("#lastName").val();
	var phoneNumber = $("#phoneNumber").val();
	var permID = $("#permID").val();
	var userID = $("#userID").val();
	
	$.post('./includes/main/modules/admin_tool/edit.php', {'firstName': firstName, 'lastName': lastName, 'permID': permID, 'phoneNumber': phoneNumber, 'userID': userID, 'formID': 'editThis_User'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("User successfully edited!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
	});
}
function disableThis_User(){
	var userID = $("#userID").val();
	
	$.post('./includes/main/modules/admin_tool/disable.php', {'userID': userID, 'formID': 'disableThis_User'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("User successfully disabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
	});
}
function enableThis_User(){
	var userID = $("#userID").val();
	
	$.post('./includes/main/modules/admin_tool/enable.php', {'userID': userID, 'formID': 'enableThis_User'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("User successfully enabled!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			userAdmin();
		}
	});
}
function resetThis_User(){
	var userID = $("#userID").val();
	var userEmail = $("#userEmail").val();
	
	$.post('./includes/main/modules/admin_tool/reset.php', {'userID': userID, 'userEmail': userEmail}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Password successfully reset!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			clientAdmin();
		}
	});
}

//						//
//----------------------//
//		Contacts		//
//----------------------//
//						//

function selectContacts(id){
	
	$.post('./includes/main/modules/admin_tool/contact/contactadmin.php', {'selected': id}, function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('CONTACTS');
		var selected = $("#dealerDropdown_Value") .find("dt a span.value").html();
		if (selected.substr(0,1) == 'c'){
			if (id.substr(0,1) == 'c'){
				$("#mainContent_Loc_Bar_Add").show();
			}
		}
		else {
			$("#mainContent_Loc_Bar_Add").hide();
		}
		$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addContact()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		$('a').removeClass('selected');
		$('#adminTools_Link').addClass('selected');
	});
	
}

function addContact(){
	$.get('./includes/main/modules/admin_tool/contact/add_contact.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}

function addNew_Contact(){
	var contactFirst_Name = $("#contactFirst_Name").val();
	var contactLast_Name = $("#contactLast_Name").val();
	var contactEmail_Work = $("#contactEmail_Work").val();
	var contactEmail_Home = $("#contactEmail_Home").val();
	var contactPhone_Work = $("#contactPhone_Work").val();
	var contactPhone_Home = $("#contactPhone_Home").val();
	var contactCellphone = $("#contactCellphone").val();
	var contactFax = $("#contactFax").val();
	var contactAddress = $("#contactAddress").val();
	var contactAddress1 = $("#contactAddress1").val();
	var contactCity = $("#contactCity").val();
	var contactState = $("#contactState").val();
	var contactZip = $("#contactZip").val();
	var contactType = $("#contactType").val();
	var contactComments = $("#contactComments").val();
	var clientID = $("#clientID").val();
	
	$.post('./includes/main/modules/admin_tool/add.php', {'contactFirst_Name':contactFirst_Name, 'contactLast_Name':contactLast_Name, 'contactEmail_Work':contactEmail_Work, 'contactEmail_Home':contactEmail_Home, 'contactPhone_Work':contactPhone_Work, 'contactPhone_Home':contactPhone_Home, 'contactCellphone':contactCellphone, 'contactFax':contactFax, 'contactAddress':contactAddress, 'contactAddress1':contactAddress1, 'contactCity':contactCity, 'contactState':contactState, 'contactZip':contactZip, 'contactType':contactType, 'contactComments':contactComments, 'clientID':clientID, 'formID':'addNew_Contact'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Contact successfully added!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			contactAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			contactAdmin();
		}
	});
	
}

function editContact(id){
	$.post('./includes/main/modules/admin_tool/contact/edit_contact.php', {'contactID': id}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}

function editThis_Contact(){
	var contactFirst_Name = $("#contactFirst_Name").val();
	var contactLast_Name = $("#contactLast_Name").val();
	var contactEmail_Work = $("#contactEmail_Work").val();
	var contactEmail_Home = $("#contactEmail_Home").val();
	var contactPhone_Work = $("#contactPhone_Work").val();
	var contactPhone_Home = $("#contactPhone_Home").val();
	var contactCellphone = $("#contactCellphone").val();
	var contactFax = $("#contactFax").val();
	var contactAddress = $("#contactAddress").val();
	var contactAddress1 = $("#contactAddress1").val();
	var contactCity = $("#contactCity").val();
	var contactState = $("#contactState").val();
	var contactZip = $("#contactZip").val();
	var contactType = $("#contactType").val();
	var contactComments = $("#contactComments").val();
	var clientID = $("#clientID").val();
	var contactID = $("#contactID").val();

	$.post('./includes/main/modules/admin_tool/edit.php', {'contactID': contactID, 'contactFirst_Name':contactFirst_Name, 'contactLast_Name':contactLast_Name, 'contactEmail_Work':contactEmail_Work, 'contactEmail_Home':contactEmail_Home, 'contactPhone_Work':contactPhone_Work, 'contactPhone_Home':contactPhone_Home, 'contactCellphone':contactCellphone, 'contactFax':contactFax, 'contactAddress':contactAddress, 'contactAddress1':contactAddress1, 'contactCity':contactCity, 'contactState':contactState, 'contactZip':contactZip, 'contactType':contactType, 'contactComments':contactComments, 'clientID':clientID, 'formID':'editThis_Contact'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Contact successfully edited!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			contactAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			contactAdmin();
		}
	});
	
}

function viewContact(id){
	$.post('./includes/main/modules/admin_tool/contact/view_contact.php', {'id': id}, function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
	});
}

//						//
//----------------------//
//		Websites		//
//----------------------//
//						//

function addWebsite(){
	
	$.get('./includes/main/modules/admin_tool/website/add_website.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
	
}

function addNew_Website(){
	
	var clientID = $("#editWebsite_Client_ID").val();
	var websiteUrl = $("#editWebsite_Url").val();
	var websiteDesc = $("#editWebsite_Desc").val();
	
	$.post('./includes/main/modules/admin_tool/add.php', {'clientID': clientID, 'websiteUrl': websiteUrl, 'websiteDesc': websiteDesc, 'formID': 'addNew_Website'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Website successfully added!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			websiteAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			websiteAdmin();
		}
	});
	
}

function selectWebsites(id){
	
	$.post('./includes/main/modules/admin_tool/website/websiteadmin.php', {'selected': id}, function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('WEBSITES');
		var selected = $("#dealerDropdown_Value") .find("dt a span.value").html();
		if (selected.substr(0,1) == 'c'){
			if (id.substr(0,1) == 'c'){
				$("#mainContent_Loc_Bar_Add").show();
			}
		}
		else {
			$("#mainContent_Loc_Bar_Add").hide();
		}
		$("#mainContent_Loc_Bar_Add").html('<a href="javascript:addWebsite()"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></a>');
		$('a').removeClass('selected');
		$('#adminTools_Link').addClass('selected');
	});
	
}

function editWebsite(id){

	$.post('./includes/main/modules/admin_tool/website/edit_website.php', {'websiteID': id}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
	
}

function editThis_Website(){
	var editSite_ID = $("#editSite_ID").val();
	var editSite_URL = $("#editSite_URL").val();
	var editSite_Desc = $("#editSite_Desc").val();

	$.post('./includes/main/modules/admin_tool/edit.php', {'editSite_ID':editSite_ID, 'editSite_URL':editSite_URL, 'editSite_Desc':editSite_Desc, 'formID':'editThis_Website'}, function(data){
		if (data == "success"){
			$("#mainNotification_Box").html("Website successfully edited!");
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			websiteAdmin();
		}
		else {
			$("#mainNotification_Box").html("Something went wrong! Output: " + data);
			$("#mainNotification_Area").show('fast', 'easeInOutCirc');
			websiteAdmin();
		}
	});
	
}

function viewWebsite(id){
	$.post('./includes/main/modules/admin_tool/website/view_website.php', {'id': id}, function(data){
		$("#mainContent_Body_Contents").hide('fast', 'easeInOutCirc');
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Contents").show('fast', 'easeInOutCirc');
	});
}

//						//
//----------------------//
//		Content AI		//
//----------------------//
//						//

function contentManager(){
	if ($("#contentManager_Link").hasClass("disableLink")){
		//return false;
	}
	else {
		$.get('./includes/main/modules/contentAI/contentAI.php', function(data){
			$("#mainContent_Body_Contents").html(data);
			$("#mainContent_Body_Black_Bar").hide();
			$("#mainContent_Loc_Bar_Text").html('CONTENT');
			$("#mainContent_Loc_Bar_Add").show();
			$('a').removeClass('selected');
			$('#contentManager_Link').addClass('selected');
		});
	}
}
function addContent(){
	$.get('./includes/main/modules/contentAI/add_content.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function addNew_Content(){
	var clientID = $("#clientID").val();
	var newPage = $("#newPage").val();
	var contentPage = $("#contentPage").val();
	
	$.post('./includes/main/modules/contentAI/add.php', {'clientID': clientID, 'newPage': newPage, 'contentPage': contentPage}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function selectContent(){
	$.get('./includes/main/modules/contentAI/contentadmin.php', function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function editContent(pageID){
	$.post('./includes/main/modules/contentAI/edit_content.php', {'pageID': pageID}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}
function editThis_Content(){
	var clientID = $("#clientID").val();
	var dealerPage = $("#dealerPage").val();
	var contentPage = $("#contentPage").val();
	var pageID = $("#pageID").val();
	
	$.post('./includes/main/modules/contentAI/edit.php', {'clientID': clientID, 'dealerPage': dealerPage, 'contentPage': contentPage, 'pageID': pageID}, function(data){
		$("#mainContent_Body_Contents").html(data);
	});
}

//							//
//--------------------------//
//		DMS Database		//
//--------------------------//
//							//

function dmsDatabase(){
	$.get('./includes/main/modules/dms/dms.php', function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('DMS DATABASE');
		$("#mainContent_Loc_Bar_Add").hide();
		$('a').removeClass('selected');
		$('#dmsDatabase_Link').addClass('selected');
	});
}

//							//
//--------------------------//
//		Merchandising		//
//--------------------------//
//							//

function merchandising(){
	$.get('./includes/main/modules/merchandising/merchandising.php', function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('MERCHANDISING');
		$("#mainContent_Loc_Bar_Add").hide();
		$('a').removeClass('selected');
		$('#merchandising_Link').addClass('selected');
	});
}

//					//
//------------------//
//		Media		//
//------------------//
//					//

function media(){
	$.get('./includes/main/modules/media/media.php', function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('MEDIA');
		$("#mainContent_Loc_Bar_Add").hide();
		$('a').removeClass('selected');
		$('#media_Link').addClass('selected');
	});
}

//						//
//----------------------//
//	Outbound-Creative   //
//----------------------//
//						//

function outbound(){
	$.get('./includes/main/modules/outbound/outbound.php', function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('OUTBOUND');
		$("#mainContent_Loc_Bar_Add").hide();
		$('a').removeClass('selected');
		$('#outbound_Link').addClass('selected');
	});
}

//					//
//------------------//
//		Reports		//
//------------------//
//					//

function reports(){
	$.get('./includes/main/modules/reports/reports.php', function(data){
		$("#mainContent_Body_Contents").html(data);
		$("#mainContent_Body_Black_Bar").hide();
		$("#mainContent_Loc_Bar_Text").html('REPORTS');
		$("#mainContent_Loc_Bar_Add").hide();
		$('a').removeClass('selected');
		$('#reports_Link').addClass('selected');
	});
}