<?php
$host = getenv("HOST"); 
$port = getenv("PORT");
$user = getenv("USER");
$password = getenv("PASSWORD");
$dbname = getenv("DBNAME");
$statements = getenv("STATEMENTS");

echo "\nHOST:       " . $host . "\n";
echo   "PORT:       " . $port . "\n";
echo   "USER:       " . $user . "\n";
echo   "DBNAME:     " . $dbname . "\n";
echo   "STATEMENTS: " . number_format($statements) . "\n";

try {

  runTest(false, $host, $port, $user, $password, $dbname, $statements);
  runTest(true, $host, $port, $user, $password, $dbname, $statements);

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

function runTest($reuseConnection, $host, $port, $user, $password, $dbname, $statements) {

  $dt = new DateTime();
  $conn = null;

  if($reuseConnection) { $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password); }

  for ($x = 0; $x <= $statements; $x++) {

    if(! $reuseConnection) { $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password); }

    foreach ($conn->query("SELECT \"SOME SAMPLE TEXT RESPONSE\" as col") as $row) { $value = $row["col"]; }
    
    if(! $reuseConnection) { $conn = null; }
  }

  $conn = null;

  $interval = $dt->diff(new DateTime());
  echo "\nRan " . number_format($statements) . ($reuseConnection ? " reuse" : " new" ) . " connection statements in " . $interval->format('%s.%F') . " seconds\n\n";
}
?>
