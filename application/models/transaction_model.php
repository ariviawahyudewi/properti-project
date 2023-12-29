<?php
class Transaction_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllTransactions() {
        return $this->db->get('transactions')->result();
    }

    public function getTransactionById($transaction_id) {
        return $this->db->get_where('transactions', array('id' => $transaction_id))->row();
    }

    public function addTransaction($data) {
        return $this->db->insert('transactions', $data);
    }

    public function updateTransaction($transaction_id, $data) {
        $this->db->where('id', $transaction_id);
        return $this->db->update('transactions', $data);
    }

    public function deleteTransaction($transaction_id) {
        return $this->db->delete('transactions', array('id' => $transaction_id));
    }
}
?>
