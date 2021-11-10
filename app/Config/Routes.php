<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$folder_backend = "Backend\'";

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages\Auth\Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->set404Override(function () {
    $param['code']      = 403;
    $param['message']   = "Whoaa Halaman tidak ditemukan... ";
    $param['image']     = "forbidden.png";
    $param['desc']      = "<p>Sepertinya halaman web yang Anda akses tidak ditemukan</p>";
    return view('response/page', $param);
});

$routes->add('denied', function () {
    $param['code']      = 403;
    $param['message']   = "Uups Akses ditolak... ";
    $param['image']     = "denied.jpg";
    $param['desc']      = "<p>Anda tidak mempunyai hak akses untuk masuk ke dalam halaman yang ingin Anda tuju</p>";
    return view('response/page', $param);
});

$routes->add('error', function () {
    $param['code']      = 101;
    $param['message']   = "Uups Erros Gaes... ";
    $param['image']     = "denied.jpg";
    $param['desc']      = "<p>Sepertinya ada kesalahan teknis, mohon bersabar untuk perbaikan selanjutnya ya... </p>";
    return view('response/page', $param);
});

$routes->add('done', function () {
    $param['code']      = ')';
    $param['message']   = "Yeayy pengisian selesai... ";
    $param['image']     = "barloader.gif";
    $param['desc']      = "<p>Terima kasih telah melengkapi isiannya. Silakan melanjutkan aktivitas lainnya...</p>";
    return view('response/page', $param);
});

$routes->add('/404', 'Pages\Response::not_found');
$routes->add('/403', 'Pages\Response::denied');
$routes->add('/101', 'Pages\Response::unavailable');
$routes->add('/comingsoon', 'Pages\Response::comingsoon');

$routes->get('/', 'Pages\Auth\Auth::index');


//frontend
$routes->group('auth', function ($routes) {
    $root_menu = "Pages\Auth\Auth";
    //pages
    $routes->add('/', $root_menu . '::index');
    $routes->get('signout', $root_menu.'::signout');
    $routes->get('logout',  $root_menu.'::signout');

    $routes->post('login',  $root_menu.'::signin');
    $routes->post('signin',  $root_menu.'::signin');
    $routes->post('sso',  $root_menu.'::sso');
});


