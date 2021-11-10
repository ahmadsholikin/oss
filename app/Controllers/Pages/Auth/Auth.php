<?php namespace App\Controllers\Pages\Auth;
use App\Controllers\FrontendController;
use App\Models\Auth\LoginModel;

class Auth extends FrontendController
{
	public $path_view 	= "pages/auth/";
	public $theme		= "pages/theme-frontend/render";

	public function __construct()
    {
		$this->session      = session();
		$this->LoginModel   = new LoginModel();
    }

	public function index()
	{
		return view('frontend/home/page-sso');
	}

	public function signin()
	{
		$email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');

        // bagian awal validasi
        $post_validasi['email']       = $email;
        $post_validasi['password']    = $password;

        $validation = \Config\Services::validation();
        if($validation->run($post_validasi,'form_login')==false)
        {
            $this->session->setFlashdata('flash_auth_email_class', '-danger');
            $this->session->setFlashdata('flash_auth_email_info', 'Wajib diisi dengan email yang valid | Minimal 10 karakter');
            $this->session->setFlashdata('flash_auth_password_class', '-danger');
            $this->session->setFlashdata('flash_auth_password_info', 'Wajib diisikan | Minimal 5 karakter');
            return redirect()->back();
        }
        // bagian akhir validasi

        // proses autentikasi
		$cek_akun = $this->LoginModel->cek($email,$password);
        if(!$cek_akun)
        {
            //cek SSO ke SIPGAN
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://sipgan.magelangkab.go.id/sipgan/api/restpns/nipnik?nip=".$email."&nik=".$password."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 3cc774ba-ae19-2221-5563-8794c5c22757"
            ),
            ));

            $response   = curl_exec($curl);
            $err        = curl_error($curl);
            $info       = json_decode($response);

            curl_close($curl);

            if (($err)||($info->status<>'true'))
            {
                $this->session->setFlashdata('flash_auth_email_class', '-danger');
                $this->session->setFlashdata('flash_auth_email_info', 'Akun tersebut tidak ditemukan. Mohon cek kembali');

                $output = [
                    'status'    => 401,
                    'message'   => 'Login failed',
                ];
                //return $this->respond($output, 401);
                $this->session->setFlashdata('flash_auth_email',  $email);
                $this->session->setFlashdata('flash_auth_password',  $password);
                $this->session->setFlashdata('flash_auth_password_class', '-danger');
                $this->session->setFlashdata('flash_auth_password_info', 'Kata sandi yang Anda entrikan salah.');
                return redirect()->back();
            } 
            else
            {
              
                $user = array(
                    "email"      => $info->data[0]->pns_email,
                    "foto"       => "https://sipgan.magelangkab.go.id/sipgan/images/photo/".$email.".jpg",
                    "user_id"    => $info->data[0]->pns_urut,
                    "username"   => $info->data[0]->pns_nm,
                    "nip"        => $info->data[0]->pns_nip_18,
                    "kontak"     => $info->data[0]->pns_no_telp_1,
                    "alamat"     => $info->data[0]->pns_almt,
                    "kontak_2"   => $info->data[0]->pns_no_telp_2,
                    "group_id"   => 4,
                    "group_nama" => "User",
                    'logged_in'  => TRUE,
                    "user_image" => "",
                );
                $this->session->set($user);
                return redirect()->to(backend_url().'/beranda');
            }   
        }
        else
        {
            $user = array(
				"email"      => $cek_akun['email'],
                "foto"       => base_url()."/writable/uploads/".$cek_akun['foto'],
                "user_id"    => $cek_akun['user_id'],
                "username"   => $cek_akun['username'],
                "group_id"   => $cek_akun['group_id'],
                "group_nama" => $cek_akun['group_nama'],
                "nip"        => "",
				'logged_in'  => TRUE,
				"user_image" => "",
                "kontak"     => "",
                "alamat"     => "",
                "kontak_2"   => "",
			);
            $this->session->set($user);
            return redirect()->to(backend_url().'/beranda');
        }
    }
    
    public function signout()
    {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}