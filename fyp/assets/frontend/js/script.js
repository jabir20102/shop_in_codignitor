// FOR MULTILEVEL DROPDOWN MENU IN CATEGORIES

$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = $(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });

  return false;
});

// ENABELING THE TOOLTIPS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});


// FOR THE SUMMERNOTE HTML EDITOR 
$(document).ready(function(){
  $('#summernote').summernote({
    placeholder: 'Enter something interesting about you.',
    height: 150,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['style']],
      ['format', ['bold', 'italic', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link', 'table', 'hr']],
      ['misc', ['fullscreen', 'codeview', 'help']]
    ]
  });

  $('#long-description').summernote({
    placeholder: 'Enter Detail Description of Tutorial.',
    height: 250,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['style']],
      ['format', ['bold', 'italic', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link', 'table', 'hr']],
      ['misc', ['fullscreen', 'codeview', 'help']]
    ]
  });

    $('#instructions').summernote({
    placeholder: 'Enter Instructions for the code lesson.',
    height: 200,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['style']],
      ['format', ['bold', 'italic', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link', 'table', 'hr']],
      ['misc', ['fullscreen', 'codeview', 'help']]
    ]
  });

  $('#report').summernote({
    placeholder: 'Enter the valid reason to report this tutorial',
    height: 250,
    toolbar: [
      // [groupName, [list of button]]
      ['format', ['bold', 'italic', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'paragraph']]
    ]
  });

  $('.note-editor .note-icon-caret').remove();

  // FOR CODEMIRROR CODE EDITOR
  var defaultValue = '<!DOCTYPE html>\n<html>\n<body>\n<h2>My First JavaScript</h2>\n<button type="button"onclick="document.getElementById(\'demo\').innerHTML = Date()">Click me to display Date and Time.</button>\n<p id="demo"></p>\n</body>\n</html> \n';

  var codeMirror = CodeMirror(document.getElementById("editor"), {
    value: defaultValue,
    mode:  "htmlmixed",
    lineNumbers: true,
    lineWrapping: true
  });

  // this is the functionality of run code button
  $('.run-code-btn').on('click', function(){
        var myFrame = $("#results").contents().find('html');
        var code = codeMirror.getValue();
        myFrame.html(code);
  });

  // for tags input
  $('#tags-input').tagsinput({
    tagClass: 'badge-primary mr-1',
    maxTags: 10,
    maxChars: 500
  });

  $("input[name='pref-categories[]']").change(function () {
      var maxAllowed = 3;
      var cnt = $("input[name='pref-categories[]']:checked").length;
      console.log(cnt);
      
      if (cnt >= maxAllowed) {
        // if 3 coategories are checked then diable all other categories

        if(cnt > maxAllowed){
          // if 4th category is checked then uncheck that and disable that
          $(this).prop('checked', '');
        }
        
        $("input[name='pref-categories[]']:not(:checked)").attr('disabled', true);
      }
      else{
        $("input[name='pref-categories[]']:disabled").attr('disabled', false);
      }
  });

  $('#Pref-Btn').click(function() {
      checked = $("input[name='pref-categories[]']:checked").length;

      if(!checked) {
        alert("You must Select atleast One Category.");
        return false;
      }

  });

});

$("#editbtn").click(function(){
    $("#editForm").fadeIn();
    $('#review').hide();
});