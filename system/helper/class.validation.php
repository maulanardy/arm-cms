<?php

class validation
{
	private static $validate_item, $error_message, $err;
	public static $validate_error, $validate_status = true;

	public static function set_rule($name, $label, $rules)
	{
		self::$validate_item[$name]['label'] = $label;
		self::$validate_item[$name]['value'] = helper::getParam($name);
		self::$validate_item[$name]['rules'] = $rules; 
	}

	public static function run()
	{
		$item = self::$validate_item;

		foreach ($item as $key => $value) {
			
			$rule = explode("|", $value['rules']);

			foreach ($rule as $k => $v) {

				$v = explode(".", $v);

				if($v[2]) {
					call_user_func("self::$v[0]", $key, $v[1], $v[2]);
            // self::$v[0]($key, $v[1], $v[2]);
        }elseif($v[1]){
					call_user_func("self::$v[0]", $key, $v[1]);
           // self::$v[0]($key, $v[1]);
				}else{
					call_user_func("self::$v[0]", $key);
					// self::$v[0]($key);
				}

			}

		}
		
		helper::flashdata('validation_error',self::$err);
	}

	public static function set_message($rule = '', $messages = '')
	{
		if($rule != ''){
			self::$error_message[$rule] = $messages;
		}
	}

	private static function required($field)
	{
		if(empty( self::$validate_item[$field]['value'] )){

			$label = self::$validate_item[$field]['label'];

			$error_message = "Field ".$label." is required";

			if(!empty(self::$error_message['required'])){
				$error_message = self::$error_message['required'];
				$error_message = str_replace("%field%", $label, $error_message);
			}

			self::$err[$field][] = $error_message;

			self::$validate_status = false;

		}
	}

	private static function checked($field)
	{
		if(empty( self::$validate_item[$field]['value'] )){

			$label = self::$validate_item[$field]['label'];

			$error_message = "Field ".$label." is required";

			if(!empty(self::$error_message['checked'])){
				$error_message = self::$error_message['checked'];
				$error_message = str_replace("%field%", $label, $error_message);
			}

			self::$err[$field][] = $error_message;

			self::$validate_status = false;

		}
	}

	private static function general($field)
	{
		if(!empty(self::$validate_item[$field]['value'])){
			if(!preg_match('/^[0-9A-Za-z.,\s ]+$/', self::$validate_item[$field]['value'] )){

				$label = self::$validate_item[$field]['label'];

				$error_message = "Field ".$label." require as character or number format";

				if(!empty(self::$error_message['general'])){
					$error_message = self::$error_message['general'];
					$error_message = str_replace("%field%", $label, $error_message);
				}

				self::$err[$field][] = $error_message;

				self::$validate_status = false;

			}
		}
	}

	private static function numberonly($field)
	{
		if(!empty(self::$validate_item[$field]['value'])){
			if(!is_numeric( self::$validate_item[$field]['value'] )){

				$label = self::$validate_item[$field]['label'];

				$error_message = "Field ".$label." require as number format";

				if(!empty(self::$error_message['numberonly'])){
					$error_message = self::$error_message['numberonly'];
					$error_message = str_replace("%field%", $label, $error_message);
				}

				self::$err[$field][] = $error_message;

				self::$validate_status = false;
			}
		}
	}

	private static function email($field)
	{
		if(!filter_var(self::$validate_item[$field]['value'], FILTER_VALIDATE_EMAIL)){

			$label = self::$validate_item[$field]['label'];

			$error_message = "Field ".$label." require as corect email format";

			if(!empty(self::$error_message['email'])){
				$error_message = self::$error_message['email'];
				$error_message = str_replace("%field%", $label, $error_message);
			}

			self::$err[$field][] = $error_message;

			self::$validate_status = false;
		}
	}

	private static function captcha($field)
	{
		if(strtolower(self::$validate_item[$field]['value']) != $_SESSION["captcha"]){

			$label = self::$validate_item[$field]['label'];

			$error_message = "Field ".$label." is not correct";

			if(!empty(self::$error_message['captcha'])){
				$error_message = self::$error_message['captcha'];
				$error_message = str_replace("%field%", $label, $error_message);
			}

			self::$err[$field][] = $error_message;

			self::$validate_status = false;
		}
	}


	private static function equals($field, $reference)
	{
		$val_reference = self::$validate_item[$reference]['value'];
		$value = self::$validate_item[$field]['value'];

		if($value != $val_reference){
			$label = self::$validate_item[$field]['label'];
			$label_ref = self::$validate_item[$reference]['label'];

			$error_message = "Field ".$label." isn't matching to ".$reference;

			if(!empty(self::$error_message['equals'])){
				$error_message = self::$error_message['equals'];
				$error_message = str_replace("%field%", $label, $error_message);
				$error_message = str_replace("%reference%", $label_ref, $error_message);
			}

			self::$err[$field][] = $error_message;

			self::$validate_status = false;
		}
	}


    private static function is_unique($field, $table, $row)
    {
        $value = self::$validate_item[$field]['value'];

        $result = $table::count(array(
           'conditions' => array($row.' = ?', $value)
        ));

        if($result > 0){
            $label = self::$validate_item[$field]['label'];

            $error_message = "Field ".$label." needs unique value";

            if(!empty(self::$error_message['is_unique'])){
                $error_message = self::$error_message['is_unique'];
                $error_message = str_replace("%field%", $label, $error_message);
            }

            self::$err[$field][] = $error_message;

            self::$validate_status = false;
        }

//        if($value != $val_reference){
//            $label = self::$validate_item[$field]['label'];
//            $label_ref = self::$validate_item[$reference]['label'];
//
//            $error_message = "Field ".$label." isn't matching to ".$reference;
//
//            if(!empty(self::$error_message['equals'])){
//                $error_message = self::$error_message['equals'];
//                $error_message = str_replace("%field%", $label, $error_message);
//                $error_message = str_replace("%reference%", $label_ref, $error_message);
//            }
//
//            self::$err[$field][] = $error_message;
//
//            self::$validate_status = false;
//        }
    }

	public static function error_message()
	{
        $error = helper::flashdata('validation_error');
        $res = '';

        if($error){
	        foreach ($error as $v) {
	          foreach ($v as $w) {
	            $res .= '<div class="alert alert-danger">'.$w.'</div>';
	          }
	        }
	    }

        return $res;
    }
}