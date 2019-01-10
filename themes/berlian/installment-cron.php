<?php 
$applicantController = new Installment\Applicant();

$programList = $applicantController->getAlmostDueDate();

foreach ($programList as $key => $value) {
	Io::pre($value->transaction_no);
	$applicantController->recurringNotification($value->id);
}

?>