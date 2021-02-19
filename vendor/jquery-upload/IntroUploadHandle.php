<?php

class IntroUploadHandle extends UploadHandler
{
	/* Process after uploaded */
    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error, $index = null, $content_range = null)   {
        $file = parent::handle_file_upload($uploaded_file, $name, $size, $type, $error, $index, $content_range);
		//echo var_dump($file);
		//exit;
		if (!empty($file->error)) { 
			$file->error = Yii::t('err',$file->error); 
		} else { 
		
			$fullpath=Yii::app()->params['prg_ctrl']['path']['upload'];
			$fullurl=Yii::app()->params['prg_ctrl']['url']['upload'];
			
			$exp = explode('.' , $name);
			$filename = substr($name, 0 , -(strlen($exp[count($exp)-1])+1));
			$ext = $exp[count($exp)-1];
			$filename = substr($filename,0,80);		
			$name = $filename.'_'.date('YmdHis').'.'.$ext;
			
			//rename (Yii::app()->params['prg_ctrl']['path']['upload'].'\\'.$name, "aaa.txt");
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
        return $this->_generateRandomFileName($name);
    }

	/* Overrides original functionality */
    protected function get_file_name($file_path, $name, $size, $type, $error,$index, $content_range) 
	{
		$exp = explode('.' , $name);
		$filename = substr($name, 0 , -(strlen($exp[count($exp)-1])+1));
		$ext = $exp[count($exp)-1];
		$filename = substr($filename,0,80);	
				
		date_default_timezone_set('Asia/Bangkok');	
			
		$name = $filename.'_'.date('YmdHis').'.'.strtolower($ext);
		return $name;
		
    }
	
	protected function get_file_resize($name)
	{
		require_once Yii::getPathOfAlias('application') . Yii::app()->params['prg_ctrl']['vendor']['phpthumb']['path'];
		$fullpath=Yii::app()->params['prg_ctrl']['path']['upload'];
		$fullurl=Yii::app()->params['prg_ctrl']['url']['upload'];
		$exp = explode('.' , $name);
		$filename = substr($name, 0 , -(strlen($exp[count($exp)-1])+1));
		$ext = $exp[count($exp)-1];
		$name_file = substr($filename,0,80);					
		
		$size_s_whidth = '150';
		$size_s_height = '150';	
			
		$size_xl_whidth = '400';
		$size_xl_height = '400';				

		Yii::app()->session['size_s'] = $size_s_whidth.'x'.$size_s_height;
		Yii::app()->session['size_xl'] = $size_xl_whidth.'x'.$size_xl_height;
				
				
		
			try
			{
				 $thumb_s = PhpThumbFactory::create($fullpath.'\\'.$name);
			}
			catch (Exception $e)
			{
				 // handle error here however you'd like
			}
			//$thumb_s->resize($size_s_whidth, $size_s_height);
			$thumb_s->adaptiveResize($size_s_whidth, $size_s_height);
			if (!file_exists($fullpath.'\\imgs')) {
				mkdir($fullpath.'\\imgs', 0777, true);
			}
			$thumb_s->save($fullpath.'\\imgs'.'\\'.$name);
			$file_size_s=filesize($fullpath.'\\imgs'.'\\'.$name);
			Yii::app()->session['file_size_s']=$file_size_s;
			
		
		
		
			try
			{
				 $thumb_xl = PhpThumbFactory::create($fullpath.'\\'.$name);
			}
			catch (Exception $e)
			{
				 // handle error here however you'd like
			}
			$thumb_xl->adaptiveResize($size_xl_whidth,$size_xl_height);
			if (!file_exists($fullpath.'\\imgxl')) {
				mkdir($fullpath.'\\imgxl', 0777, true);
			}
			$thumb_xl->save($fullpath.'\\imgxl'.'\\'.$name);
			$file_size_xl = filesize($fullpath.'\\imgxl'.'\\'.$name);
			Yii::app()->session['file_size_xl']=$file_size_xl;
								
	}

}

?>