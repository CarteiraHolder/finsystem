<?php
spl_autoload_register(function($Class){
	if(file_exists('application/' .strtolower($Class) . '.php')){
		include_once 'application/' . strtolower($Class) . '.php';
	}
});
