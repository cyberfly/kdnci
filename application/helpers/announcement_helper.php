<?php

function getLatestAnnouncement()
{
    $ci = & get_instance();

    $latest_announcement = $ci->announcement_model
        ->where('active','1')
        ->get();

    return $latest_announcement;
}