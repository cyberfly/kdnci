<?php

function edit_button($url)
{
	$button = '<a class="btn btn-primary" href="' . site_url($url).'" >EDIT</a>';

	return $button;
}

function delete_button($id, $title=null)
{
	$button = '<a class="btn btn-danger delete" data-id="' . $id . '" data-title="' . $title . '" href="#" >Delete</a>';

	return $button;
}