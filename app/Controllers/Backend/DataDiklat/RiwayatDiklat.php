<?php namespace App\Controllers\Backend\DataDiklat;
use App\Controllers\BackendController;
use App\Models\DataDiklat\KategoriDiklatModel;

class RiwayatDiklat extends BackendController
{
    public $path_view = 'backend/datadiklat/riwayatdiklat/';
    public $theme     = 'pages/theme-backend/render';


    public function __construct()
    {
        $this->session              = session();
        $this->sipgan               = db_connect('sipgan');
        $this->KategoriDiklatModel  = new KategoriDiklatModel(); 
    }

    public function index()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }
        
        $sql            = "SELECT * FROM db8diktekfung WHERE pns_urut = ? ORDER BY th_agkt_dik DESC";
        $exec           = $this->sipgan->query($sql,[$_SESSION['user_id']]);
        $data['data']   = $exec->getResultArray();
        $param['page']  = view($this->path_view . 'page-index',$data);
        return view($this->theme, $param);
    }

    public function add()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;
        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }
        $data['kategori_diklat']    = $this->KategoriDiklatModel->get();
        $param['page']              = view($this->path_view . 'page-add',$data);
        return view($this->theme, $param);
    }

    public function edit()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;
        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }
        
        $id         = entitiestag($this->request->getGet('id'));
        $builder    = $this->sipgan->table("db8diktekfung");
        $db         = $builder->getWhere(['k_u'=>$id])->getResultArray();

        if (empty($db))
        {
            return redirect()->to('404');
        }
        $data['kategori_diklat']    = $this->KategoriDiklatModel->get();
        $data['data']               = $db[0];
        $param['page']              = view($this->path_view . 'page-edit',$data);
        return view($this->theme, $param);
    }

    public function detail()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;
        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }

        $id         = entitiestag($this->request->getGet('id'));
        $builder    = $this->sipgan->table("db8diktekfung");
        $db         = $builder->getWhere(['k_u'=>$id])->getResultArray();

        if (empty($db))
        {
            return redirect()->to('404');
        }
        
        $data['data']   = $db[0];
        $param['page']  = view($this->path_view . 'page-detail',$data);
        return view($this->theme, $param);
    }

    public function insert()
    {
        $param['menu']          = $this->menu;
        $param['activeMenu']    = $this->activeMenu;
        if($param['activeMenu']['akses_tambah'] == '0')
        {
            return redirect()->to('denied');
        }

        $kategori_diklat       = entitiestag($this->request->getPost('kategoriDiklat'));
        $diklat                = $this->KategoriDiklatModel->get(['id'=>$kategori_diklat]);
        $tipe                  = $diklat[0]['kode'];
        $DIKTEKFUNG            = $diklat[0]['nama'];

        $data['pns_urut']      = $_SESSION['user_id'];
        $data['tipe_dik_kd']   = $tipe;
        $data['DIKTEKFUNG']    = $DIKTEKFUNG;
        $data['nm_dik']        = entitiestag($this->request->getPost('nmDik'));
        $data['tmp_dik']       = entitiestag($this->request->getPost('tmpDik'));
        $data['pnylgr_dik']    = entitiestag($this->request->getPost('pnylgrDik'));
        $data['agkt_dik']      = entitiestag($this->request->getPost('agktDik'));
        $data['th_agkt_dik']   = entitiestag($this->request->getPost('thAgktDik'));
        $data['tgl_mul_dik']   = tanggal_Ymd(entitiestag($this->request->getPost('tglMulDik')));
        $data['tgl_sls_dik']   = tanggal_Ymd(entitiestag($this->request->getPost('tglSlsDik')));
        $data['jml_jam_dik']   = entitiestag($this->request->getPost('konversijmlJamDik'));
        $data['sttpp_dik_no']  = entitiestag($this->request->getPost('sttppDikNo'));
        $data['sttpp_dik_tgl'] = tanggal_Ymd(entitiestag($this->request->getPost('sttppDikTgl')));
        $data['sttpp_dik_thn'] = entitiestag($this->request->getPost('sttppDikThn'));
        $data['myuser']        = "OSS sistem";
        $data['mydate']        = date("Y-m-d");
        $data['mytime']        = date("H:i:s");

        if(!$this->validate([
            'nmDik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
            'thAgktDik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
            'konversijmlJamDik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
        ]))
        {
            $this->session->setFlashdata('info', 'Mohon cek entrian Anda, terdapat kekurangan dalam pengentrian formulir entriannya. Silakan dilengkapi terlebih dahulu');
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation',$validation);
        }

        $builder = $this->sipgan->table("db8diktekfung");
        $builder->insert($data);
        $this->session->setFlashdata('info', 'Data Riwayat Diklat Anda berhasil ditambahkan');
        return redirect()->to(backend_url() . '/riwayat-diklat');
    }


    public function update()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu']       = $this->activeMenu;
        if($param['activeMenu']['akses_ubah'] == '0')
        {
            return redirect()->to('denied');
        }

        $kategori_diklat       = entitiestag($this->request->getPost('kategoriDiklat'));
        $diklat                = $this->KategoriDiklatModel->get(['id'=>$kategori_diklat]);
        $tipe                  = $diklat[0]['kode'];
        $DIKTEKFUNG            = $diklat[0]['nama'];

        $data['pns_urut']      = $_SESSION['user_id'];
        $data['tipe_dik_kd']   = $tipe;
        $data['DIKTEKFUNG']    = $DIKTEKFUNG;
        $data['nm_dik']        = entitiestag($this->request->getPost('nmDik'));
        $data['tmp_dik']       = entitiestag($this->request->getPost('tmpDik'));
        $data['pnylgr_dik']    = entitiestag($this->request->getPost('pnylgrDik'));
        $data['agkt_dik']      = entitiestag($this->request->getPost('agktDik'));
        $data['th_agkt_dik']   = entitiestag($this->request->getPost('thAgktDik'));
        $data['tgl_mul_dik']   = tanggal_Ymd(entitiestag($this->request->getPost('tglMulDik')));
        $data['tgl_sls_dik']   = tanggal_Ymd(entitiestag($this->request->getPost('tglSlsDik')));
        $data['jml_jam_dik']   = entitiestag($this->request->getPost('konversijmlJamDik'));
        $data['sttpp_dik_no']  = entitiestag($this->request->getPost('sttppDikNo'));
        $data['sttpp_dik_tgl'] = tanggal_Ymd(entitiestag($this->request->getPost('sttppDikTgl')));
        $data['sttpp_dik_thn'] = entitiestag($this->request->getPost('sttppDikThn'));
        $data['myuser']        = "OSS sistem";
        $data['mydate']        = date("Y-m-d");
        $data['mytime']        = date("H:i:s");

        if(!$this->validate([
            'nmDik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
            'thAgktDik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
            'konversijmlJamDik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
        ]))
        {
            $validation = \Config\Services::validation();
            $this->session->setFlashdata('info', 'Mohon cek entrian Anda, terdapat kekurangan dalam pengentrian formulir entriannya. Silakan dilengkapi terlebih dahulu');
            return redirect()->back()->withInput()->with('validation',$validation);
        }

        $id      =  entitiestag($this->request->getPost('k_u'));
        $builder = $this->sipgan->table("db8diktekfung");
        $builder->where('k_u', $id);
        $builder->update($data);
        $this->session->setFlashdata('info', 'Data Riwayat Diklat Anda berhasil diperbaharui');
        return redirect()->to(backend_url() . '/riwayat-diklat');
    }


    public function delete()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu']       = $this->activeMenu;
        if($param['activeMenu']['akses_hapus'] == '0')
        {
            return redirect()->to('denied');
        }

        $id      =  entitiestag($this->request->getGet('id'));
        $builder = $this->sipgan->table("db8diktekfung");
        $builder->where('k_u', $id);
        $builder->delete();
        $this->session->setFlashdata('info', 'Data Riwayat Diklat Anda berhasil dihapus');
        return redirect()->to(backend_url() . '/riwayat-diklat');
    }




}