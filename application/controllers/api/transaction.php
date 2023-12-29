<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Transaction extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Transaction_model'); // Memuat model transaksi
    }

    public function index_get($transaction_id = null) {
        if ($transaction_id === null) {
            $transactions = $this->Transaction_model->getAllTransactions();
            $this->response($transactions, REST_Controller::HTTP_OK);
        } else {
            $transaction = $this->Transaction_model->getTransactionById($transaction_id);
            if ($transaction) {
                $this->response($transaction, REST_Controller::HTTP_OK);
            } else {
                $this->response(['message' => 'Transaction not found'], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post() {
        $transaction_data = array(
            'id_properti' => $this->post('id_properti'),
            'jumlah' => $this->post('jumlah'),
            'metode_pembayaran' => $this->post('metode_pembayaran'),
            'tanggal_transaksi' => $this->post('tanggal_transaksi')
            // Tambahkan atribut transaksi lainnya yang sesuai dengan struktur tabel
        );

        $created_transaction = $this->Transaction_model->addTransaction($transaction_data);
        if ($created_transaction) {
            $this->response(['message' => 'Transaction added successfully'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Failed to add transaction'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index_put($transaction_id) {
        $transaction_data = array(
            'id_properti' => $this->put('id_properti'),
            'jumlah' => $this->put('jumlah'),
            'metode_pembayaran' => $this->put('metode_pembayaran'),
            'tanggal_transaksi' => $this->put('tanggal_transaksi')
            // Tambahkan atribut transaksi lainnya yang sesuai dengan struktur tabel
        );
    
        $updated_transaction = $this->Transaction_model->updateTransaction($transaction_id, $transaction_data);
        if ($updated_transaction) {
            $this->response(['message' => 'Transaction updated successfully'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Failed to update transaction'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function index_delete($transaction_id) {
        $deleted_transaction = $this->Transaction_model->deleteTransaction($transaction_id);
        if ($deleted_transaction) {
            $this->response(['message' => 'Transaction deleted successfully'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Failed to delete transaction'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
?>
