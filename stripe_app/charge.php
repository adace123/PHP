<?php

require_once('vendor/autoload.php');
require_once('./db.php');
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

class Stripe {
    private $token;
    private $customer;
    private $db;

    public function __construct($stripe_secret, $token) {
        $this->token = $token;
        $this->db = new Database();
        \Stripe\Stripe::setApiKey($stripe_secret);
    }
    
    public function createCustomer($first_name, $last_name, $email) {
        $matchingCustomer = $this->db->getCustomerByEmail($email);
        if($matchingCustomer == null) {
            $this->customer = \Stripe\Customer::create(['source' => $this->token, 'email' => $email]);
            $this->customer['first_name'] = $_POST['first_name'];
            $this->customer['last_name'] = $_POST['last_name'];
            $this->db->saveCustomer($this->customer);
        } else $this->customer = $matchingCustomer;
    }
    
    public function createCharge($product, $amount) {
        $charge = \Stripe\Charge::create(array('amount' => $amount * 100,
        'description' => 'Purchased ' . $product, 
        'currency' => 'usd', 
        'customer' => $this->customer['id'],
        'receipt_email' => $_POST['email']));
        $charge['customer_id'] = $this->customer['id'];
        $charge['product'] = $product;
        $charge['amount'] = $amount;
        $this->db->saveTransaction($charge);
        header('Location: success.php?tid=' . $charge->id . '&product=' . $product);
    }

}

$stripe = new Stripe(getenv('STRIPE_SECRET'), $_POST['stripeToken']);
$stripe->createCustomer($_POST['first_name'], $_POST['last_name'], $_POST['email']);
$stripe->createCharge($_POST['product'], $_POST['amount']);
?>
