<html>
<head>
</head>

<body>
<h1>oSTIES!!!</h1>

<?php

  $dsn = 'TDS_DB2R';
  $uid = 't140051';
  $pwd = 'tn65mnzh';
  $conn = odbc_connect($dsn, $uid, $pwd);
  
	$sql = <<<FIN
    SELECT MVS_SYSTEM_ID
    , CICS_SYSTEM_ID
    , TRANSACTION_ID
    , SUM(NUM_ABENDS) AS ABENDS
    FROM DRLP.CICS_ABENDS_H
    WHERE DATE='2015-02-17' AND TRANSACTION_ID = 'ODMI'
    GROUP BY DATE, MVS_SYSTEM_ID, CICS_SYSTEM_ID, TRANSACTION_ID
    ORDER BY CICS_SYSTEM_ID;
FIN;
  
  $resultset=odbc_exec($conn, $sql);
  odbc_result_all($resultset,"border=1");
  
?>


</body>
</html>
