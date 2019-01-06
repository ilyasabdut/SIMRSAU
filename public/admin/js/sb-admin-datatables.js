// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
      "order": [[0,"desc"]],

      'createdRow': function(row, data, dataIndex) {
      var $dateCell = $(row).find('td:eq(0)'); 
      var dateOrder = $dateCell.text();
      $dateCell
          .data('order', dateOrder)
          .text(moment(dateOrder).local().format('LLLL'));
        }
      });
});

$(document).ready(function() {
  $('#perawat').DataTable({
    
      "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
      "order": [[0,"asc"]],

      'createdRow': function(row, data, dataIndex) {
      var $dateCell = $(row).find('td:eq(0)'); 
      var dateOrder = $dateCell.text();
      $dateCell
          .data('order', dateOrder)
          .text(moment(dateOrder).local().format('LLLL'));
        }
      });
});

$(document).ready(function() {
  $('#dataTables').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
  	      "order": [[0,"desc"]]
  }
  	);
});

$(document).ready(function() {
  $('#dataPenyakit').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
          "order": [[0,"asc"]]
  }
    );
});

$(document).ready(function() {
  $('table.dataTables').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
  	      "order": [[ 2, "asc" ],[0,"asc"]]
  }
  	);
});

$(document).ready(function() {
  $('#pasien').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
        "ordering": false,
        "paging": false,
        "searching": false,
  }
    );
});

$(document).ready(function() {
  $('#resepsionis').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
      "order": [[0,"asc"]],

      'createdRow': function(row, data, dataIndex) {
      var $dateCell = $(row).find('td:eq(0)'); 
      var dateOrder = $dateCell.text();
      $dateCell
          .data('order', dateOrder)
          .text(moment(dateOrder).local().format('LL'));
        }
      });
});


$(document).ready(function() {
  $('#riwayattindakan').DataTable({
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
        },
      "order": [[0,"desc"]],
          sScrollXInner: "150%",
          sScrollX: '100%',
  

      'createdRow': function(row, data, dataIndex) {
      var $dateCell = $(row).find('td:eq(0)'); 
      var dateOrder = $dateCell.text();
      $dateCell
          .data('order', dateOrder)
          .text(moment(dateOrder).local().format('LLLL'));
        }
      });
});



