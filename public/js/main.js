window.addEventListener('load', function () {
  //alert('Page is loaded!');
  const url = 'http://localhost:8888/fotogram/public/';

  dislike();
  like();

  // Dar like
  function like() {
    $('.btn-dislike').unbind('click').click(function () {
      //alert('Like');
      $(this).addClass('btn-like').removeClass('dislike');
      $(this).attr('src', 'img/like.svg');

      $.ajax({
        url: url + 'like/' + $(this).data('id'),
        type: 'GET',
        success: function (response) {
          //console.log(response);
          if (response.status === 'success') {
            console.log(response.message);
          } else {
            console.log('Error al dar like');
          }
        }
      });
      dislike();
    });
  }


  // Dar dislike
  function dislike() {
    $('.btn-like').unbind('click').click(function () {
      //alert('Dislike');
      $(this).addClass('btn-dislike').removeClass('btn-like');
      $(this).attr('src', 'img/dislike.svg');

      $.ajax({
        url: url + 'dislike/' + $(this).data('id'),
        type: 'GET',
        success: function (response) {
          //console.log(response);
          if (response.like) {
            console.log(response.message);
          } else {
            console.log('Error al dar like');
          }
        }
      });
      like();
    });
  }


});