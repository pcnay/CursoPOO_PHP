<?php
require('StatusModel.php');
// Manejara solo código HTML.
printf ("<h1>CRUD con MVC de la tabla 'Status' </h1>");
$status = new StatusModel();

// $status->read(7);
//$status->read();
$status_datos = $status->read();
//var_dump($status_datos);

// Mostrando la información en la pantalla de la ejecucion del SELECT.
$num_status = count($status_datos);

//printf("<h2>Numero de estatus :<mark>".$num_status."</mark></h2> ");
printf("<h2>Numero de estatus :<mark>$num_status</mark></h2> ");

printf("<h2>Tabla de Estatus</h2>");

printf("<table>
        <tr>
          <th>Status_ID</th>
          <th>Status</th>
        </tr>");
        for ($n = 0;$n<count($status_datos);$n++)
        {
          printf("<tr>
                    <td>".$status_datos[$n]['status_id']."</td>
                    <td>".$status_datos[$n]['status']."</td>
                </tr>");
        }
printf("</table>");
?>