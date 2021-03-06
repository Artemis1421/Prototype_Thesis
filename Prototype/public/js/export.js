
//export table to pdf
function generatePDF() {
  var doc = new jsPDF('l', 'pt');

  var elem = document.getElementById('table_with_data');
  var data = doc.autoTableHtmlToJson(elem);
  doc.autoTable(data.columns, data.rows, {
    margin: {left: 35},
    theme: 'grid',
    tableWidth: 'auto',
    fontSize: 8,
    overflow: 'linebreak',
    }
  );
    
  doc.save('Daily Sales.pdf');
}