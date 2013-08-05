<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Logging;

use Clay\Clay;

class Logger {

	// Attributes
	public static $debug = false;

	// Method : Process a log
	private static function process($logType, $message) {
		// File name
		$date = new \DateTime('NOW');
		$time = $date->format('r');
		$fileName = $date->format('d-m-Y') . '.log';

		// Type
		switch($logType) {
			case LogType::KERNEL: $type = "Kernel"; break;
			case LogType::INFO: $type = "Information"; break;
			case LogType::EXCEPTION: $type = "Exception"; break;
			case LogType::ERROR: $type = "Error"; break;
			default: $type = "Unknown"; break;
		}

		// Message
		$log = "[" . $time . "]\t" . $type . ": " . $message . "\n";

		// Open log
		$file  = fopen("../" . Clay::RESOURCE_LOGS . $fileName, "a");
		fwrite($file, $log);
		fclose($file);

		if (self::$debug)
			if ($logType == LogType::KERNEL || $logType == LogType::INFO )
				echo "<div style=\"margin-top: 2px; margin-bottom: 2px; padding-left: 3px; border: 1px solid #009DD7; background-color: #D4EEF7\"><strong>Debug</strong> <em>" . $type . "</em>: " . $message . "</div>";
			else if ($logType == LogType::EXCEPTION)
				echo "<div style=\"margin-top: 2px; margin-bottom: 2px; padding-left: 3px; border: 1px solid #E3781A; background-color: #FDE5CF\"><strong>Debug</strong> <em>" . $type . "</em>: " . $message . "</div>";
			else if ($logType == LogType::ERROR)
				echo "<div style=\"margin-top: 2px; margin-bottom: 2px; padding-left: 3px; border: 1px solid #FD2424; background-color: #F9CDCD\"><strong>Debug</strong> <em>" . $type . "</em>: " . $message . "</div>";
	}

	// Method : Process a kernel log
	public static function k($message) {
		Logger::process(LogType::KERNEL, $message);
	}

	// Method : Process an information log
	public static function i($message) {
		Logger::process(LogType::INFO, $message);
	}

	// Method : Process an exception log
	public static function x(\Exception $e) {
		Logger::process(LogType::EXCEPTION, $e->getMessage());
	}

	// Method : Process an error log
	public static function e($message) {
		Logger::process(LogType::ERROR, $message);
	}
}
?>