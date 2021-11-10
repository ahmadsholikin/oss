<?php namespace App\Controllers\Backend\DataDiklat;
use App\Controllers\BackendController;
use App\Models\DataDiklat\KategoriDiklatModel;

class KategoriDiklat extends BackendController
{
    public $path_view = 'backend/datadiklat/kategoridiklat/';
    public $theme     = 'pages/theme-backend/render';


    public function __construct()
    {
        $this-> KategoriDiklatModel = new KategoriDiklatModel();
    }

    public function index()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;
        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }
        $data = array();
        $data ['data']  = $this->KategoriDiklatModel->get();
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
        $data = array();
        $param['page']  = view($this->path_view . 'page-add',$data);
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
        $id     = entitiestag($this->request->getGet('id'));
        $db     = $this->KategoriDiklatModel->get(['id'=>$id]);
        if (empty($db))
        {
            return redirect()->to('404');
        }
        $data['data'] = $db[0];
        $param['page']  = view($this->path_view . 'page-edit',$data);
        return view($this->theme, $param);
    }

    public function insert()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu']       = $this->activeMenu;
        if($param['activeMenu']['akses_tambah'] == '0')
        {
            return redirect()->to('denied');
        }

        $data['kode']          = entitiestag($this->request->getPost('kode'));
        $data['nama']          = entitiestag($this->request->getPost('nama'));
        $data['jam_pelajaran'] = entitiestag($this->request->getPost('jamPelajaran'));

        if(!$this->validate([
            'kode' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
            'nama' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],

        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation',$validation);
        }

        $this->KategoriDiklatModel->insert($data);
        return redirect()->to(backend_url() . '/kategori-diklat');
    }


    public function update()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu']       = $this->activeMenu;
        if($param['activeMenu']['akses_ubah'] == '0')
        {
            return redirect()->to('denied');
        }

        $data['kode']          = entitiestag($this->request->getPost('kode'));
        $data['nama']          = entitiestag($this->request->getPost('nama'));
        $data['jam_pelajaran'] = entitiestag($this->request->getPost('jamPelajaran'));

        if(!$this->validate([
            'kode' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],
            'nama' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' 		=> 'Wajib diisikan',
                ]
            ],

        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation',$validation);
        }

        $id =  entitiestag($this->request->getPost('id'));
        $this->KategoriDiklatModel->update($id,$data);
        return redirect()->to(backend_url() . '/kategori-diklat');
    }


    public function delete()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu']       = $this->activeMenu;
        if($param['activeMenu']['akses_hapus'] == '0')
        {
            return redirect()->to('denied');
        }

        $id =  entitiestag($this->request->getGet('id'));
        $this->KategoriDiklatModel->delete($id);
        return redirect()->to(backend_url() . '/kategori-diklat');
    }

}