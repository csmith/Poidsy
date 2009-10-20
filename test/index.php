 <head>
  <title>Poidsy unit tests</title>
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

 define('INCLUDE', true);

 foreach (glob('*.test.php') as $test) {
  echo '<tr><th colspan="4">', $test, '</th></tr>';
  include($test); 
 }

?>
