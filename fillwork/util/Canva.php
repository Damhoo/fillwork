<?php

/**
 * @Author: envid
 * @Date:   2020-07-08 08:12:05
 */
namespace fillwork\util;

final class Canva {
	private static $graph=null;

	final private function __construct() {}
	final private function __clone() {}

	// 创建画布并返回实例
	static public function getGraph($config=[], $class='Graph', $cache='') {
		if (self::$graph != null) {
			return self::$graph;
		}
		$class = "Amenadiel\JpGraph\Graph\\$class";
		if (!empty($cache)) {
			self::$graph = new $class($config['width'], $config['height'], $cache);
		} else {
			self::$graph = new $class($config['width'], $config['height']);
		}
		return self::$graph;
	}
}