$routes->group('backend', function ($routes) {

    $routes->group('beranda', function ($routes) {
        $root_menu = "Backend\Dashboard\Main";
        //pages
        $routes->add('/', $root_menu . '::index', ['filter' => 'auth']);
    });

    $routes->group('site', function ($routes) {
        $root_menu = "Backend\Option\Site";
        //pages
        $routes->add('/', $root_menu . '::index', ['filter' => 'auth']);
        $routes->post('update', $root_menu . '::update', ['filter' => 'auth']);
    });

    $routes->group('profile', function ($routes) {
        $root_menu = "Backend\Option\Profile";
        //pages
        $routes->add('/', $root_menu.'::index', ['filter' => 'auth']);
        $routes->post('update', $root_menu.'::update', ['filter' => 'auth']);
    });

    // Route Option    
    $routes->group('menu', function ($routes) {
        $root_menu = "Backend\Option\Menu";
        //pages
        $routes->add('/', $root_menu . '::index');
        $routes->add('add', $root_menu . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_menu . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_menu . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_menu . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_menu . '::delete', ['filter' => 'auth']);
        $routes->post('sorting', $root_menu . '::sorting', ['filter' => 'auth']);

        $routes->add('get_primary_key', $root_menu . '::get_primary_key', ['filter' => 'auth']);
        $routes->add('get_list_menu', $root_menu . '::get_list_menu', ['filter' => 'auth']);
    });

    $routes->group('groups', function ($routes) {
        $root_groups = "Backend\Option\Groups";
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    $routes->group('role', function ($routes) {
        $root_role = "Backend\Option\Role";
        //pages
        $routes->add('/', $root_role.'::index', ['filter' => 'auth']);
        //process
        $routes->add('getRole', $root_role.'::getRole', ['filter' => 'auth']);
        $routes->add('setRole', $root_role.'::setRole', ['filter' => 'auth']);
    });

    $routes->group('users', function ($routes) {
        $root_user = "Backend\Option\Users";
        //pages
        $routes->add('/', $root_user.'::index', ['filter' => 'auth']);
        $routes->add('add', $root_user.'::add', ['filter' => 'auth']);
        $routes->get('edit', $root_user.'::edit', ['filter' => 'auth']);

        //process
        $routes->post('insert', $root_user.'::insert', ['filter' => 'auth']);
        $routes->post('update', $root_user.'::update', ['filter' => 'auth']);
        $routes->get('delete', $root_user.'::delete', ['filter' => 'auth']);
        $routes->get('is_active', $root_user.'::is_active', ['filter' => 'auth']);
    });

    
    //creator
    $routes->group('table-model', function ($routes) {
        $root_groups = "Backend\Creator\TableModel";
        //pages
        $routes->add('/', $root_groups.'::index', ['filter' => 'auth']);
        $routes->post('generate', $root_groups.'::generate', ['filter' => 'auth']);
    });

    //form generator
    $routes->group('form-generator', function ($routes) {
        $root_groups = 'Backend\Creator\FormGenerator';
        //pages
        $routes->add('/', $root_groups.'::index', ['filter' => 'auth']);
        $routes->post('generate', $root_groups.'::generate', ['filter' => 'auth']);
    });

    $routes->group('crud-generator', function ($routes) {
        $root_groups = 'Backend\Creator\CRUDGenerator';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->post('generate', $root_groups.'::generate', ['filter' => 'auth']);
    });

    $routes->group('table-generator', function ($routes) {
        $root_groups = 'Backend\Creator\TableGenerator';
        //pages
        $routes->add('/', $root_groups.'::index', ['filter' => 'auth']);
        $routes->post('generate', $root_groups.'::generate', ['filter' => 'auth']);
    });
    
    //sinkron
    $routes->group('kenaikan-gaji-berkala', function ($routes) {
        $root_groups = 'Backend\Sinkron\Kenaikangajiberkala';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
        //getList
        $routes->post('get-list', $root_groups . '::getList', ['filter' => 'auth']);
        $routes->post('get-sinkron', $root_groups . '::getSinkron', ['filter' => 'auth']);
    });

    $routes->group('kenaikan-pangkat', function ($routes) {
        $root_groups = 'Backend\Sinkron\KenaikanPangkat';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    $routes->group('validasi-data-keluarga', function ($routes) {
        $root_groups = 'Backend\Sinkron\ValidasiDataKeluarga';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });
    
    $routes->group('unit-kerja', function ($routes) {
        $root_groups = 'Backend\Sinkron\UnitKerja';
        //pages
        $routes->add('/', $root_groups.'::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups.'::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups.'::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups.'::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups.'::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups.'::delete', ['filter' => 'auth']);
    });

    //nominatif
    $routes->group('penggajian', function ($routes) {
        $root_groups = 'Backend\Nominatif\Penggajian';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('get-list', $root_groups . '::getList', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
        //setCheckList
        $routes->post('set-check-list', $root_groups . '::setCheckList', ['filter' => 'auth']);
    });

    $routes->group('import-data-penerima', function ($routes) {
        $root_groups = 'Backend\Nominatif\ImportDataPenerima';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('get-list', $root_groups . '::getList', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    //data TPP
    $routes->group('nominal-kelas-jabatan', function ($routes) {
        $root_groups = 'Backend\DataTPP\NominalKelasJabatan';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    $routes->group('nominatif-penerima', function ($routes) {
        $root_groups = 'Backend\DataTPP\NominatifPenerima';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
        $routes->post('get-list', $root_groups . '::getList', ['filter' => 'auth']);
    });

    $routes->group('proses-pengajuan-tpp', function ($routes) {
        $root_groups = 'Backend\DataTPP\ProsesPengajuanTPP';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    //laporan
    $routes->group('laporan-belanja-pegawai', function ($routes) {
        $root_groups = 'Backend\Laporan\LaporanBelanjaPegawai';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    $routes->group('laporan-penerimaan-tpp', function ($routes) {
        $root_groups = 'Backend\Laporan\LaporanPenerimaanTPP';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    $routes->group('laporan-bpjs', function ($routes) {
        $root_groups = 'Backend\Laporan\LaporanBPJS';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    $routes->group('take-home-pay', function ($routes) {
        $root_groups = 'Backend\Laporan\TakeHomePay';
        //pages
        $routes->add('/', $root_groups . '::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups . '::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups . '::edit', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups . '::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups . '::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups . '::delete', ['filter' => 'auth']);
    });

    //Diklat
    //Riwayat Diklat
    $routes->group('riwayat-diklat', function ($routes) {
        $root_groups = 'Backend\DataDiklat\RiwayatDiklat';
        //pages
        $routes->add('/', $root_groups.'::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups.'::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups.'::edit', ['filter' => 'auth']);
        $routes->get('detail', $root_groups.'::detail', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups.'::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups.'::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups.'::delete', ['filter' => 'auth']);
    });

    $routes->group('kategori-diklat', function ($routes) {
        $root_groups = 'Backend\DataDiklat\KategoriDiklat';
        //pages
        $routes->add('/', $root_groups.'::index', ['filter' => 'auth']);
        $routes->add('add', $root_groups.'::add', ['filter' => 'auth']);
        $routes->get('edit', $root_groups.'::edit', ['filter' => 'auth']);
        $routes->get('detail', $root_groups.'::detail', ['filter' => 'auth']);
        //process
        $routes->post('insert', $root_groups.'::insert', ['filter' => 'auth']);
        $routes->post('update', $root_groups.'::update', ['filter' => 'auth']);
        $routes->get('delete', $root_groups.'::delete', ['filter' => 'auth']);
    });

});


if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}