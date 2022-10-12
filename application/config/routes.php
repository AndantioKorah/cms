<?php
require_once 'tio.php';
require_once 'laporan.php';

defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'C_Main';
$route['404_override'] = 'login/C_Login/notFoundOverride';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/C_Login/login';
// $route['logout'] = 'login/C_Login/logout';

//admin
$route['admin'] = 'login/C_Login/login';
$route['admin/logout'] = 'login/C_Login/logout';
$route['admin/master/parameter'] = 'master/C_Master/masterParameter';
$route['admin/master/jenis-pelayanan'] = 'master/C_Master/masterJenisPelayanan';
$route['admin/master/parameter-jenis-pelayanan'] = 'master/C_Master/masterParameterJenisPelayanan';
$route['admin/welcome'] = 'login/C_Login/welcomePage';
$route['admin/users'] = 'user/C_User/users';
$route['admin/user/setting'] = 'user/C_User/userSetting';
$route['admin/roles'] = 'user/C_User/roles';
$route['admin/menu'] = 'user/C_User/menu';
$route['admin/konten'] = 'admin/C_Admin/konten';
$route['admin/berita'] = 'admin/C_Admin/berita';
$route['admin/galeri'] = 'admin/C_Admin/galeri';
$route['admin/ppid'] = 'admin/C_Admin/ppid';
$route['admin/pelayanan'] = 'admin/C_Admin/pelayanan';
$route['admin/pengumuman'] = 'admin/C_Admin/pengumuman';
$route['master/ketegorippid'] = 'master/C_Master/masterKategoriPpid';
$route['master/jenisppid'] = 'master/C_Master/masterJenisPpid';
$route['admin/covid19/regulasi'] = 'admin/C_Admin/covid19Regulasi';
$route['admin/covid19/infografis'] = 'admin/C_Admin/covid19Infografis';
$route['admin/covid19/video'] = 'admin/C_Admin/covid19Video';
$route['admin/pojok-ttg'] = 'admin/C_Admin/pojokttg';
$route['admin/agenda'] = 'admin/C_Admin/agenda';
$route['admin/aplikasi-publik'] = 'admin/C_Admin/aplikasiPublik';
$route['master/download'] = 'master/C_Master/masterDownload';
$route['admin/download'] = 'admin/C_Admin/download';
$route['admin/mainImage'] = 'admin/C_Admin/mainImage';
$route['admin/dokumen'] = 'admin/C_Admin/dokumen';
$route['admin/sidebanner'] = 'admin/C_Admin/sideBanner';
$route['admin/master/role-pelayanan'] = 'master/C_Master/masterRolePelayanan';

$route['admin/reservasi'] = 'reservasi/C_Reservasi/index';
$route['admin/reservasi/hasil/input'] = 'reservasi/C_Reservasi/inputHasil';

// $route['dashboard'] = 'dashboard/C_Dashboard/dashboard';

// =============================================================

//web company profile
$route[''] = 'C_Main/index';
$route['language/switch/(:any)'] = 'C_Main/switchLanguage/$1';

$route['profile'] = 'webcp/profile/C_Profile/index';

$route['news'] = 'webcp/news/C_News/index';
$route['news/detail/(:any)'] = 'webcp/news/C_News/detailNews/$1';

$route['gallery'] = 'webcp/gallery/C_Gallery/index';
$route['gallery/image'] = 'webcp/gallery/C_Gallery/indexGambar';
$route['gallery/video'] = 'webcp/gallery/C_Gallery/indexVideo';

$route['ppid'] = 'webcp/ppid/C_Ppid/index';
$route['ppid/berkala'] = 'webcp/ppid/C_Ppid/ppidBerkala';
$route['ppid/setiap-saat'] = 'webcp/ppid/C_Ppid/ppidSetiapSaat';
$route['ppid/serta-merta'] = 'webcp/ppid/C_Ppid/ppidSertaMerta';

$route['service'] = 'webcp/service/C_Service/index';
$route['service/jenis-pelayanan'] = 'webcp/service/C_Service/jenisPelayanan';
$route['service/jam-pelayanan'] = 'webcp/service/C_Service/jamPelayanan';
$route['service/pola-tarif'] = 'webcp/service/C_Service/polaTarif';

$route['announcement'] = 'webcp/announcement/C_Announcement/index';
$route['announcement/detail/(:any)'] = 'webcp/announcement/C_Announcement/detailAnnouncement/$1';

$route['akuntabilitas'] = 'webcp/download/C_Download/index';

$route['agenda'] = 'webcp/agenda/C_Agenda/index';
$route['agenda/detail/(:any)'] = 'webcp/agenda/C_Agenda/detailAgenda/$1';

$route['contact'] = 'webcp/contact/C_Contact/index';

$route['wbs'] = 'webcp/wbs/C_Wbs/index';

$route['ttg'] = 'webcp/ttg/C_Ttg/index';
$route['ttg/detail/(:any)'] = 'webcp/ttg/C_Ttg/detailTtg/$1';

$route['covid'] = 'webcp/covid/C_Covid/index';
$route['covid/regulasi'] = 'webcp/covid/C_Covid/regulasi';
$route['covid/infografis'] = 'webcp/covid/C_Covid/infografis';
$route['covid/video'] = 'webcp/covid/C_Covid/video';

$route['reservasi'] = 'webcp/reservasi/C_Reservasi/index';