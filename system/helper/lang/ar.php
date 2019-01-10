<?php 
/**
* 
*/
class ar
{
	public static function phrase($param){

		$word["home"]           = "بيت";
		$word["search"]         = "بحث";
		$word["what_are_we"]    = "ما هو مركز العالم الإسلامي";
		$word["read_more"]      = "اقرأ المزيد";
		$word["article"]        = "مقالة";
		$word["activity"]       = "نشاط";
		$word["newest"]         = "أحدث";
		$word["popular"]        = "شعبية";
		$word["akhlaq"]         = "أخلاق";
		$word["news"]           = "أنباء";
		$word["find_article"]   = "بحث المادة";
		$word["find_us"]        = "البحث عن بنا";
		$word["calculator"]     = "آلة حاسبة";
		$word["contact_us"]     = "اتصل بنا";
		$word["nasehat"]        = "نصيحة";
		$word["tag"]            = "بطاقة";
		$word["video"]          = "فيديو";
		$word["subscribe_word"] = "اشترك في النشرة الإخبارية لدينا";
		$word["subscribe_ph"]   = "بريد الالكتروني";
		$word["subscribe_bt"]   = "الاشتراك";

		return $word[$param];
	}
}