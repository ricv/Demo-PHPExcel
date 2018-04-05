<!doctype>
<html>
    <head>
         <meta charset="UTF-8">
    </head>
    <body>
        <?php
        require_once "Classes/PHPExcel.php";                //Incluimos la Libreria PHPExcel        
        $url = "archivos/ricv_Prueba.xlsx";                 //Definimos el archivo
        $filecontent = file_get_contents($url);             /*Esta función es similar a file(), 
                                                            excepto que file_get_contents() devuelve el fichero a un string, 
                                                            comenzando por el offset especificado hasta maxlen bytes. Si falla,
                                                            file_get_contents() devolverá FALSE.*/
        $tmpfname = tempnam(sys_get_temp_dir(), "tmpxls");  /*La función tempnam () crea un archivo temporal con un nombre de archivo único en el directorio especificado.
                                                            Esta función devuelve el nuevo nombre de archivo temporal o FALSE en caso de error.*/
        file_put_contents($tmpfname, $filecontent);         //El file_put_contents() escribe una cadena en un archivo.
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);//configurar esto, para no leer todas las propiedades de Excel, solo datos
        $excelObj = $excelReader->load($tmpfname);  //lee el archivo temporal        
        $worksheet = $excelObj->getSheet(0);        
        $lastRow = $worksheet->getHighestRow();

        echo "<table>";
        for ($row = 1; $row <= $lastRow; $row++) {
            echo "<tr><td>";
            echo $worksheet->getCell('A' . $row)->getValue();
            echo "</td><td>";
            echo $worksheet->getCell('B' . $row)->getValue();
            echo "</td><td>";
            echo $worksheet->getCell('C' . $row)->getValue();
            echo "</td><td>";
            echo $worksheet->getCell('D' . $row)->getValue();
            echo "</td><tr>";
        }
        echo "</table>";
        ?>

    </body>
</html>