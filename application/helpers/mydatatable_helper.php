<?php

function edit_action($route)
{
    return '<a href="' . site_url($route) . '" class="btn btn-primary" title="Edit">Edit</a>';
}

function delete_action($id)
{
    return '<a href="javascript:void(0);" class="delete btn btn-danger" data-id="' . $id. '" title="Delete">Delete</a>';
}