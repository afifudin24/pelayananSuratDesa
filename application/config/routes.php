<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//routes

$route['dashboard'] = 'welcome/index';

//IndexAuth
$route['login'] = 'Auth/Auth/index';

//administrator
$route['administrator/login'] = 'Auth/Administrator/index';
$route['administrator-login-proses'] = 'Auth/Administrator/loginAdmin';
$route['user/login'] = 'Auth/Warga/index';
$route['user-login-proses'] = 'Auth/Warga/loginUser';
$route['user/register'] = 'Auth/Warga/register';
$route['user-register-proses'] = 'Auth/Warga/registerUser';
$route['logout'] = 'Auth/Logout/index';

$route['data-administrator'] = 'Administrator/Users/Administrator/index';
$route['created-administrator'] = 'Administrator/Users/Administrator/tambah';
$route['update-administrator/(:any)'] = 'Administrator/Users/Administrator/update/$1';
$route['deleted-administrator/(:any)'] = 'Administrator/Users/Administrator/deleted/$1';

$route['data-warga'] = 'Administrator/DataWarga/Warga/index';
$route['tambah-data-warga'] = 'Administrator/DataWarga/Warga/index_tambah';
$route['create-warga'] = 'Administrator/DataWarga/Warga/create';
$route['edit-warga/(:any)'] = 'Administrator/DataWarga/Warga/index_edit/$1';
$route['aksi-edit-warga/(:any)'] = 'Administrator/DataWarga/Warga/edit/$1';
$route['detail-warga/(:any)'] = 'Administrator/DataWarga/Warga/detail/$1';
$route['delete-warga/(:any)'] = 'Administrator/DataWarga/Warga/delete/$1';

$route['data-users'] = 'Administrator/Users/User/index';
$route['tambah-user'] = 'Administrator/Users/User/create';
$route['edit-user/(:any)'] = 'Administrator/Users/User/edit/$1';
$route['hapus-user/(:any)'] = 'Administrator/Users/User/delete/$1';



//verifikasi surat
//surat domisili
$route['verifikasi-surat-domisili'] = 'Administrator/Verifikasi/SuratDomisili/index';
$route['cetak-surat-domisili'] = 'Administrator/Verifikasi/SuratDomisili/listcetak';
$route['update-status-skd'] = 'Administrator/Verifikasi/SuratDomisili/skdverif';
$route['komentar-skd/(:any)'] = 'Administrator/Verifikasi/SuratDomisili/skdkomentar/$1';
$route['preview-skd/(:any)'] = 'Administrator/Verifikasi/SuratDomisili/preview/$1';
$route['verifikasi/skd/(:any)'] = 'Warga/Verifikasi/SuratDomisili/verifikasi/$1';
//surat tidak mampu
$route['verifikasi-surat-tidak-mampu'] = 'Administrator/Verifikasi/SuratTidakMampu/index';
$route['cetak-surat-tidak-mampu'] = 'Administrator/Verifikasi/SuratTidakMampu/listcetak';
$route['update-status-sktm'] = 'Administrator/Verifikasi/SuratTidakMampu/sktmverif';
$route['komentar-sktm/(:any)'] = 'Administrator/Verifikasi/SuratTidakMampu/sktmkomentar/$1';
$route['preview-sktm/(:any)'] = 'Administrator/Verifikasi/SuratTidakMampu/preview/$1';
$route['verifikasi/sktm/(:any)'] = 'Warga/Verifikasi/SuratTidakMampu/verifikasi/$1';
//surat usaha
$route['verifikasi-surat-usaha'] = 'Administrator/Verifikasi/SuratUsaha/index';
$route['cetak-surat-usaha'] = 'Administrator/Verifikasi/SuratUsaha/listcetak';
$route['update-status-sku'] = 'Administrator/Verifikasi/SuratUsaha/skuverif';
$route['komentar-sku/(:any)'] = 'Administrator/Verifikasi/SuratUsaha/skukomentar/$1';
$route['preview-sku/(:any)'] = 'Administrator/Verifikasi/SuratUsaha/preview/$1';
$route['verifikasi/sku/(:any)'] = 'Warga/Verifikasi/SuratUsaha/verifikasi/$1';

