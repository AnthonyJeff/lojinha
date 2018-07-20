<?php 


	class App {

		private static $path;
		private static $index;
		private static $storagePath;
		private static $storageIndex;
		private static $defaultImage;

		public function __construct($path, $index){
			self::$path = $path;
			self::$index = $index;
			self::$storagePath = self::$path."/storage";
			self::$storageIndex = self::$index."/storage";
			self::$defaultImage = "https://st.depositphotos.com/1915171/4702/v/950/depositphotos_47028081-stock-illustration-pattern-of-geometric-shapes-triangle.jpg";
		}

		public static function route( $position ) {

			if( isset( $_GET['route'] ) ){
				$pieces = explode("/", $_GET['route']);
				return $pieces[$position - 1];
			}else{
				return false;
			}

		}

		public static function upload( $file ){
			
			if( !is_array($file) ){
				throw new Exception("Arquivo inválido", 1);
			}

			if( move_uploaded_file($file['tmp_name'], self::$storagePath."/".$file['name']) ){
				return $file['name'];
			}else{
				return false;
			}

		}

		public static function getImage($name, $width = '100%', $height = '400') {

			if( file_exists(self::$storagePath."/".$name) ){
				$srcfile = self::$storageIndex."/".$name;
			}else{
				$srcfile = self::$defaultImage;
			}

			echo '<img src="'.$srcfile.'" width="'.$width.'" height="'.$height.'" />';
		}

		public static function date($timestamp, $type = 'dh') {
			switch($type){
				case 'd':
					return date('d/m/Y',strtotime($timestamp));
				break;

				case 'h':
					return date('H:i:s',strtotime($timestamp));
				break;

				case 'dh':
					$date = date('d/m/Y',strtotime($timestamp));
					$hour = date('H:i:s',strtotime($timestamp));
					return $date." as ".$hour; 
				break;
			}
		}

		public static function error404() {
			header('location: '.self::$index.'/404');
		}

		public static function formatMoney($money, $type) {
			
			if( $type == "in" ){
				if( substr(strval($money), -2) == '00' ){
					return substr(strval($money), 0,  (strlen($money) - 2));
				}else{
					return substr(strval($money), 0, (strlen($money) - 1));
				}
			}elseif( $type == "out" ){
				return number_format($money, 2);
			}
			
		}
	}
?>