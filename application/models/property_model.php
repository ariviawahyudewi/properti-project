<?php
class Property_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Inisialisasi database
    }


    // Mendapatkan semua properti
    public function get_all_properties() {
        return $this->db->get('properties')->result();
    }

    // Mendapatkan properti berdasarkan ID
    public function get_property_by_id($property_id) {
        return $this->db->get_where('properties', array('id' => $property_id))->row();
    }

    // Menambahkan properti baru
    public function add_property($data) {
        return $this->db->insert('properties', $data);
    }

    // Mengupdate properti berdasarkan ID
    public function update_property($property_id, $data) {
        $this->db->where('id', $property_id);
        return $this->db->update('properties', $data);
    }

    // Menghapus properti berdasarkan ID
    public function delete_property($property_id) {
        return $this->db->delete('properties', array('id' => $property_id));
    }
}
?>
