<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	

<input type="file" id="fileUpload" />
<input type="button" id="upload" value="Upload" />
<hr />
<div id="dvExcel"></div>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
<script type="text/javascript">
    $("body").on("click", "#upload", function () {
        //Reference the FileUpload element.
        var fileUpload = $("#fileUpload")[0];
 
        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
 
                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }
    });
    function ProcessExcel(data) {
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
 
        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];
 
        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);
 
        //Create a HTML Table element.
        var table = $("<table />");
        table[0].border = "1";
 
        //Add the header row.
        var row = $(table[0].insertRow(-1));
 
       //Add the header cells.

 
        var headerCell = $("<th />");
        headerCell.html("N° GUIA");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("FECHA GUIA");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("CLIENTE");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("PLANTA");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("DIETA");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("LOTE");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("OCOMPRA");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("CENTRO");
        row.append(headerCell);

        var headerCell = $("<th />");
        headerCell.html("KG");
        row.append(headerCell);


        //Add the data rows from Excel file.
        for (var i = 0; i < excelRows.length; i++) {
            //Add the data row.
            var row = $(table[0].insertRow(-1));
 
            cell = $("<td />");
            cell.html(excelRows[i]['N° GUIA']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['FECHA GUIA']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['CLIENTE']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['PLANTA']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['DIETA']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['LOTE']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['OCOMPRA']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['CENTRO']);
            row.append(cell);

            cell = $("<td />");
            cell.html(excelRows[i]['KG']);
            row.append(cell);


        }
 
        var dvExcel = $("#dvExcel");
        dvExcel.html("");
        dvExcel.append(table);
    };
</script>

</body>
</html>