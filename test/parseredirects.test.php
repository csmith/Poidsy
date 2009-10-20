<?PHP if (!defined('INCLUDE')) { ?><html>
 <head>
  <title>Poidsy unit test - redirect tests</title>
  <style type="text/css">
   table { border-collapse: collapse; width: 100%; }
   td, th { border: 1px solid #000; padding: 10px; }
   td.error { text-align: center; color: #fff; background-color: #c00; }
   td.succ { text-align: center; color: #fff; background-color: #0c0; }
  </style>
 </head>
 <body>
  <table>
   <tr><th>Input</th><th>Expected</th><th>Actual</th><th>Result</th></tr>
<?PHP

 }

 require_once('../discoverer.inc.php');

 function doRedirTest($output, $input) {
  $url = $url2 = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
  $output = $url . $output;
  $url = $url . $input;
  $disc = new Discoverer($url);
  $aoutput = $disc->getIdentity();
  $result = $aoutput == $output;

  echo '<tr><td><a href="', htmlentities($url), '">', htmlentities($input), '</a></td>';
  echo '<td>', htmlentities(str_replace($url2, '', $output)), '</td>';
  echo '<td>', htmlentities(str_replace($url2, '', $aoutput)), '</td>';
  echo '<td class="', $result ? 'succ' : 'error', '">';
  echo $result ? 'Passed' : 'Failed';
  echo '</td>';
  echo '</tr>';
 }

 $tests = array(
 	'redirtest/one.php' => 'redirtest/three.php',
	'redirtest/two.php' => 'redirtest/three.php',
	'redirtest/three.php' => 'redirtest/three.php',
        'redirtest/four.php' => 'redirtest/three.php',
        'redirtest/five.php' => 'redirtest/three.php',
//        'redirtest/six.php' => 'redirtest/three.php',
 );

 array_walk($tests, 'doRedirTest');

?>
