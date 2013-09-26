<?php
	
	class Archive {

		public static function unzip($filename = NULL, $destination = NULL) {

		if( !$filename ) {
			exit("<strong>Missing argument 1:</strong> file name must be specified!");

		} else if( !file_exists($filename) ) {
			exit("<strong>Error:</strong> file doesn't exist!");

		} else if( pathinfo($filename, PATHINFO_EXTENSION) != "zip" ) {
			exit("<strong>Error:</strong> file must be in a zip format!");
		}

		$destination = (!$destination || empty($destination) || !is_dir($destination)) ? "." : $destination;

		$zip = new ZipArchive;

		if( $zip->open($filename) === true ) {

			if( $zip->extractTo($destination) === true ) {
				$zip->close();

				return true;
			}
				
		} else exit("<strong>Error:</strong> something went wrong, could not unzip your file!"); 
	}
}

?>