//surat kelahiran
$route['verifikasi-surat-kelahiran'] = 'Administrator/Verifikasi/SuratKelahiran/index';
$route['cetak-surat-kelahiran'] = 'Administrator/Verifikasi/SuratKelahiran/listcetak';
$route['update-status-spak'] = 'Administrator/Verifikasi/SuratKelahiran/spakverif';
$route['komentar-spak/(:any)'] = 'Administrator/Verifikasi/SuratKelahiran/spakkomentar/$1';
$route['preview-spak/(:any)'] = 'Administrator/Verifikasi/SuratKelahiran/preview/$1';
$route['verifikasi/spak/(:any)'] = 'Warga/Verifikasi/SuratKelahiran/verifikasi/$1';

//surat kematian
$route['verifikasi-surat-kematian'] = 'Administrator/Verifikasi/SuratKematian/index';
$route['cetak-surat-kematian'] = 'Administrator/Verifikasi/SuratKematian/listcetak';
$route['update-status-skk'] = 'Administrator/Verifikasi/SuratKematian/skkverif';
$route['komentar-skk/(:any)'] = 'Administrator/Verifikasi/SuratKematian/skkkomentar/$1';
$route['preview-skk/(:any)'] = 'Administrator/Verifikasi/SuratKematian/preview/$1';
$route['verifikasi/skk/(:any)'] = 'Warga/Verifikasi/SuratKematian/verifikasi/$1';

//surat ket pernyataan
$route['verifikasi-surat-keterangan-pengantar'] = 'Administrator/Verifikasi/SuratKeteranganPengantar/index';
$route['cetak-surat-keterangan-pengantar'] = 'Administrator/Verifikasi/SuratKeteranganPengantar/listcetak';
$route['update-status-skp'] = 'Administrator/Verifikasi/SuratKeteranganPengantar/skpverif';
$route['komentar-skp/(:any)'] = 'Administrator/Verifikasi/SuratKeteranganPengantar/skpkomentar/$1';
$route['preview-skp/(:any)'] = 'Administrator/Verifikasi/SuratKeteranganPengantar/preview/$1';
$route['verifikasi/skp/(:any)'] = 'Warga/Verifikasi/SuratKeteranganPengantar/verifikasi/$1';

// surat keramaian
$route['verifikasi-surat-keramaian'] = 'Administrator/Verifikasi/SuratKeramaian/index';
$route['cetak-surat-keramaian'] = 'Administrator/Verifikasi/SuratKeramaian/listcetak';
$route['update-status-skrm'] = 'Administrator/Verifikasi/SuratKeramaian/skrmverif';
$route['komentar-skrm/(:any)'] = 'Administrator/Verifikasi/SuratKeramaian/skrmkomentar/$1';
$route['preview-skrm/(:any)'] = 'Administrator/Verifikasi/SuratKeramaian/preview/$1';
$route['verifikasi/skrm/(:any)'] = 'Warga/Verifikasi/SuratKeramaian/verifikasi/$1';

// signature
$route['signature'] = 'Administrator/Signature/Signature/index';
$route['signature/updateLurahName'] = 'Administrator/Signature/Signature/updateLurahName';
$route['signature/signaturesave'] = 'Administrator/Signature/Signature/save';
$route['signature/stempelsave'] = 'Administrator/Signature/Signature/stempelsave';


//users

//buat surat -list
$route['list-surat'] = 'Warga/Surat/Surat/index';

//sktm
$route['sktm/buat-surat'] = 'Warga/Surat/Sktm/Sktm/index';
$route['sktm/proses'] = 'Warga/Surat/Sktm/Sktm/create';

$route['histori-sktm'] = 'Warga/History/Sktm/index';

//sku
$route['sku/buat-surat'] = 'Warga/Surat/Sku/Sku/index';
$route['sku/proses'] = 'Warga/Surat/Sku/Sku/create';

//skd
$route['skd/buat-surat'] = 'Warga/Surat/Skd/Skd/index';
$route['skd/proses'] = 'Warga/Surat/Skd/Skd/create';

//spak
$route['spak/buat-surat'] = 'Warga/Surat/Spak/Spak/index';
$route['spak/proses'] = 'Warga/Surat/Spak/Spak/create';

