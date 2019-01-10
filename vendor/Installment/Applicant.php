<?php 
namespace Installment;

use Installment\Model;

/**
* 
*/
class Applicant
{
	public $isLogin   = false;
	public $detail    = null;
	public $error_msg = '';
	public $limit     = 0;
	public $offset    = 0;
	
	function __construct()
	{
		$this->model = new Model\Data();
	}

	public function getById($id = false){
		if($id){
			return $this->model->find($id);
		}
		
		return null;
	}

	public function getAll($limit = 0)
	{
		$data = $this->model->find('all', array(
			'order' => 'date_created desc',
			'limit' => $limit
			));

		return $data;
	} 

	public function getActive($limit = 0)
	{
		$data = $this->model->find('all', array(
			'conditions' => array("is_active = 1"),
			'order' => 'name asc',
			'limit' => $limit
			));

		return $data;
	}

	public function getAlmostDueDate(){
		$data = $this->model->find('all', array(
			'conditions' => array("is_active = 1 AND is_recurring = 1 AND is_paid = 0 AND date(expire) <= ? AND date(expire) >= ?", date("Y-m-d", strtotime("+3 days")), date("Y-m-d")),
			'order' => 'name asc',
			'limit' => $limit
			));

		return $data;
	}
	
	public function register(){
		\validation::set_message('required', '%field% is required');
		\validation::set_message('email', '%field% should entered with correct email format');
		\validation::set_message('equals', '%reference% not match');

		\validation::set_rule('name', 'Name', 'required');
		\validation::set_rule('email', 'Email', 'required|email');
		\validation::set_rule('phone', 'Phone', 'required');
		\validation::set_rule('address', 'Address', 'required');
		\validation::set_rule('installment_id', 'Installment Programs', 'required');
		\validation::set_rule('term', 'Payment Terms', 'required');
		\validation::set_rule('bank', 'Bank', 'required');
		\validation::set_rule('bank_account', 'Bank Account Name', 'required');
		\validation::set_rule('bank_number', 'Bank Account Number', 'required');

		\validation::run();

		if(\validation::$validate_status){
			if(\Io::param('installment_id')){

				$dataModel = new Model\Data();

				$dataModel->installment_id = \Io::param('installment_id');
				$dataModel->term           = \Io::param('term');
				$dataModel->name           = \Io::param('name');
				$dataModel->email          = \Io::param('email');
				$dataModel->address        = \Io::param('address');
				$dataModel->phone          = \Io::param('phone');
				$dataModel->bank           = \Io::param('bank');
				$dataModel->bank_account   = \Io::param('bank_account');
				$dataModel->bank_number    = \Io::param('bank_number');
				$dataModel->date_created   = date("Y-m-d H:i:s");
				$dataModel->is_active      = 1;
				
				if($dataModel->save()){
					\helper::flashdata("successApply", '<div class="alert alert-success">Thanks for your apply</div>');
					return true;
				} else {
					$this->error_msg = "An error occurred";
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function recurringNotification($id = false){
    if($id){
      $data = $this->model->find($id);

      if($data){
      	if($data->expire->format('j') - date('j') > 0){
      		$dueday = "dalam ".($data->expire->format('j') - date('j'))." hari";
      		$willwait = ($data->expire->format('j') - date('j'))." hari setelah email ini diterima";
      	} else {
      		$dueday = "hari ini";
      		$willwait = "hari ini";
      	}

				$bodyMail = \MailConfig::bodySecondPaymentNotificationMail($data->name, $data->transaction_no, number_format($data->amount + $data->rcode, 0, ",", "."), $dueday, $willwait);

				$bodyMailAdmin = \MailConfig::bodySecondPaymentAdminNotificationMail(
					$data->expire->format("d M Y"),
					$data->transaction_no, 
					$data->description,
					$data->program->name,
					number_format($data->amount + $data->rcode, 0, ",", "."),
					$data->name, 
					$data->email, 
					$data->phone, 
					$data->ktp
				);

				$this->notifyMember($data->name, $data->email, $bodyMail);
				$this->notifyAdmin($bodyMailAdmin);
      }
    }
	}

  public function paymentComplete($id = false){
      if($id){
          
          $data = $this->model->find($id);

          if(is_array($data)){
          	foreach ($data as $key => $value) {
          		//if(strtotime($value->expire) >= time()){ // jika status expire, tidak bisa menyelesaikan pembayaran
          		if(1 == 1){
	          		$value->is_paid = 1;
	          		if($value->save()){

	          			$bodyMail = \MailConfig::bodyPaymentCompleteMail(
																	$value->transaction_no, 
																	$value->description,
																	$value->program->name,
																	number_format($value->amount + $value->rcode, 0, ",", "."),
																	$value->name, 
																	$value->email, 
																	$value->phone, 
																	$value->ktp
																);
	          			$this->sendKwitansi($value->name, $value->email, $bodyMail);
	          		}
          		}
          	}
          	return true;
          } else {
          	$data->is_paid = 1;
        //   	if(strtotime($data->expire) >= time()){// jika status expire, tidak bisa menyelesaikan pembayaran
          	if(1 == 1){
	          	if($data->save()){

	        			$bodyMail = \MailConfig::bodyPaymentCompleteMail(
																$data->transaction_no, 
																$data->description,
																$data->program->name,
																number_format($data->amount + $data->rcode, 0, ",", "."),
																$data->name, 
																$data->email, 
																$data->phone, 
																$data->ktp
															);
	        			$this->sendKwitansi($data->name, $data->email, $bodyMail);

	          		return true;
	          	}
	          }
          }
      }

      return false;
  }

	public function notifyMember($name, $email, $body){
		$mailer = new \mailservice();
		$mailer->initialize(array(
				"ToName" => $name,
				"To" => $email,
				"Subject" => 'Reminder Program Cicilan Tiket Yovie And His Friends',
				"Body" => $body,
				"AltBody" => $body
			));

		$mailer->send();
	}

	public function notifyAdmin($body){
		$mailerAdmin = new \mailservice();
		$mailerAdmin->initialize(array(
				"ToName" => "Admin",
				"To" => MAIL_ADMIN,
				"Subject" => 'Notifikasi Cicilan Kedua',
				"Body" => $body,
				"AltBody" => $body
			));

		$mailerAdmin->send();
	}

	public function sendKwitansi($name, $email, $body){
		$mailer = new \mailservice();
		$mailer->initialize(array(
				"ToName" => $name,
				"To" => $email,
				"AddCC" => MAIL_ADMIN,
				"Subject" => 'Kwitansi Bukti Pembayaran Program Cicilan Tiket Yovie And His Friends',
				"Body" => $body,
				"AltBody" => $body
			));

		$mailer->send();
	}

	public function update(){
		if(\Io::param('nama')){
			$data = $this->model->find(\Io::param('id'));

			// $data->nama = \Io::param('nama');
			// $data->picture = \Io::param('file');
			// $data->ponsel = \Io::param('ponsel');
			// $data->bbm = \Io::param('bbm');
			// $data->kota = \Io::param('kota');
			// $data->place_birth = \Io::param('ponsel');
			// $data->content = \Io::param('content','html');
			// $data->excerpt = \Io::param('excerpt');
			// $data->keywords = \Io::param('keyword');
			// $this->tags = "tags";
			// $data->date_updated = date('Y-M-d h:i:s');
			// $data->date_publish = date('Y-M-d',strtotime(\Io::param('published')));
			// if(\Io::param('unpublished')) $data->date_unpublish = date('Y-M-d',strtotime(\Io::param('unpublished')));
			$data->status = \Io::param('status');
			
			if($data->save())
				return true;
			else
				return false;
		}
	}

  public function delete($id = false){
      if($id){
          if(is_array($id)){
              $this->model->table()->delete(array('id' => $id));

              return true;
          }else{
              $conditions['id'] = $id;

              $this->model->delete_all(array('conditions' => array($conditions) ));

              return true;
          }
      }
  }
}