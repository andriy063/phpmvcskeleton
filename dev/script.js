$(document).ready(function() {
  if (typeof on_page_ready === "function") {
    on_page_ready();
  }

  $('[data-toggle="offcanvas"]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

});

function login(form) {
  console.log(form);

    $.ajax({
      type: "POST",
      url: "/"+lang.code+"/act/login/",
      /*dataType: "json",*/
      data: new FormData(form),
      processData: false,
      contentType: false,
      beforeSend: function(e) {
        requestRunning = true;

      },
      success: function(res) {
        console.log(res);


        if (res.status === 'error') {
          alert(res.data.message);
        } else if (res.status === 'success') {
          $(form)['0'].reset();
          location.reload(true);

        } else {
          alert(lang.uncaughtError);
        }
      },
      complete: function() { requestRunning = false; },
      error: function(x, t, m) {
        console.log( lang.uncaughtError );
        console.log(x);
        console.log(t);
        console.log(m);
        requestRunning = false;
      }
    });
}

/* This function makes registration process */
var requestRunning = false;
function reg(form) {
  console.log(form);

    /* Makes POST request if all submitted data is correct */
    $.ajax({
      type: "POST",
      url: "/"+lang.code+"/act/reg/",
      /*dataType: "json",*/
      data: new FormData(form),
      processData: false,
      contentType: false,
      beforeSend: function(e) {
        requestRunning = true;

      },
      xhr: function() {
        var myXhr = $.ajaxSettings.xhr();
        if (myXhr.upload) {
          myXhr.upload.addEventListener('progress', function (e) {
            $('#regProgress').html(Math.floor(((e.loaded * 100) / e.total))+'%');
          }, false);
        }
        return myXhr;
      },
      success: function(res) {
        console.log(res);


        if (res.status === 'error') {
          alert(res.data.message);
        } else if (res.status === 'success') {
          $(form)['0'].reset();
          location.reload(true);

        } else {
          alert(lang.uncaughtError);
        }
      },
      complete: function() { requestRunning = false; },
      error: function(x, t, m) {
        console.log( lang.uncaughtError );
        console.log(x);
        console.log(t);
        console.log(m);
        requestRunning = false;
      }
    });

}
