<?php

/**
* 
*/
class Upload
{
	
	function __construct()
	{
		$this->initialize();
	}

	public function initialize($config = null)
	{
        $this->prefix = 'upload';
        $this->thumbnails = array('500x500');
        $this->legal_size = 3000000;
        $this->legal_extension = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
        $this->path = PATH;
        $this->folder = 'upload/';
        $this->thumbs = 'thumbs/';
        $this->tree = '';
        $this->encryptName = true;

        if($config){
            foreach ($config as $key => $value) {
                $this->$key = $value;
            }
        }
	}

	public function upload_image() {

        $image = $this->file;
        $prefix = $this->prefix;

        $prefix = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $prefix);
        $prefix = strtolower(trim($prefix, '-'));
        $prefix = preg_replace("/[\/_|+ -]+/", '-', $prefix);

        $legal_size      = $this->legal_size;
        $legal_extension = $this->legal_extension;

        $image_name      = $image['name'];
        $image_type      = $image['type'];
        $image_size      = $image['size'];
        $image_error     = $image['error'];
        $image_tmp       = $image['tmp_name'];

        $expd = explode( '.', $image_name );
        $extension       = end( $expd );
        $file            = str_replace( ' ', '_', $prefix.'_'.date('ymdHis') );
        
        if($this->encryptName) $file = md5($file).".".$extension;
        else $file = $file.".".$extension;
        
        $path            = $this->path.$this->folder.$this->tree;
        $target          = $path . $file;

        $flag			 = true;

        $this->filename = $file;

        $this->imagetype = $image_type;

        $this->filesize = $image_size;

        $this->filetype = $extension;

        if ( $image_error == UPLOAD_ERR_OK ) {
            if( is_uploaded_file( $image_tmp ) ) {
                if( $image_size < $legal_size) {  
                    // if ( ($image_type == 'image/jpg') || ($image_type == 'image/jpeg') || ($image_type == 'image/png') && in_array( $extension, $legal_extension ) ) {
                    if ( in_array( $extension, $legal_extension ) ) {
                        /*
                        if ( file_exists( $target ) ) {
                            $message = 'Sorry '.$file.' already exists.';
                        }
                        */
                        if( move_uploaded_file( $image_tmp, $target ) ) {
                            // $upload = $this->upload_save( $setting, $file, $for );
                            $upload = true;
                            if ( $upload ) {
                                if ( ($image_type == 'image/jpg') || ($image_type == 'image/jpeg') || ($image_type == 'image/png') ) {
                                    $crop = $this->crop();
                                }
                                else $crop = true;
                                
                                if($crop){
                                    $message = 'Ok, file is uploaded.';
                                }
                                else{
                                    $message = 'Sorry, file was uploaded, but failed create thumbnails.';
                                    $flag = false;
                                }
                            } else {
                                $message = 'Sorry. there was a problem saving your file.';
            					$flag = false;
                            }
                        } else {
                            $message = 'Sorry, there was a problem uploading your file.';
            				$flag = false;
                        }
                    } else {
                        $message = 'File not allowed. Please upload file with extention .jpg, .jpeg, .png.';
            			$flag = false;
                    }
                } else {
                    $message = 'File exceeds the Maximum File limit. Maximum File limit is '.$legal_size.' bytes. File '.$image_name.' is '.$image_size.
                    ' bytes';
            		$flag = false;
                }
            } else {
                $message = 'File not uploaded successfully.';
            	$flag = false;
            }
        } else {
            $message = $this->upload_error( $image_error );
            $flag = false;
        }

        $this->err_msg = $message;

        return $flag;
    }

    private function upload_error( $error ) {
        switch ($error) {
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
            case UPLOAD_ERR_PARTIAL:
                return 'The uploaded file was only partially uploaded.';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk.';
            case UPLOAD_ERR_EXTENSION:
                return 'File upload stopped by extension.';
            default:
                return 'Unknown upload error';
        }
    }

    private function crop()
    {
        $flag = true;
        $path = $this->path.$this->folder.$this->tree;
        $file = $this->filename;
        $type = $this->filetype;
        // The file
        $filename = $path.$file;
        $file = explode(".", $file);
        $new = $this->path.$this->thumbs.$this->tree.$file[0];

        switch (strtolower($type)) {
            case "gif":
                $image = imagecreatefromgif($filename);
                break;
     
            case "jpg":
                $image = imagecreatefromjpeg($filename);
                break;
     
            case "jpeg":
                $image = imagecreatefromjpeg($filename);
                break;
     
            case "png":
                $image = imagecreatefrompng($filename);
                break;
     
            default;
                throw new Exception('Invalid image type');
        }

        foreach ($this->thumbnails as $value) {
            $value = explode("x", $value);
            $new_width = $value[0];
            $new_height = $value[1];
            // Get new dimensions
            list($width, $height) = getimagesize($filename);
            $srcX = 0;
            $srcY = 0;

            if($new_width > $new_height){
                $ori_height = $height;
                $height = $width * $new_height / $new_width;
                $srcY = ($ori_height - $height) / 2;

                if($height > $ori_height){
                    $height = $ori_height;
                    $ori_widht = $width;
                    $width = $height * $new_width / $new_height;
                    $srcY = 0;
                    $srcX = ($ori_widht - $width) / 2;
                }

            } else {
                $ori_widht = $width;
                $width = $height * $new_width / $new_height;
                $srcX = ($ori_widht - $width) / 2;
                
                if($width > $ori_widht){
                    $width = $ori_widht;
                    $ori_height = $height;
                    $height = $width * $new_height / $new_width;
                    $srcX = 0;
                    $srcY = ($ori_height - $height) / 2;
                }
            }

            // Resample
            $image_p = imagecreatetruecolor($new_width, $new_height);
            
            // imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagecopyresampled( 
                // resource dst_im, resource src_im, 
                $image_p, $image,  
                // int dstX, int dstY, 
                0, 0,  
                // int srcX, int srcY, 
                $srcX, $srcY,  
                // int dstW, int dstH, 
                $new_width, $new_height,  
                // int srcW, int srcH 
                $width,    $height 
            );  
            // Output
            $flag = imagejpeg($image_p, $new."_".$new_width."x".$new_height.".".$type, 100);
        }

        return $flag;
    
    }
}