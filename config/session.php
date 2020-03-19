<?php

session_name("TestWebshop");
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
ini_set('session.gc_maxlifetime', 14400);
ini_set('session.cookie_lifetime', 14400);
ini_set('session.use_trans_sid', 0);
ini_set('session.use_only_cookies', 1);
register_shutdown_function('session_write_close');
session_start();
