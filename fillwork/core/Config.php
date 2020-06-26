<?php
namespace fillwork\core;

final class Config{
	public static function get($var=null, $value=null) {
		static $config = [];
		// 如果是数组，则合并
		if (is_array($var)) {
			$config = array_merge($config, array_change_key_case($var, CASE_UPPER));
			return;
		}

		// 如果是字符串，则是设置或获取
		if (is_string($var)) {
			$var = strtoupper($var);
			if (!is_null($value)) {
				if (preg_match('/\./', $var)) {
					$var = explode('.', $var);
					$config[$var[0]][$var[1]] = $value;
				} else {
					$config[$var] = $value;
				}
				return;
			} else {
				if (preg_match('/\./', $var)) {
					$var = explode('.', $var);
					return isset($config[$var[0]][$var[1]]) ? $config[$var[0]][$var[1]] : null;
				} else {
					return isset($config[$var]) ? $config[$var] : null;
				}
			}
		}

		// 如果都为空，则是获取全部
		if (is_null($var) && is_null($value)) {
			return $config;
		}
	}
}