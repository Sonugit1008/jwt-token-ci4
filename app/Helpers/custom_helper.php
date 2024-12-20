<?php
if (!function_exists('loadView')) {
	function loadView($page = 'home', $data = [])
	{
		if (!is_file(APPPATH . '/Views/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		echo view('layouts/header', $data);
		echo view($page, $data);
		echo view('layouts/footer', $data);
	}
}


function saveBase64Image($base64Image, $folderPath)
{
	if (!is_dir($folderPath)) {
		mkdir($folderPath, 0777, true);
	}
	$uniqueId = uniqid(rand(0, 9), true);
	$fileName = "user_img" . "_" . $uniqueId . '.png';
	$filePath = $folderPath . '/' . $fileName;
	$imageData = str_replace(['data:image/png;base64,', ' '], ['', '+'], $base64Image);
	$decodedImage = base64_decode($imageData);
	file_put_contents($filePath, $decodedImage);
	return $fileName;
}

function updateLastLogin($conn,$user_id,$time) {
	date_default_timezone_set('Asia/Kolkata');
    $conn->table('users')->where('id', $user_id)->update(['last_login' =>$time]);
}
