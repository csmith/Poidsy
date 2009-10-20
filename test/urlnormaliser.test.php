<?PHP if (!defined('INCLUDE')) { ?><html>
 <head>
  <title>Poidsy unit test - URL normaliser</title>
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

 function doNormTest($output, $input) {

  $aoutput = Discoverer::normalise($input);
  $result = $aoutput == $output;

  echo '<tr><td>', htmlentities($input), '</td>';
  echo '<td>', htmlentities($output), '</td>';
  echo '<td>', htmlentities($aoutput), '</td>';
  echo '<td class="', $result ? 'succ' : 'error', '">';
  echo $result ? 'Passed' : 'Failed';
  echo '</td>';
  echo '</tr>';
 }

 $tests = array(
  'test.foo' => 'http://test.foo/',
  'test.foo.' => 'http://test.foo/',
  'http://test.foo:80/' => 'http://test.foo/',
  'user@test.foo' => 'http://test.foo/',
  'test.foo/path#frag' => 'http://test.foo/path',
  'test.foo:81' => 'http://test.foo:81/',
  'user:pass@test.foo.:80/?foo#bar' => 'http://test.foo/',
  'protocol://foo/' => 'protocol://foo/',
  'protocol://foo.:80/' => 'protocol://foo:80/',
  'https://test.foo/' => 'https://test.foo/',
  'https://:@test.foo.:443?#' => 'https://test.foo/',
  'https://test.foo:80' => 'https://test.foo:80/',
  'http://host/path/to/file' => 'http://host/path/to/file',
  'foo/././bar' => 'http://foo/bar',
  'foo/bar/../baz' => 'http://foo/baz',
  'foo/bar/./../baz' => 'http://foo/baz',
  'http://test.foo/abc/../def/.././' => 'http://test.foo/',
 );

 array_walk($tests, 'doNormTest');

?>
