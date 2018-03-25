<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=!empty($title) ? $title.' - '.model::$lang['site_title'] : model::$lang['site_title'];?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=1">
    <base href="/">
    <?=(model::$is_mobile ? '<link href="'.model::$httpsroot.'/res/css/bundle_mobile.css?v='.model::$cache_var.'" rel="stylesheet" type="text/css" />' : '<link href="'.model::$httpsroot.'/res/css/bundle.css?v='.model::$cache_var.'" rel="stylesheet" type="text/css" />');?>

  </head>
  <body>

    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="<?=model::$httpsrootlang;?>/some_page_blah">404</a></li>

            <?if (!empty(model::$user['id'])) {?>
              <li><a href=""><?=htmlspecialchars(model::$user['name'], ENT_QUOTES);?></a></li>
              <li><a href="<?=model::$httpsrootlang;?>/act/logout">Logout</a></li>
            <?}?>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
      <?
        include($_SERVER['DOCUMENT_ROOT'].'/app/views/'.$content_view);
      ?>

      <hr>

      <footer>
        <p>&copy; 2016 Company, Inc.</p>
      </footer>
    </div>

    <script type="text/javascript">
      var lang = {
        code:"<?=model::$app_lang_code;?>",
        uncaughtError:"<?=model::$lang['uncaughtError'];?>"
      }
    </script>

    <script src="<?=model::$httpsroot;?>/res/js/bundle.js?v=<?=model::$cache_var;?>"></script>
  </body>
</html>
