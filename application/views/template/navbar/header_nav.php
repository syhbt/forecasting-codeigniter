<header class="main-header">
    <a href="<?= base_url()?>" class="logo">
    
    Sistem Peramalan</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
       <a href="<?=base_url()?>forecasting/dashboard/" class="sidebar-toggle" >
        <span class="glyphicon glyphicon-align-justify"></span> Beranda
      </a>


      <a href="<?=base_url()?>" class="sidebar-toggle" >
        <span class="glyphicon glyphicon-align-justify"></span> Transaksi
      </a>

     
      
      <a href="<?=base_url()."hasil/"?>" class="sidebar-toggle" >
        <span class="glyphicon glyphicon-list"></span> Hasil Peramalan
      </a>

      <a href="<?=base_url()."user/"?>" class="sidebar-toggle" >
        <span class="glyphicon glyphicon-list"></span> Admin
      </a>
<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><i class="fa fa-user"> </i> <?=$username?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  <?=$username?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="text-center">
                  <a href="<?=$link_logout?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    
</header>