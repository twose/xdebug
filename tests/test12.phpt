--TEST--
Test for complex parameters to functions
--INI--
xdebug.enable=1
xdebug.auto_trace=0
xdebug.collect_params=1
xdebug.auto_profile=0
xdebug.profiler_enable=0
xdebug.show_mem_delta=0
xdebug.trace_format=0
--FILE--
<?php
	$tf = xdebug_start_trace('/tmp/'. uniqid('xdt', TRUE));

	function a ($a, $b, $h, &$i) {
		echo $a;
		return $a + $b;
	}

	$a = array (1, 2,3,4,5);
	$b = array ("h" => 9.12, $a, $a, $a, "p" => 9 - 0.12);
	echo a (5, 9.12, FALSE, $b);

	echo file_get_contents($tf);
	unlink($tf);
?>
--EXPECTF--
514.12
TRACE START [%d-%d-%d %d:%d:%d]
    %f      %d     -> a(5, 9.12, FALSE, array ('h' => 9.12, 0 => array (0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5), 1 => array (0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5), 2 => array (0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5), 'p' => 8.88)) /%s/test12.php:11
    %f      %d     -> file_get_contents('/tmp/%s') /%s/test12.php:13
