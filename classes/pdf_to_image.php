<?php  
class pdf2image{
	
	public function convert_pdf_to_image($pdf_file, $page_number, $destination_file){
		$directory = $this->get_directory_path();
		$source_path = $directory.'input/'.escapeshellarg($pdf_file);
		$destination_path = $directory.'output/'.escapeshellarg($destination_file);

		// check current OS
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$command = $directory.'gs/win/bin/gs.exe -q -sDEVICE=pngalpha -dBATCH -dNOPAUSE -dFirstPage='.(int)$page_number.' -dLastPage='.(int)($page_number+1).' -r150x150 -sOutputFile='.$destination_path.' '.$source_path;
		}else{
			$command = 'gs -q -sDEVICE=pngalpha -dBATCH -dNOPAUSE -dFirstPage='.(int)$page_number.' -dLastPage='.(int)($page_number+1).' -r150x150 -sOutputFile='.$destination_path.' '.$source_path;
		}
		echo $command;

		exec($command, $retArr, $retVal);
		
		if(empty($retVal)){
			return 'Success';
		}
		else{
			return 'Error occured while converting the file using below command. <br>'.$command;
		}
	}

	// Get current directory path
	public function get_directory_path(){
		$current_folder = realpath(dirname(__FILE__));
		$current_folder = str_replace('\\classes', '/', $current_folder);
		$current_folder = str_replace('/classes', '/', $current_folder);
		return $current_folder;
	}
}
?>