//skk
$route['skk/buat-surat'] = 'Warga/Surat/Skk/Skk/index';
$route['skk/proses'] = 'Warga/Surat/Skk/Skk/create';


//skp
$route['skp/buat-surat'] = 'Warga/Surat/Ket_pengantar/Keterangan_pengantar/index';
$route['skp/proses'] = 'Warga/Surat/Ket_pengantar/Keterangan_pengantar/create';

// skrm
$route['skrm/buat-surat'] = 'Warga/Surat/Skrm/Skrm/index';
$route['skrm/proses'] = 'Warga/Surat/Skrm/Skrm/create';

//HISTORY SURAT
//history
$route['histori-surat'] = 'Warga/History/History/index';


//surat domisili
$route['history-surat-domisili'] = 'Warga/History/SuratDomisili/index';

///surat kematian
$route['history-surat-kematian'] = 'Warga/History/SuratKematian/index';

//surat tidak mampu
$route['history-surat-tidak-mampu'] = 'Warga/History/SuratTidakMampu/index';

//surat usaha
$route['history-surat-usaha'] = 'Warga/History/SuratUsaha/index';

//surat kelahiran
$route['history-surat-kelahiran'] = 'Warga/History/SuratKelahiran/index';

//surat ket pengnatar
$route['history-surat-keterangan-pengantar'] = 'Warga/History/SuratKeteranganPengantar/index';

// Surat keramaian
$route['history-surat-keramaian'] = 'Warga/History/SuratKeramaian/index';

// list cetak
$route['listcetak-surat-kematian'] = 'Warga/History/SuratKematian/listcetak';
$route['listcetak-surat-domisili'] = 'Warga/History/SuratDomisili/listcetak';
$route['listcetak-surat-tidak-mampu'] = 'Warga/History/SuratTidakMampu/listcetak';
$route['listcetak-surat-usaha'] = 'Warga/History/SuratUsaha/listcetak';
$route['listcetak-surat-kelahiran'] = 'Warga/History/SuratKelahiran/listcetak';
$route['listcetak-surat-keterangan-pengantar'] = 'Warga/History/SuratKeteranganPengantar/listcetak';
$route['listcetak-surat-keramaian'] = 'Warga/History/SuratKeramaian/listcetak';


//cetak surat

//kematian
$route['cetak-surat-kematian/(:any)'] = 'Warga/History/SuratKematian/cetak/$1';

//domisili
$route['cetak-surat-domisili/(:any)'] = 'Warga/History/SuratDomisili/cetak/$1';

//domisili
$route['cetak-surat-usaha/(:any)'] = 'Warga/History/SuratUsaha/cetak/$1';

//tidak mampu
$route['cetak-surat-tidak-mampu/(:any)'] = 'Warga/History/SuratTidakMampu/cetak/$1';

//surat keterangan pengantar
$route['cetak-surat-keterangan-pengantar/(:any)'] = 'Warga/History/SuratKeteranganPengantar/cetak/$1';

//surat kelahiran
$route['cetak-surat-kelahiran/(:any)'] = 'Warga/History/SuratKelahiran/cetak/$1';

// Surat Keramaian
$route['cetak-surat-keramaian/(:any)'] = 'Warga/History/SuratKeramaian/cetak/$1';

//hapus surat
$route['hapus-surat-kematian/(:any)'] = 'Administrator/Verifikasi/SuratKematian/hapus/$1';
$route['hapus-surat-domisili/(:any)'] = 'Administrator/Verifikasi/SuratDomisili/hapus/$1';
$route['hapus-surat-usaha/(:any)'] = 'Administrator/Verifikasi/SuratUsaha/hapus/$1';
$route['hapus-surat-tidak-mampu/(:any)'] = 'Administrator/Verifikasi/SuratTidakMampu/hapus/$1';
$route['hapus-surat-kelahiran/(:any)'] = 'Administrator/Verifikasi/SuratKelahiran/hapus/$1';
$route['hapus-surat-keterangan-pengantar/(:any)'] = 'Administrator/Verifikasi/SuratKeteranganPengantar/hapus/$1';
