<?php

class ConvertUploadHandler extends UploadHandler
{
	/* Process after uploaded */
	
    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error, $index = null, $content_range = null)   {		
        $file = parent::handle_file_upload($uploaded_file, $name, $size, $type, $error, $index, $content_range);
		if (!empty($file->error)) { 
			$file->error = Yii::t('err',$file->error); 
		} else { 				
			
			return $file;
			
		}
        return $file;
    }

    /* Converts a filename into a randomized file name */
    private function _generateRandomFileName($name) {
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        return md5(uniqid(rand(), true)).'.'.$ext;
    }

    /* Overrides original functionality */
    protected function trim_file_name($file_path, $name, $size, $type, $error,$index, $content_range) {
        $name = parent::trim_file_name($file_path, $name, $size, $type, $error, $index, $content_range);
		//$name = iconv(mb_detect_encoding($name, mb_detect_order(), true), "TIS-620", $name);
        return $this->_generateRandomFileName($name);
    }

	/* Overrides original functionality */
    protected function get_file_name($file_path, $name, $size, $type, $error, $index, $content_range) 
	{
		//echo var_dump($name);
		/*
		$exp = explode('.' , $name);
		$filename = substr($name, 0 , -(strlen($exp[count($exp)-1])+1));
		$ext = $exp[count($exp)-1];
		$filename = substr($filename,0,80);
		$name = $filename.".".strtolower($ext);
		*/
		return $name;
    }


		

}

?>