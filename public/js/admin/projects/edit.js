$(function() {
  $('[data-category]').on('click', editCategoryModal);
  $('[data-level]').on('click', editLevelModal);
});
function editCategoryModal() {
  //rescatar id
  var category_id = $(this).data('category');
  //alert(category_id);
  $('#category_id').val(category_id);
  //rescatar name
  var category_name = $(this).parent().prev().text();
  //alert(name);
  $('#category_name').val(category_name);
  //mostrar el modal
  $('#modalEditCategory').modal('show');
}
function editLevelModal() {
  //rescatar id
  var level_id = $(this).data('level');
  //alert(category_id);
  $('#level_id').val(level_id);
  //rescatar name
  var level_name = $(this).parent().prev().text();
  //alert(name);
  $('#level_name').val(level_name);
  //mostrar el modal
  $('#modalEditLevel').modal('show');
}
