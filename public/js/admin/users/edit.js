$(function () {
  $('#select-project').on('change', SelectProyect);
});

function SelectProyect() {
  var project_id = $(this).val();
  //alert(project_id);

  if (! project_id) {
    $('#select-level').html('<option value="">Seleccione Nivel</option>');
    return;
  }

  $.get('/api/proyecto/'+project_id+'/niveles', function (data) {
    var html_select = '<option value="">Seleccione Nivel</option>';
    for (var i = 0; i < data.length; ++i)
      html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
    $('#select-level').html(html_select);
  });
}
