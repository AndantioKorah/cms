<?php
$route['users'] = 'user/C_User/users';
$route['user/setting'] = 'user/C_User/userSetting';
$route['roles'] = 'user/C_User/roles';
$route['menu'] = 'user/C_User/menu';
$route['master/pesan/jenis'] = 'master/C_Master/jenisPesan';
$route['master/hari-libur'] = 'master/C_Master/hariLibur';
$route['pesan/send/individu'] = 'message/C_Message/individuMessage';
$route['pesan/send/bulk'] = 'message/C_Message/bulkMessage';
$route['master/bidang'] = 'master/C_Master/masterBidang';
$route['master/bidang/sub'] = 'master/C_Master/masterSubBidang';
$route['kinerja/verifikasi'] = 'kinerja/C_VerifKinerja/verifKinerja';
$route['kinerja/rekapitulasi-realisasi'] = 'kinerja/C_VerifKinerja/rekapRealisasi';
$route['kinerja/skp-bulanan'] = 'kinerja/C_Kinerja/skpBulanan';
$route['kinerja/komponen'] = 'kinerja/C_Kinerja/komponenKinerja';

$route['rekapitulasi/realisasi-kinerja'] = 'kinerja/C_VerifKinerja/rekapRealisasi';
// $route['rekapitulasi/absensi'] = 'rekap/C_Rekap/rekapAbsensi';
$route['rekapitulasi/absensi'] = 'rekap/C_Rekap/rekapDisiplin';
$route['rekapitulasi/penilaian'] = 'rekap/C_Rekap/rekapPenilaian';

$route['dashboard'] = 'dashboard/C_Dashboard/dashboard';