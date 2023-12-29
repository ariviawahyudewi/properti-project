<?php
class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Mengecek kredensial pengguna untuk proses login
    public function check_credentials($username, $password) {
        $query = $this->db->get_where('users', array('username' => $username));
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }

    // Mendapatkan informasi pengguna berdasarkan ID
    public function get_user_by_id($user_id) {
        return $this->db->get_where('users', array('id' => $user_id))->row();
    }

    // Menambahkan pengguna baru
    public function add_user($data) {
        return $this->db->insert('users', $data);
    }

    // Mengupdate informasi pengguna berdasarkan ID
    public function update_user($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    // Menghapus pengguna berdasarkan ID
    public function delete_user($user_id) {
        return $this->db->delete('users', array('id' => $user_id));
    }
}
?>
