<?php  
require_once	"classes/pdf_to_image.php";

$pdf_file = @$_FILES['pdf_file'];
$page_number = @$_POST['page_number'];

if(!empty($pdf_file['name']) && $pdf_file['type']=='application/pdf' && !empty($page_number)){
	if($pdf_file["error"] > 0){
		echo "Error: " . $pdf_file["error"] . "<br />";
	}
	else{
		move_uploaded_file($pdf_file["tmp_name"],"./input/" . $pdf_file["name"]);
		$destination_file = basename($pdf_file['name'], ".pdf").'.png';
		
		$pdf2image = new pdf2image();
		$result = $pdf2image->convert_pdf_to_image($pdf_file['name'], $page_number, $destination_file);
		if($result == 'Success'){
			echo '<img src="output/'.$destination_file.'" alt="" />';
		}
		else{
			echo $result;
		}
	}
}

?>