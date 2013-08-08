<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Database;

use Clay\Clay;
use Symfony\Component\Yaml\Parser;
use Clay\Logging\Logger;

class DatabaseConnection {

	// Method : Get connection
	public static function get($name) {
		$configuration = array();

		// Load configurations
		$file = '../' . Clay::CONFIG_DATABASE;
		$parser = new Parser();

		try {
			$configuration = $parser->parse(file_get_contents($file));
			$configuration = $configuration['databases'];
		} catch(ParseException $e) {
			Logger::k("Unable to parse the YAML string: %s", $e->getMessage());
		}

		// Check configuration
		if (!isset($configuration[$name]))
			Logger::k("Error: The SQL configuration requested doesn't exist");

		// Get SQL connection
		try {
			$pdo = new \PDO($configuration[$name]['driver'] . ':host=' . $configuration[$name]['host'] . ';port=' . $configuration[$name]['port'] . ';dbname=' . $configuration[$name]['db'], $configuration[$name]['user'], $configuration[$name]['password']);
			return $pdo;
		} catch (\Exception $e) {
			Logger::k("Error: " . $e->getMessage());
		}
	}
}
?>