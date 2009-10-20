<?PHP
if (!defined('INCLUDE')) { ?>
<html>
 <head>
  <title>Poidsy unit test - URL Builder</title>
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

 require_once('../urlbuilder.inc.php');

 function doArgTest($data, $key) {
 
  list($base, $args, $output) = $data;

  $aoutput = URLBuilder::addArguments($base, $args);
  $result = $aoutput == $output;

  echo '<tr><td>', htmlentities($base), ', '; print_r($args); echo '</td>';
  echo '<td>', htmlentities($output), '</td>';
  echo '<td>', htmlentities($aoutput), '</td>';
  echo '<td class="', $result ? 'succ' : 'error', '">';
  echo $result ? 'Passed' : 'Failed';
  echo '</td>';
  echo '</tr>';
 }

 $tests = array(
  array('http://test/?foo=bar', array('baz' => 'qux'), 'http://test/?foo=bar&baz=qux'),
  array('http://test/?', array('baz' => 'qux'), 'http://test/?baz=qux'),
  array('http://test/?foo', array('baz' => 'qux'), 'http://test/?foo&baz=qux'),
  array('http://test/', array('a' => 'b', 'c'=>'d'), 'http://test/?a=b&c=d'),
 );

 array_walk($tests, 'doArgTest');

?>
