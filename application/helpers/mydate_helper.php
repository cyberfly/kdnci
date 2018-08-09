<?php

function gov_date($date_time)
{
	 $date = date("d-m-Y", strtotime($date_time));

	 return $date;
}

function gov_datetime($date_time)
{
	 $date = date("d-m-Y H:i:s A", strtotime($date_time));

	 return $date;
}