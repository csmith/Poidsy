<?PHP if (!defined('INCLUDE')) { ?><html>
 <head>
  <title>Poidsy unit test - HTML parser</title>
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

 function doHtmlTest($output, $input) {

  $disc = new Discoverer(null);
  $disc->parseHtml(file_get_contents($input));
  $aoutput = $disc->getVersion() . ':' . $disc->getEndpointUrl() . ',' . $disc->getOpLocalId();
  $result = $aoutput == $output;

  echo '<tr><td><a href="', htmlentities($input), '">', htmlentities($input), '</a></td>';
  echo '<td>', htmlentities($output), '</td>';
  echo '<td>', htmlentities($aoutput), '</td>';
  echo '<td class="', $result ? 'succ' : 'error', '">';
  echo $result ? 'Passed' : 'Failed';
  echo '</td>';
  echo '</tr>';
 }

 $tests = array(
  'samplehtml/test1.html' => '1:http://server.com/path,http://delegate.com/',
  'samplehtml/test2.html' => '1:http://server.com/path,http://delegate.com/',
  'samplehtml/test3.html' => '1:http://server/path?foo&bar,',
  'samplehtml/v2-test1.html' => '2:http://server.com/path,http://delegate.com/',
  'samplehtml/v2-test2.html' => '2:http://server.com/path,',
  'samplehtml/v2-test3.html' => '2:http://server.com/path,',
  'samplehtml/v2-test4.html' => '1:http://server.com/path,http://delegate.com/',
  'samplehtml/v2-test5.html' => '1:http://server.com/path,http://delegate.com/',
 );

 array_walk($tests, 'doHtmlTest');

?>
