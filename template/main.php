<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin Template · Bootstrap v4.6</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
  <div class="form-signin" method="post" action="http://localhost/client/index/admin">
    <h1 class="h3 mb-3 font-weight-normal">Ссылка на Страницу</h1>
    <input type="text" class="link form-control"  placeholder="Ссылка" required autofocus>
    <button class="btn btn-lg btn-primary btn-block makeShotLink" type="submit" >Сократить</button>
    <input type="text" class="form-control shortLink" placeholder="Сокращенная ссылка" required>
    
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
  </div>
  <script>
    let shorLink = ''
    
    $(document).on('click', '.makeShotLink', function(){
      let link = $('.link').val().trim()
      if (link != '') {
        var prefix = 'http://';
        if (link.substr(0, 'http://'.length) !== 'http://' && link.substr(0, 'https://'.length) !== 'https://')
        {
          link = 'https://' + link;
        }
        console.log(link)
        if (isValidUrl(link)) {
          $.ajax({
            url: "/short/makeShortLink",
            type: "POST",
            data: {link : link},
            success: function(data){
              data = JSON.parse(data)
              if (data['result'] == 'ok') {
                $('.shortLink').val('http://localhost/short/' + data['short'])
              }
            }
          });

        }else{
          $('.link').css("border-color", "red")
          alert('кривая Ссылка')
          setTimeout(() => {
            $('.link').css("border-color", "")
          }, 3000);
        }
      }else{
        $('.link').css("border-color", "red")
        alert('поля Ссылка пустая')
        setTimeout(() => {
          $('.link').css("border-color", "")
        }, 3000);
      }
      
    })
    $(document).on('input', '.link', function(){
      $(this).css("border-color", "")
    })
    
    $(document).on('click', '.shortLink', function(){
      shorLink = $(this).val().trim()
    })
    $(document).on('input', '.shortLink', function(){
      $(this).val(shorLink)
    })
    function isValidUrl(url) {
      try {
        new URL(url);
      } catch (e) {
        console.error(e);
        return false;
      }
      return true;
    };
  </script>
  </body>
</html>