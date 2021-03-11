<?PHP
if ($_FILES["file"]["name"] != '') {
  $test = explode(".", $_FILES["file"]["name"]);
  $extension = end($test);
  $name = rand(100, 999) . '.' . $extension;
  $location = '../assets/img/' . $name;
  move_uploaded_file($_FILES["file"]["tmp_name"], $location);
  echo '<img id="myimg" src="' . $location . '" alt="' . $name . '" class="avatar2">';
}
?>
