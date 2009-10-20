<?PHP

header('Location: http://' . $_SERVER['HTTP_HOST'] . str_replace('four', 'three', $_SERVER['REQUEST_URI']));

?>
