$(function () {
  $('#list-of-proyects').on('change',onNuevoProyectoSeleccionado);
});
function onNuevoProyectoSeleccionado() {
  var proyect_id = $(this).val();
  location.href = '/seleccionar/proyecto/'+proyect_id;
}
