<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->db->get_where('data_siswa')->result_array();
        $data['walikelas'] = $this->db->get_where('walikelas')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function tambahSiswa()
    {
        $data['title'] = 'Tambah Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['walikelas'] = $this->db->get_where('walikelas')->result_array();

        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|is_unique[data_siswa.nik]', [
            'required' => 'NIK tidak Boleh Kosong!',
            'numeric'  => 'NIK harus berupa angka!',
            'is_unique' => 'NIK sudah terdaftar'
        ]);
        $this->form_validation->set_rules('nok', 'NO KK', 'required|trim|numeric', [
            'required' => 'No KK tidak Boleh Kosong!',
            'numeric'  => 'No KK harus berupa angka!'
        ]);
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim', [
            'required' => 'Nama siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
            'required' => 'jenis kelamin harus dipilih'
        ]);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required', [
            'required' => 'kelas harus dipilih'
        ]);
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required|trim', [
            'required' => 'Nama ibu tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/tambahsiswa', $data);
            $this->load->view('templates/footer', $data);
        } else {
            //insert data siswa
            $data = [
                'nik'           => htmlspecialchars($this->input->post('nik', true)),
                'nok'           => htmlspecialchars($this->input->post('nok', true)),
                'nama_siswa'    => htmlspecialchars($this->input->post('nama_siswa', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'kelas'         => htmlspecialchars($this->input->post('kelas', true)),
                'nama_ayah'     => htmlspecialchars($this->input->post('nama_ayah', true)),
                'nama_ibu'      => htmlspecialchars($this->input->post('nama_ibu', true)),
                'alamat_ortu'   => htmlspecialchars($this->input->post('alamat_ortu', treu))
            ];

            $this->db->insert('data_siswa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! data siswa berhasil di tambah</div>
            ');
            redirect('siswa');
        }
    }


    public function detail()
    {
        $nik = $this->input->post('nik');

        $result = $this->db->get_where('data_siswa', ['nik' => $nik]);

        if ($result) {
            $data['detail'] = $this->db->get_where('data_siswa', ['nik' => $nik])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('siswa/detail', $data);
        }
    }


    public function hapusDataSiswa()
    {
        $nik = $this->input->post('nik');
        $result = $this->db->get_where('data_siswa', ['nik' => $nik])->row_array();

        if ($result) {
            $this->db->where('nik', $nik);
            $this->db->delete('data_siswa');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Siswa Berhasil dihapus!</div>
            ');
            redirect('siswa');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Data Siswa gagal dihapus!, data siswa tidak ditemukan</div>
            ');
            redirect('siswa');
        }
    }

    public function transaksi()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->db->get_where('data_siswa')->result_array();
        $data['transaksi'] = $this->db->get_where('transaksi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/transaksi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editSiswa()
    {
        $nik = $this->input->post('nik');
        $result = $this->db->get_where('data_siswa', ['nik' => $nik])->row_array();

        if ($result) {
            // jika data ada
            $this->form_validation->set_rules('nok', 'NO KK', 'required|trim|numeric');
            $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('kelas', 'Kelas', 'required');
            $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Data Siswa gagal diupdate, harap isi semua data dengan benar !</div>
            ');
                redirect('siswa');
            } else {
                // siapkan data
                $data = [
                    'nik'           => htmlspecialchars($this->input->post('nik', true)),
                    'nok'           => htmlspecialchars($this->input->post('nok', true)),
                    'nama_siswa'    => htmlspecialchars($this->input->post('nama_siswa', true)),
                    'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                    'kelas'         => htmlspecialchars($this->input->post('kelas', true)),
                    'nama_ayah'     => htmlspecialchars($this->input->post('nama_ayah', true)),
                    'nama_ibu'      => htmlspecialchars($this->input->post('nama_ibu', true)),
                    'alamat_ortu'   => htmlspecialchars($this->input->post('alamat_ortu', treu))
                ];

                $this->db->set($data);
                $this->db->where('nik', $nik);
                $this->db->update('data_siswa', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! data siswa berhasil di ubah</div>
            ');
                redirect('siswa');
            }
        } else {
            // jika data tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Data Siswa gagal diupdate!, data siswa tidak ditemukan</div>
            ');
            redirect('siswa');
        }
    }

    public function tambahTransaksi()
    {
        $nik = $this->input->post('nik_siswa');
        $result = $this->db->get_where('data_siswa', ['nik' => $nik])->row_array();

        if ($result) {
            $this->form_validation->set_rules('nama_walikelas', 'Nama Walikelas', 'required|trim');
            $this->form_validation->set_rules('jmlh_iuran', 'jumlah Iuran Wajib', 'required|trim|numeric');
            $this->form_validation->set_rules('jmlh_bayar', 'jumlah Bayar', 'required|trim|numeric');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');

            if ($this->form_validation->run() == false) {
                // jika form gagal
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data transaksi siswa gagal dibuat!, harap input form dengan benar</div>
                ');
                redirect('siswa');
            } else {
                // jika form validasi berhasil, siapkan data
                $data = [
                    'nik_siswa'         => htmlspecialchars($this->input->post('nik_siswa', true)),
                    'nama_siswa'        => htmlspecialchars($this->input->post('nama_siswa', true)),
                    'kelas'             => htmlspecialchars($this->input->post('kelas', true)),
                    'nama_walikelas'    => htmlspecialchars($this->input->post('nama_walikelas', true)),
                    'jmlh_iuran'        => htmlspecialchars($this->input->post('jmlh_iuran', true)),
                    'jmlh_bayar'        => htmlspecialchars($this->input->post('jmlh_bayar', true)),
                    'status'            => htmlspecialchars($this->input->post('status', true)),
                ];

                $this->db->insert('transaksi', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                data transaksi siswa berhasil di tambah</div>
                ');
                redirect('siswa');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            data siswa tidak ditemukan</div>
            ');
            redirect('siswa');
        }
    }
}
