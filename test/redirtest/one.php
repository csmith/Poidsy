<?PHP

header('Location: ' . str_replace('one', 'two', $_SERVER['REQUEST_URI']));

?>
