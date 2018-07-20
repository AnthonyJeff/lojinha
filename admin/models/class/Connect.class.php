<?php
	
	

	class Connect {

		private static $connection;

		public static function get_instance() {

			include(dirname(__DIR__).'/config.php');

			if (!isset(self::$connection)) {


				self::$connection = new PDO("mysql:host=".$db['host'].";dbname=".$db['db'],$db['user'], $db['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

						//configuração de erros
				self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						//configuração de nulos e em branco.
				self::$connection->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

			}

			return self::$connection;
		}
	}
