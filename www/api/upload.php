<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once('includes/Database.class.php');
require_once('includes/filters.php');
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['img_data']) && isset($_POST['filter_id']))
{
	if ($filter = getFilterById($_POST['filter_id']))
	{
		preg_match("/data:image\/png;base64,(.*)/", $_POST['img_data'], $data);
		if ($data)
		{
			$cid = uniqid("img_");
			while (file_exists("../uploaded_img/$cid.jpg"))
				$cid = uniqid("img_");
			$data = str_replace(" ", "+", $data[1]);
			$db = new Database();
			if ($db->addPost($_SESSION['user_id'], $cid))
			{
				$filter_filename = "../resources/filters/$filter";
				$dest = imagecreatefromstring(base64_decode($data));
				$f = imagecreatefrompng($filter_filename);
				list($dw, $dh) = getimagesizefromstring(base64_decode($data));
				list($fw, $fh) = getimagesize($filter_filename);
				imagecopyresized($dest, $f, ($dw - $fw / 2) / 2, ($dh - $fh / 2) / 2, 0, 0, $fw / 2, $fh / 2, $fw, $fh);
				imagejpeg($dest, "../uploaded_img/$cid.jpg");
				return print(json_encode(array('success' => true, 'imgId' => $cid, 'postId' => $db->getPostByImgId($cid)['id'])));
			}
		}
	}
}
print(json_encode(array('success' => false)));
