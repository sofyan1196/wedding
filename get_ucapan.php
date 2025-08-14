<?php
header('Content-Type: application/json');

$file_path = 'ucapan.json';
$ucapan_list = [];
$hadir_count = 0;
$tidak_hadir_count = 0;

if (file_exists($file_path)) {
    $json_data = file_get_contents($file_path);
    $ucapan_list = json_decode($json_data, true);

    // Pastikan $ucapan_list adalah array
    if (is_array($ucapan_list)) {
        foreach ($ucapan_list as $ucapan) {
            if (isset($ucapan['kehadiran'])) {
                if (strtolower($ucapan['kehadiran']) === 'hadir') {
                    $hadir_count++;
                } else {
                    $tidak_hadir_count++;
                }
            }
        }
    } else {
        $ucapan_list = []; // Jika file json korup/kosong, reset ke array kosong
    }
}

// Gabungkan data hitungan dan daftar ucapan menjadi satu respons
$response = [
    'counts' => [
        'hadir' => $hadir_count,
        'tidak_hadir' => $tidak_hadir_count
    ],
    'ucapan' => $ucapan_list
];

echo json_encode($response);
?>