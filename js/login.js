$(document).ready(function() {
  $('#loginForm').submit(function(e) {
    e.preventDefault()

    var $form = $(this)

    if(!$form.valid()) return false;
    
  })
})