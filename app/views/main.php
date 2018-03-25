<div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>Hello, world! <span class="glyphicon glyphicon-search" aria-hidden="true"></span></h1>
            <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
          </div>

          <div class="col-xs-12 col-sm-9">

            <form id="reg_form" onsubmit="reg(this);return false;" role="form">
            <fieldset><legend class="text-center">Valid information is required to register. <span class="req"><small> required *</small></span></legend>

            <div class="form-group">
            <label for="cellphone"><span class="req">* </span> Phone Number: </label>
              <input required type="text" name="cellphone" id="cellphone" class="form-control phone" maxlength="28" placeholder="+380.."/>
            </div>

            <div class="form-group">
                <label for="firstname"><span class="req">* </span> Name: </label>
                <input class="form-control" type="text" name="name" required />
            </div>


            <div class="form-group">
                <label for="email"><span class="req">* </span> Email Address: </label>
                <input class="form-control" required type="text" name="email" id="email" />
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3">Gender</label>

                <div class="row">
                  <div class="col-sm-2">
                    <label class="radio-inline">
                      <input checked type="radio" name="sex" value="2">Female
                    </label>
                  </div>
                  <div class="col-sm-2">
                    <label class="radio-inline">
                      <input type="radio"  name="sex" value="1">Male
                    </label>
                  </div>
                  <div class="col-sm-3">
                    <label class="radio-inline">
                      <input type="radio"  name="sex" value="3">Other
                    </label>
                  </div>
                </div>

            </div>

            <div class="form-group">
              <label class="control-label col-sm-3">Date of birth</label>
              <div class="row">
                <div class="col-sm-2">
                  <select name="day" class="form-control">
                    <?
                      for ($i=1; $i < 32 ; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="col-sm-3">
                  <select name="month" class="form-control">
                    <?
                      foreach (explode(',', model::$lang['months']) as $key => $value) {
                        echo '<option value="'.($key+1).'">'.$value.'</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="col-sm-3">
                  <select name="year" class="form-control">
                    <?
                      for ($i=1930; $i < 2008 ; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
                <label for="password"><span class="req">* </span> Password: </label>
                <input required name="password" type="text" class="form-control inputpass" minlength="4" maxlength="32"  id="pass" /> </p>
            </div>

            <div class="form-group">

                <hr>

                <input type="checkbox" required name="terms" id="field_terms">   <label for="terms">I agree with the <a href="/" title="You may read our terms and conditions by clicking on this link">terms and conditions</a> for Registration.</label><span class="req">*</span>
            </div>

            <div class="form-group">
                <input class="btn btn-success" type="submit" name="submit_reg" value="Register">
            </div>
            <h5>You will receive an email to complete the registration and validation process. </h5>
            <h5>Be sure to check your spam folders. </h5>


            </fieldset>
            </form><!-- ends register form -->
          </div>

          <div class="row">
            <div class="col-xs-6 col-lg-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">

          <form onsubmit="login(this);return false;" class="form-horizontal" role="form">

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="email">
            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
            </div>

            <div class="input-group">
              <div class="checkbox">
                <label>
                  <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                </label>
              </div>
            </div>

            <div style="margin-top:10px" class="form-group">
              <div class="col-sm-12 controls">
                <input class="btn btn-success" type="submit" value="Login">
              </div>
            </div>

          </form>


        </div>

</div><!--/row-->

<script type="text/javascript">
  function on_page_ready() {
    console.log('page ready!');

  }
</script>
