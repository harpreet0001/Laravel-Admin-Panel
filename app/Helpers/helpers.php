<?php 



function purify_html($html){
    return($html);
}

function active_menu($url)
{
    return $url == request()->path() ? 'active' : '';
}