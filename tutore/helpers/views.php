<?php

if ( ! function_exists('load_view'))
{
	function load_view($page = 'accueil')
	{
		if ( ! file_exists('views/pages/' . $page . '.html'))
				// ! file_exists('views/pages/admin' . $page . '.html') || ! file_exists('views/pages/prof' . $page . '.html'))
			show_404();
			
		else
			require_once('views/pages/' . $page . '.html');
	}
}

if ( ! function_exists('show_404'))
{
	function show_404()
	{
		require_once('views/errors/404.html');
	}
}