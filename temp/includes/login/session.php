<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors', 1);
if (!session_id()) session_start();
//Check JM

if(isset($_REQUEST['_SESSION'])) die("Nice try, buddy.");

if (session_id() == ''){
	unset($_SESSION['question']);
    //go to login page
	echo '<script src="./js/loginForm.js"></script>';
}
else {
	if (isset($_SESSION['question'])){
		if ($_SESSION['question'] == 42){
			echo '<script src="./js/adminPage.js"></script>';
		}
		else {
			session_unset();
			echo '<script src="./js/loginForm.js"></script>';
		}
	}
	else {
		session_unset();
		echo '<script src="./js/loginForm.js"></script>';
	}
}

//later use JM



//later use JM
//if( !isset( $_POST[''] ) ){ 
    // instantiate new session var
    //$_SESSION[$sessVar] = ''; 
//}else{
       // if( isset( $_COOKIE[$sessName] ) ){
       
        //}else{
          //  if( isset( $_REQUEST[$sessName] ) ){
           
            //}else{
              //  if( isset( $_SERVER['HTTP_COOKIE'] ) ){
                
                //}else{
                //problem
                //}
            //}
        //}

//    }else{

        // destroy session by unset() function
       // unset( $_SESSION[$sessVar] );

        // check if was destroyed
        //if( !isset( $_SESSION[$sessVar] ) ){
            
            //echo $sessName . ' was "unseted"';
        //}else{
            
            //echo $sessName . ' was not "unseted"';
       // }

    //}
//}?>