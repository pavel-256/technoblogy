$('.delete-post-btn').on('click', function () {

  if (confirm('Are you sure?')) {
    return true;
  } else {
    return false;
  }

});

$('#image-field').on('change', function (e) {
  var fileName = e.target.files[0].name;
  $('.custom-file-label').html(fileName);
});