<?php
/**
    * Gera uma tabela HTML com os registros do resultado de uma consulta SQL
    * @author Rodrigo Ladislau
    * @param ResultSet $rs resultado de uma consulta sql
    * @param Array $headers Array com os cabeçalhos da tabela
    * @return void
*/
function geraTabela($rs, $headers)
   {
      $s = "<table border =1 width = '150px' class='tabela' cellspacing='0' cellpadding='0'>";
	  $s .= "<tr class='titulo'>";
	  foreach ($headers as $header)	  {
		  $s .=  "<td class='titulocelula'>$header</td>";
	  }
 
	  $s .= "</tr>";		  
	  while ($row = mysql_fetch_object($rs)){
		  $s .= "<tr  class='linha'>";
		  foreach ($row as $data){
			  $s .=  "<td  class='linhacelula'>$data</td>";
		  }		  
		  $s .= "</tr>";		  		  
	  }
 
	  $s .= "</table>";	  
 
	  echo $s;
   }
?>