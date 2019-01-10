<?php
namespace Ma\Controller\Setting;

class Main
{
	public static function get($setting_key){
		$data = \Ma\Model\Setting\Main::first('all',array('conditions' => array('key' => $setting_key)));

		if($data)
			return $data->value;
		else
			return '';
	}

	public static function getObj($setting_key){
		$data = \Ma\Model\Setting\Main::first('all',array('conditions' => array('key' => $setting_key)));

		if($data)
			return $data;
		else
			return '';
	}
}