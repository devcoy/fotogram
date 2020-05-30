window.addEventListener('load', function () {
  //alert('Page is loaded!');

  // Dar like
  function like() {
    $('.like').unbind('click').click(function () {
      alert('Like');
      $(this).addClass('dislike').removeClass('like');
      $(this).attr('src', 'img/like.svg');
      dislike();
    });
  }
  like();


  // Dar dislike
  function dislike() {
    $('.dislike').unbind('click').click(function () {
      alert('Dislike');
      $(this).addClass('like').removeClass('dislike');
      $(this).attr('src', 'img/dislike.svg');
      like();
    });
  }
  dislike();

});