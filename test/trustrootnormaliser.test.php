<?PHP if (!defined('INCLUDE')) { ?><html>
 <head>
  <title>Poidsy unit test - trust root normaliser</title>
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

 function doTrustRootTest($input, $output) {
  list($input1, $input2) = $input;

  $aoutput = URLBuilder::getTrustRoot($input1, $input2);
  $result = $aoutput == $output;

  echo '<tr><td>', htmlentities($input1 . ',' . $input2), '</td>';
  echo '<td>', htmlentities($output), '</td>';
  echo '<td>', htmlentities($aoutput), '</td>';
  echo '<td class="', $result ? 'succ' : 'error', '">';
  echo $result ? 'Passed' : 'Failed';
  echo '</td>';
  echo '</tr>';
 }

 $tests = array(
  'http://test.fo1/' => array('http://test.fo1/','http://test.fo1/index.php'),
  'http://test.fo2/' => array('http://test.fo2/bar/baz/','http://test.fo2/index.php'),
  'http://test.fo3/' => array('http://test.fo3/','http://test.fo3/'),
  'http://test.fo4/bar/' => array('http://test.fo4/bar/baz/','http://test.fo4/bar/q/i.php'),
 );

 array_walk($tests, 'doTrustRootTest');

?>
