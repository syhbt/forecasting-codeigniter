<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!--<li class="header">MAIN MENU</li>-->
      <?php
      foreach($sidebar_nav as $index  => $val):
      ?>
      <?php if(isset($val['sub_menu']) && ($val['sub_menu']=="")): ?>
      <li><a href="<?=$val['main_url']?>"><span class="<?=$val['class']?>"></span> <?=$val['desc']?></a></li>
      <?php
      else :
      ?>
      <li class="treeview">
        <a href="#">
          <span class="<?=$val['class']?>"></span>  <?=$val['desc']?>
        </a>
        <ul class="treeview-menu">
          <?php
            if(isset($submenu_side[$val["sub_menu"]])) :
            $subMenu = $submenu_side[$val["sub_menu"]];
            foreach($subMenu as $indexSub => $row) :
          ?>
          <li><a href="<?=$val['main_url'].$row["url"]?>"><span class="<?=$row["class"]?>"></span> <?=$row["desc"]?></a></li>
          <?php
        endforeach;
        endif;
        ?>
        </ul>
      </li>
      <?php
      endif; ?>
      <?php
      endforeach;
      ?>
      <li class="header">Access Site</li>
      <?php
        foreach($site_sidebar as $link_site => $site_acc) : 
      ?>
      <li><a href="<?=base_url().$link_site?>">
      <span><?=$site_acc["site_name"]?></span></a>
      </li>
      <?php
        endforeach;
      ?>
    </ul>
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <img src="<?=ASSETS_IMAGE_URL?>logo-technobit.png" style="width:90%"/>
    </div>
  </section>
  <!-- /.sidebar -->
</aside>