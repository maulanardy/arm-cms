<?php 
namespace Installment;

use Installment\Model;

/**
* 
*/
class Main
{
	public $isLogin   = false;
	public $detail    = null;
	public $error_msg = '';
	public $limit     = 0;
	public $offset    = 0;
	
	function __construct()
	{
		$this->model = new Model\Main();
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
			'order' => 'id asc',
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
		// \validation::set_rule('address', 'Address', 'required');
		\validation::set_rule('installment_id', 'Installment Programs', 'required');
		\validation::set_rule('term', 'Payment Terms', 'required');
		// \validation::set_rule('bank', 'Bank', 'required');
		// \validation::set_rule('bank_account', 'Bank Account Name', 'required');
		// \validation::set_rule('bank_number', 'Bank Account Number', 'required');
		\validation::set_rule('ktp', 'No KTP', 'required');

		\validation::run();

		if(\validation::$validate_status){
			if(\Io::param('installment_id')){

				$term = 2;
				$installment = $this->getById(\Io::param('installment_id'));

				if($installment){
					$randcode = $this->getRandomCode();
					$notrx = date("ymdHi").$randcode;
					$amount = ceil($installment->price / $term);

					$status = true;

					for ($i=0; $i < $term; $i++) { 
						$dataModel = new Model\Data();
						$dataModel->installment_id  = \Io::param('installment_id');
						$dataModel->transaction_no  = $notrx.($i>0?$i:"");
						$dataModel->description     = "Termin cicilan ke ".($i+1);
						// $dataModel->term         = \Io::param('term');
						$dataModel->term            = $term;
						$dataModel->name            = \Io::param('name');
						$dataModel->email           = \Io::param('email');
						// $dataModel->address      = \Io::param('address');
						$dataModel->ktp             = \Io::param('ktp');
						$dataModel->phone           = \Io::param('phone');
						// $dataModel->bank         = \Io::param('bank');
						// $dataModel->bank_account = \Io::param('bank_account');
						// $dataModel->bank_number  = \Io::param('bank_number');
						$dataModel->amount          = $amount;
						$dataModel->rcode           = $randcode;
						$dataModel->expire          = $i == 0 ? date("Y-m-d H:i:s", strtotime('+2 hours')) : date_create(date("Y-m", strtotime('+1 months'))."-17 23:59:59");;
						$dataModel->date_created    = date("Y-m-d H:i:s");
						$dataModel->is_active       = 1;
						$dataModel->is_recurring    = $i == 0 ? 0 : 1;

						if($dataModel->save()){

						} else {
							$status = false;
						}
					}
					
					if($status){
						\helper::flashdata("successApply", '<div class="alert alert-success">Thanks for your apply</div>');

						$bodyMail = \MailConfig::bodyFirstPaymentNotificationMail(\Io::param('name'), $notrx, number_format($amount + $randcode, 0, ",", ".") );

						$bodyMailAdmin = \MailConfig::bodyFirstPaymentAdminNotificationMail(
							date("d M Y"),
							$notrx, 
							"Termin cicilan ke 1",
							$installment->name,
							number_format($amount + $randcode, 0, ",", "."),
							\Io::param('name'), 
							\Io::param('email'), 
							\Io::param('phone'), 
							\Io::param('ktp')
						);

						$this->notifyMember($bodyMail);
						$this->notifyAdmin($bodyMailAdmin);

						return true;
					} else {
						$this->error_msg = "An error occurred";
						return false;
					}
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function notifyMember($body){
		$mailer = new \mailservice();
		$mailer->initialize(array(
				"ToName" => \Io::param('name'),
				"To" => \Io::param('email'),
				"Subject" => 'Konfirmasi Program Cicilan Tiket Yovie And His Friends',
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
				"Subject" => 'Request Cicilan',
				"Body" => $body,
				"AltBody" => $body
			));

		$mailerAdmin->send();
	}

	public function getRandomCode(){
		$rcode = 9;

		do{

			$rcode++;
 			$mModel = new Model\Data();
			$data = $mModel->find(array(
				"conditions" => array("rcode = ? AND is_paid = 0 AND expire > ?", $rcode, date("Y-m-d H:i:s", strtotime('-24 hours')))
			));

		} while ($data);

		return $rcode;
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