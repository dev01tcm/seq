<?php

class ImportUploadHandle extends UploadHandler
{
	/* Process after uploaded */
    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error, $index = null, $content_range = null)   {
        $file = parent::handle_file_upload($uploaded_file, $name, $size, $type, $error, $index, $content_range);
		if (!empty($file->error)) { 
			$file->error = Yii::t('err',$file->error); 
		} else { 
		
			$fullpath=Yii::app()->params['prg_ctrl']['path']['upload_banner'];
			$fullurl=Yii::app()->params['prg_ctrl']['url']['upload_banner'];
			$model=new frm_banner;
			$model->save_insert($name, $fullpath, $fullurl, $size);
			
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
    protected function get_file_name($file_path, $name, $size, $type, $error,
            $index, $content_range) {
		return $name;
    }


		

}
?>