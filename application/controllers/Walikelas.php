<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Walikelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'Wali Kelas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['walikelas'] = $this->db->get_where('walikelas')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('walikelas/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapuswalikelas()
    {
        $email = $this->input->post('email');
        $result = $this->db->get_where('walikelas', ['email' => $email])->row_array();
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($result) {
            // jika user ada
            $this->db->set($email);
            $this->db->where($result);
            $this->db->delete('walikelas', $result);

            $this->db->where($user);
            $this->db->delete('user', $user);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Walikelas berhasil dihapus!</div>
            ');
            redirect('walikelas');
        } else {
            // jika user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Data Walikelas tidak ditemukan!</div>
            ');
            redirect('walikelas');
        }
    }

    public function tambahWalikelas()
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required', [
            'required' => 'nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', [
            'required' => 'email tidak boleh kosong',
            'is_unique' => 'email ini sudah digunakan user lain',
            'valid_email' => 'email tidak valid'
        ]);
        $this->form_validation->set_rules('kelas_binaan', 'Kelas Binaan', 'trim|required|is_unique[walikelas.kelas_binaan]', [
            'required' => 'kelas binaan tidak boleh kosong',
            'is_unique' => 'kelas binaan ini sudah ada walikelasnya!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Wali Kelas';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('walikelas/tambahwalikelas', $data);
            $this->load->view('templates/footer');
        } else {
            // jika validasi lolos
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $data1 = [
                'name' => $name,
                'email' => $email,
                'kelas_binaan' => $this->input->post('kelas_binaan'),
                'role_id' => 3,
                'is_active' => 1,
                'image' => 'default.jpg',
                'date_created' => time()
            ];
            $data2 = [
                'name' => $name,
                'email' => $email,
                'image' => 'default.jpg',
                'password' => $email,
                'role_id' => 3,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('walikelas', $data1);
            $this->db->insert('user', $data2);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! data walikelas berhasil ditambahkan...</div>
            ');
            redirect('walikelas');
        }
    }
}
