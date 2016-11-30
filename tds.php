<html>
<head>
</head>

<body>
<h1>oSTIES!!!</h1>

<?php

  $hostname = '10.0.233.137';
  $port = '4017';
  $database = 'LOCALDB2R';
  $uid = 't140051';
  $pwd = '???';
  
  $dsn =  "DRIVER={IBM DB2 ODBC DRIVER};".
          "HOSTNAME=$hostname;".
          "PORT=$port;".
          "DATABASE=$database;".
          "PROTOCOL=TCPIP;".
          "UID=$uid;".
          "PWD=$pwd";
  
  $conn = odbc_connect($dsn, '', '');
  
	$sql = <<<FIN
    SELECT MVS_SYSTEM_ID
    , CICS_SYSTEM_ID
    , TRANSACTION_ID
    , SUM(NUM_ABENDS) AS ABENDS
    FROM DRLP.CICS_ABENDS_H
    WHERE DATE='2015-02-17' AND TRANSACTION_ID = 'ODMI'
    GROUP BY DATE, MVS_SYSTEM_ID, CICS_SYSTEM_ID, TRANSACTION_ID
    ORDER BY CICS_SYSTEM_ID
    WITH UR;
FIN;
  
  $rs = odbc_exec($conn, $sql);
  odbc_result_all($rs, "border=1");
  
#  while ($data[] = odbc_fetch_array($rs));
#  print_r($data);

  odbc_free_result($rs);
  odbc_close($conn);
  
?>


</body>
</html>
