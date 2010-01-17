<?PHP if (!defined('INCLUDE')) { ?><html>
 <head>
  <title>Poidsy unit test - HTML parser</title>
  <style type="text/css">
   table { border-collapse: collapse; width: 100%; }
   td, th { border: 1px solid #000; padding: 10px; }
   td.error { text-align: center; color: #fff; background-color: #c00; }
   td.succ { text-align: center; color: #fff; background-color: #0c0; }
   var { font-size: small; color: purple; font-style: normal; padding: 0 2px; }
  </style>
 </head>
 <body>
  <table>
   <tr><th>Input</th><th>Expected</th><th>Actual</th><th>Result</th></tr>
<?PHP

 }

 require_once('../discoverer.inc.php');

 define('BASE_URI', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/');

 function doHtmlTest($output, $input) {

  $disc = new Discoverer(BASE_URI . $input);
  $aoutput = $disc->getVersion() . "\n" . $disc->getEndpointUrl() . "\n" . $disc->getUserSuppliedId() . "\n" . $disc->getClaimedId() . "\n" . $disc->getOpLocalId();
  $aoutput = str_replace(BASE_URI, '%URL%', $aoutput);
  $result = $aoutput == $output;

  echo '<tr><td><a href="', htmlentities($input), '">', htmlentities($input), '</a></td>';
  echo '<td>', str_replace('%URL%', '<var>%URL%</var>', nl2br(htmlentities($output))), '</td>';
  echo '<td>', str_replace('%URL%', '<var>%URL%</var>', nl2br(htmlentities($aoutput))), '</td>';
  echo '<td class="', $result ? 'succ' : 'error', '">';
  echo $result ? 'Passed' : 'Failed';
  echo '</td>';
  echo '</tr>';
 }

 $tests = array(
  'samplehtml/test1.html' => "1\nhttp://server.com/path\n%URL%samplehtml/test1.html\n%URL%samplehtml/test1.html\nhttp://delegate.com/",
  'samplehtml/test2.html' => "1\nhttp://server.com/path\n%URL%samplehtml/test2.html\n%URL%samplehtml/test2.html\nhttp://delegate.com/",
  'samplehtml/test3.html' => "1\nhttp://server/path?foo&bar\n%URL%samplehtml/test3.html\n%URL%samplehtml/test3.html\n",
  'samplehtml/v2-test1.html' => "2\nhttp://server.com/path\n%URL%samplehtml/v2-test1.html\n%URL%samplehtml/v2-test1.html\nhttp://delegate.com/",
  'samplehtml/v2-test2.html' => "2\nhttp://server.com/path\n%URL%samplehtml/v2-test2.html\n%URL%samplehtml/v2-test2.html\n%URL%samplehtml/v2-test2.html",
  'samplehtml/v2-test3.html' => "2\nhttp://server.com/path\n%URL%samplehtml/v2-test3.html\n%URL%samplehtml/v2-test3.html\n%URL%samplehtml/v2-test3.html",
  'samplehtml/v2-test4.html' => "1\nhttp://server.com/path\n%URL%samplehtml/v2-test4.html\n%URL%samplehtml/v2-test4.html\nhttp://delegate.com/",
  'samplehtml/v2-test5.html' => "1\nhttp://server.com/path\n%URL%samplehtml/v2-test5.html\n%URL%samplehtml/v2-test5.html\nhttp://delegate.com/",
 );

 array_walk($tests, 'doHtmlTest');

?>
