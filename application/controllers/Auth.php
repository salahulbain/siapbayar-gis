<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIAP-bayar Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // jika validasinya success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        $userWalikelas = $this->db->get_where('walikelas', ['email' => $email])->row_array();

        //jika User ada
        if ($user) {
            // jika user aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Salah!</div>
                    ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                email belum di aktifkan!</div>
                ');
                redirect('auth');
            }
        } else if ($userWalikelas) {
            // jika user ada
            if ($password == $userWalikelas['email']) {
                $data = [
                    'email' => $userWalikelas['email'],
                    'role_id' => $userWalikelas['role_id']
                ];

                $this->session->set_userdata($data);
                redirect('teacher');
            }
        } else {
            //user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email ini belum di registrasi!</div>
            ');
            redirect('auth');
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'email ini sudah pernah terdaftar!',
            'required' => 'email tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('koreg', 'Kode registrasi', 'required|trim|numeric|exact_length[8]|regex_match[/10107307/]', [
            'regex_match' => 'kode registrasi salah!',
            'exact_length' => 'kode registrasi harus berjumlah 8 angka!',
            'required'  => 'kode registrasi tidak boleh kosong!',
            'numeric' => 'kode registrasi harus berupa angka!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'password tidak boleh kosong!',
            'matches' => 'password tidak cocok!',
            'min_length'    => 'password terlalu pendek, minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIAP-bayar Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email'        => $email,
                'token'        => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! akun berhasil di registrasi. silahkan periksa email untuk aktivasi akun</div>
            ');
            redirect('auth');
        }
    }


    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'siapbayaronline@gmail.com',
            'smtp_pass' => 'rahasiasangat',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('siapbayaronline@gmail.com', 'SIAP Bayar');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Kode Aktivasi Akun SIAP Bayar');
            $this->email->message('silahkan klick tombol berikut untuk aktivasi akun SIAP Bayar : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" type="button" style="color: green;">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password Akun SIAP Bayar');
            $this->email->message('silahkan klick tombol berikut untuk reset password akun SIAP Bayar : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" type="button" style="color: green;">Reset Password</a>');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . '
                    berhasil diaktifkan, silahkan login!</div>
                    ');
                    redirect('auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Aktivasi gagal, token anda expired!</div>
                    ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Aktivasi gagal, token anda salah!</div>
        ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Aktivasi gagal, email salah!</div>
        ');
            redirect('auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('rol_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        anda sudah logged out!</div>
        ');
        redirect('auth');
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIAP-bayar Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgotpassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                // siapkan token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Cek email anda untuk reset password</div>
                ');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email belum di registrasi atau belum diaktifkan</div>
                ');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            // jika user ada.
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                // jika token ada
                // buat session untuk change password.
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                // jika token tidak ada
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password gagal !, token salah.</div>
            ');
                redirect('auth');
            }
        } else {
            // jika user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password gagal !, email salah.</div>
            ');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIAP-bayar Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/changepassword');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            // hapus sesi change password
            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            password berhasil diganti !, silahkan login.</div>
            ');
            redirect('auth');
        }
    }
}
