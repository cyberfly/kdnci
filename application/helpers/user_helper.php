<?php 

/*
* return current logged user Object
[id] => 1
[ip_address] => 127.0.0.1
[username] => administrator
[password] => 59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4
[salt] => 9462e8eee0
[email] => admin@admin.com
[activation_code] => 19e181f2ccc2a7ea58a2c0aa2b69f4355e636ef4
[forgotten_password_code] => 81dce1d0bc2c10fbdec7a87f1ff299ed7e4c9e4a
[remember_code] => 9d029802e28cd9c768e8e62277c0df49ec65c48c
[created_on] => 1268889823
[last_login] => 1279464628
[active] => 0
[first_name] => Admin
[last_name] => Account
[company] => Some Corporation
[phone] => (123)456-7890
*/

function current_user() {

	// get CI instance to replace this in helper

	$ci = & get_instance();

	// get current user from ion auth

	$user = $ci->ion_auth->user()->row();

	return $user;

}

function current_user_fullname()
{
	$user = current_user();

	return $user->first_name . ' ' . $user->last_name;
}

function current_user_email()
{
	$user = current_user();

	return $user->email;
}

function current_user_id()
{
	$user = current_user();

	return $user->id;
}
