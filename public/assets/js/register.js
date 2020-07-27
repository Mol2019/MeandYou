(function($) {

  $('#residence').parent().append('<ul class="list-item" id="newresidence" name="residence"></ul>');
  $('#residence option').each(function(){
      $('#newresidence').append('<li value="' + $(this).val() + '">'+$(this).text()+'</li>');
  });
  $('#residence').remove();
  $('#newresidence').attr('id', 'residence');
  $('#residence li').first().addClass('init');
  $("#residence").on("click", ".init", function() {
      $(this).closest("#residence").children('li:not(.init)').toggle();
  });

  var allOptions = $("#residence").children('li:not(.init)');
  $("#residence").on("click", "li:not(.init)", function() {
      allOptions.removeClass('selected');
      $(this).addClass('selected');
      $("#residence").children('.init').html($(this).html());
      allOptions.toggle();
  });

  var marginSlider = document.getElementById('slider-margin');
  if (marginSlider != undefined) {
      noUiSlider.create(marginSlider, {
            start: [500],
            step: 10,
            connect: [true, false],
            tooltips: [true],
            range: {
                'min': 0,
                'max': 1000
            },
            format: wNumb({
                decimals: 0,
                thousand: ',',
                prefix: '$ ',
            })
    });
  }
  $('#reset').on('click', function(){
      $('#register-form').reset();
  });


})(jQuery);
