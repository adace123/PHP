<?php
require 'vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

class Database {
    private $db;

    public function __construct() {
        try {
            $this->db = (new MongoDB\Client(getenv('MONGO_URL')))->stripe;
        } catch(MongoConnectionException $e) {
            echo 'could not connect';
            echo 'Error ' . $e->getMessage();
        }
    }
    
    public function saveCustomer($customer) {
        $customerCollection = $this->db->customers;
        $customerCollection->insertOne(['id' => $customer['id'], 'first_name' => $customer['first_name']
        , 'last_name' => $customer['last_name'], 'email' => $customer['email'],
        'created_at' => date('Y-m-d H:i:s')]);
    }
    
    public function saveTransaction($charge) {
        $transactionCollection = $this->db->transactions;
        $transactionCollection->insertOne(['id' => $charge->id, 'customer_id' => $charge->customer_id,
        'product' => $charge->product, 'amount' => $charge->amount, 'currency' => $charge->currency,
        'status' => $charge->status, 'created_at' => date('Y-m-d H:i:s')]);
    }
    
    public function getCustomerByEmail($email) {
        $customerCollection = $this->db->customers;
        $results = $customerCollection->find(['email' => $email])->toArray();
        if(count($results) == 0) {
            return null;
        } else return $results[0];
    }
    
    public function fetchAll($table) {
        if($table == 'customers') {
            return json_encode($this->db->customers->find()->toArray());
        } else return json_encode($this->db->transactions->find()->toArray());
    }

}

if($_GET['fetch_all']) {
    $db = new Database();
    echo json_encode(array('customers' => $db->fetchAll('customers'), 'transactions' => $db->fetchAll('transactions')));
}

?>
