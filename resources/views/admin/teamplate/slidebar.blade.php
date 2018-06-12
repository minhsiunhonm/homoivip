  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('public/avatar')}}/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Tìm kiếm...">
              <span class="input-group-btn">
                <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="@if(isset($menu)) @if($menu == 'member') active @endif @endif">
          <a href="{{url('m/member')}}">
            <i class="fa  fa-group"></i> <span>Thành viên</span>
          </a>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="@if(isset($menu)) @if($menu == 'project') active @endif @endif">
          <a href="{{url('m/project')}}">
            <i class="glyphicon  glyphicon-file"></i> <span>Dự án</span>
          </a>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="@if(isset($menu)) @if($menu == 'bill') active @endif @endif">
          <a href="{{url('m/bill')}}">
            <i class="glyphicon glyphicon-qrcode"></i> <span>Hóa đơn</span>
          </a>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="@if(isset($menu)) @if($menu == 'very') active @endif @endif">
          <a href="{{url('m/very')}}">
            <i class="glyphicon glyphicon-ok"></i> <span>Very</span>
          </a>
        </li>
      </ul>
      <!-- <ul class="sidebar-menu" data-widget="tree">
        <li class="@if(isset($menu)) @if($menu == 'mail') active @endif @endif">
          <a href="{{url('m/mail')}}">
            <i class="fa fa-envelope"></i> <span>Mail</span>
          </a>
        </li>
      </ul> -->
    </section>
    <!-- /.sidebar -->
  </aside>