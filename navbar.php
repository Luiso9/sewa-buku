
<body class="no-skin">
  <?php
  require_once './lib/koneksi.php';
  ?>
  <div id="navbar" class="navbar navbar-default bg-green-200 ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>

      <div class="navbar-header pull-left">
        <a href="adminmainapp.php?unit=dashboard" class="navbar-brand"><small><i class="fa fa-desktop"></i> Taruna SMKN
            3 Yogyakarta </small></a>
      </div>

      <div class="navbar-buttons navbar-header pull-right white" role="navigation">
        <ul class="nav ace-nav">
          <span class="user-info"><small>Selamat Datang</small> <?php echo $dupdate['nm_pengguna']; ?></span>
          </a>
        </ul>
      </div>
    </div><!-- /.navbar-container -->
  </div>