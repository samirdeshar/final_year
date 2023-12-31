<?php
// use App\Models\Admin\Setting\Setting;

// $setting=new Setting();

// $setting=$setting->first();

?>
<style>
    /* ul li a {
        color : yellow !important;
    } */

</style>
<aside id="sidebar" class="sidebar" style="width: 200px;">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin')?'':'collapsed'}}" href="{{route('admin')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">MENU</li>

      {{-- ----------------------------Setting----------------------------------- --}}
      @if(Auth::user()->can("create-setting")  || Auth::user()->can("edit-setting"))
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('setting*')?'':'collapsed'}}" data-bs-target="#components-setting" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-fill"></i><span>Setting</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-setting" class="nav-content collapse {{ request()->routeIs('setting*')?'show':''}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('setting.index')}}" class="{{ request()->routeIs('setting.edit')?'active':''}} small-link">
              <i class="bi bi-circle"></i><span>Site Setting</span>
            </a>
          </li>
        </ul>
      </li>
      @endif
      {{-- ----------------------------/Setting----------------------------------- --}}


      {{-- -------------------------All Users--------------------------------------------}}
      @if (Auth::user()->can('view-user') || Auth::user()->can('create-user') || Auth::user()->can('edit-user') || Auth::user()->can('remove-user'))
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user*')?'':'collapsed'}}" data-bs-target="#components-user" data-bs-toggle="collapse" href="#">
            <i class="nav-icon fas fa-user"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-user" class="nav-content collapse {{ request()->routeIs('user*')?'show':''}}" data-bs-parent="#sidebar-nav">
            @if (Auth::user()->can('view-user'))
            <li>
                <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.index')?'active':''}}">
                  <i class="bi bi-circle"></i><span>View All Users</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->can('create-user'))
            <li>
                <a href="{{ route('user.create')}}" class="{{ request()->routeIs('user.create')?'active':''}}">
                    <i class="bi bi-circle"></i><span>Create New User</span>
                </a>
            </li>
            @endif
        </ul>
     </li>
     @endif






      {{---------- ---------------Permission-------------------------------------------------------- --}}
    @if (Auth::user()->can('view-permission') || Auth::user()->can('create-permission') || Auth::user()->can('edit-permission') || Auth::user()->can('remove-permission'))
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('permission*')?'':'collapsed'}}" data-bs-target="#components-permission" data-bs-toggle="collapse" href="#">
            <i class="nav-icon fas fa-shield-alt"></i><span>Permission</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-permission" class="nav-content collapse {{ request()->routeIs('permission*')?'show':''}}" data-bs-parent="#sidebar-nav">
            @if (Auth::user()->can('view-permission'))
            <li>
                <a href="{{ route('permission.index') }}" class="{{ request()->routeIs('permission.index')?'active':''}}">
                  <i class="bi bi-circle"></i><span>All Permision</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->can('create-permission'))
            <li>
            <a href="{{ route('permission.create')}}" class="{{ request()->routeIs('permission.create')?'active':''}}">
              <i class="bi bi-circle"></i><span>Add Permission</span>
            </a>
          </li>
          @endif
        </ul>
      </li>
    @endif


{{-- ---------------------------------Roles-------------------------------------------- --}}
<li class="nav-item">
    @if(Auth::user()->can('view-roles') || Auth::user()->can('create-roles') || Auth::user()->can('edit-role') || Auth::user()->can('remove-role'))
    <a class="nav-link {{ request()->routeIs('roles*')?'':'collapsed'}}" data-bs-target="#components-roles" data-bs-toggle="collapse" href="#">
        <i class="nav-icon fas fa-user-tag"></i><span>Roles</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-roles" class="nav-content collapse {{ request()->routeIs('roles*')?'show':''}}" data-bs-parent="#sidebar-nav">
        @if (Auth::user()->can('view-role'))
        <li>
            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.index')?'active':''}}">
              <i class="bi bi-circle"></i><span>All Roles</span>
            </a>
        </li>
        @endif
        @if (Auth::user()->can('create-role'))
        <li>
        <a href="{{ route('roles.create')}}" class="{{ request()->routeIs('roles.create')?'active':''}}">
          <i class="bi bi-circle"></i><span>Add Roles</span>
        </a>
      </li>
      @endif
    </ul>
  </li>
  @endif
  <br>
__________________________________________________________________

   {{-- -------------------------All Booking--------------------------------------------}}
   @if (Auth::user()->can('view-user')  || Auth::user()->can('remove-user'))
   <li class="nav-item">
     <a class="nav-link {{ request()->routeIs('user*')?'':'collapsed'}}" data-bs-target="#components-booking" data-bs-toggle="collapse" href="#">
         <i class="nav-icon fas fa-user"></i><span>Booking List</span><i class="bi bi-chevron-down ms-auto"></i>
     </a>
     <ul id="components-booking" class="nav-content collapse {{ request()->routeIs('user*')?'show':''}}" data-bs-parent="#sidebar-nav">
         @if (Auth::user()->can('view-user'))
         <li>
             <a href="{{ route('allbokking') }}" class="{{ request()->routeIs('user.index')?'active':''}}">
               <i class="bi bi-circle"></i><span>View All Booking</span>
             </a>
         </li>
         @endif

     </ul>
  </li>
  @endif
___________________________________________________________________
  <br><br>

  {{-- ----------------------------Menu----------------------------------- --}}
  @if (Auth::user()->can('view-menu') || Auth::user()->can('create-menu') || Auth::user()->can('edit-menu') || Auth::user()->can('remove-menu'))
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('menu*')?'':'collapsed'}}" data-bs-target="#components-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-card-image"></i><span>Menu</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-menu" class="nav-content collapse {{ request()->routeIs('menu*')?'show':''}}" data-bs-parent="#sidebar-nav">
        @if (Auth::user()->can("view-menu"))
        <li>
            <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.index')?'active':''}}">
              <i class="bi bi-circle"></i><span>View Menu</span>
            </a>
        </li>
        @endif
        @if (Auth::user()->Can("create-menu"))
        <li>
        <a href="{{ route('menu.create')}}" class="{{ request()->routeIs('menu.create')?'active':''}}">
          <i class="bi bi-circle"></i><span>Create Menu</span>
        </a>
      </li>
      @endif
    </ul>
  </li>
  @endif
  {{-- ----------------------------/Menu----------------------------------- --}}



<br><br>

       {{-- ----------------------------Post----------------------------------- --}}
       @if (Auth::user()->can("view-post") || Auth::user()->can("create-post") || Auth::user()->Can("edit-post") || Auth::user()->can("remove-post") || Auth::user()->can("view-postcategory") || Auth::user()->can("create-postcategory") || Auth::user()->can("edit-postcategory") || Auth::user()->can("remove-postcategory") || Auth::user()->can("create-posttag") || Auth::user()->can("view-posttag") || Auth::user()->can("create-posttag") || Auth::user()->can("edit-posttag") || Auth::user()->can("remove-posttag"))
       <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('post*')?'':'collapsed'}}" data-bs-target="#components-post" data-bs-toggle="collapse" href="#">
            <i class="fa-solid fa-blog"></i></i><span>Blogs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-post" class="nav-content collapse {{ request()->routeIs('post*')?'show':''}}" data-bs-parent="#sidebar-nav">
            @if (Auth::user()->can("view-post"))
            <li>
                <a href="{{ route('post.index')}}" class="{{ request()->routeIs('post.index')?'active':''}}">
                <i class="bi bi-circle"></i><span>All Blog</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->can("create-post"))
            <li>
                <a href="{{ route('post.create')}}" class="{{ request()->routeIs('post.create')?'active':''}}">
                <i class="bi bi-circle"></i><span>Add Blog</span>
                </a>
            </li>
            @endif

            @if (Auth::user()->can("view-postcategory") || Auth::user()->can("create-postcategory") || Auth::user()->can("edit-postcategory") || Auth::user()->can("remove-postcategory"))
            <li>
                <a href="{{ route('postcategory.index')}}" class="{{ request()->routeIs('postcategory.index')?'active':''}}">
                <i class="bi bi-circle"></i><span>Blog Categories</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->Can("view-posttag") || Auth::user()->can("create-posttag") || Auth::user()->can("edit-posttag") || Auth::user()->can("remove-posttag"))
            <li>
                <a href="{{route('posttag.index') }}" class="{{ request()->routeIs('posttag.index')?'active':''}}">
                <i class="bi bi-circle"></i><span>Tags</span>
                </a>
            </li>
            @endif
        </ul>
      </li>
      @endif
       {{-- ----------------------------Post----------------------------------- --}}

        {{-- ------------------------General Pages --------------------------- --}}
        @if (Auth::user()->can("create-generalpage") || Auth::user()->can("view-generalpage") || Auth::user()->can("edit-generalpage") || Auth::user()->can("remove-generalpage"))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('generalPage*')?'':'collapsed'}}" data-bs-target="#components-generalPage" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-post"></i><span>Pages</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="components-generalPage" class="nav-content collapse {{ request()->routeIs('generalPage*')?'show':''}}" data-bs-parent="#sidebar-nav">
                @if (Auth::user()->can("view-generalpage"))
                <li>
                    <a href="{{ route('generalPage.index') }}" class="{{ request()->routeIs('generalPage.index')?'active':''}}">
                      <i class="bi bi-circle"></i><span>All Pages</span>
                    </a>
                  </li>
                @endif
                @if(Auth::user()->can("create-generalpage"))
                <li>
                <a href="{{ route('generalPage.create')}}" class="{{ request()->routeIs('generalPage.create')?'active':''}}">
                  <i class="bi bi-circle"></i><span>Add New</span>
                </a>
                </li>
                @endif
            </ul>
          </li>
          @endif
          {{-- -------------------------end Pages---------------------------------- --}}



        {{-- -------------------------------TestiMonials----------------------------------------- --}}
        @if (Auth::user()->can("view-testimonial") || Auth::user()->can("create-testimonial") || Auth::user()->can("edit-testimonial") || Auth::user()->can("remove-testimonial"))
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('testimonial*')?'':'collapsed'}}" data-bs-target="#components-testimonial" data-bs-toggle="collapse" href="#">
            <i class="fa fa-comments"></i><span>Testimonial</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-testimonial" class="nav-content collapse {{ request()->routeIs('testimonial*')?'show':''}}" data-bs-parent="#sidebar-nav">
            @if (Auth::user()->can("view-testimonial"))
            <li>
                <a href="{{ route('testimonial.index') }}" class="{{ request()->routeIs('testimonial.index')?'active':''}}">
                  <i class="bi bi-circle"></i><span>All Testimonial</span>
                </a>
              </li>
            @endif
            @if (Auth::user()->can("create-testimonial"))
            <li>
            <a href="{{ route('testimonial.create')}}" class="{{ request()->routeIs('testimonial.create')?'active':''}}">
              <i class="bi bi-circle"></i><span>Add Testimonial</span>
            </a>
            </li>
            @endif
        </ul>
      </li>
      @endif
        {{-- ---------------------------------------------TestiMonials--------------------------------- --}}


         {{---------------------------------------------- Team -----------------------------------------------}}
         @if (Auth::user()->can("create-teammember") || Auth::user()->can("view-teammember") || Auth::user()->can("edit-teammember") || Auth::user()->can("remove-teammember") || Auth::user()->can("view-teamcategory") || Auth::user()->can("create-teamcategory") || Auth::user()->can("edit-teamcategory") || Auth::user()->can("remove-teamcategory"))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('team*')?'':'collapsed'}}" data-bs-target="#components-team" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Team Member</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-team" class="nav-content collapse {{ request()->routeIs('team*')?'show':''}}" data-bs-parent="#sidebar-nav">
                @if (Auth::user()->can("view-teammember"))
                <li>
                    <a href="{{ route('team.index') }}" class="{{ request()->routeIs('team.index')?'active':''}}">
                    <i class="bi bi-circle"></i><span>All Team Member</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->can("create-teammember"))
                <li>
                    <a href="{{ route('team.create')}}" class="{{ request()->routeIs('team.create')?'active':''}}">
                    <i class="bi bi-circle"></i><span>Add New Member</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->can("view-teamcategory") || Auth::user()->can("create-teamcategory") || Auth::user()->can("edit-teamcategory") || Auth::user()->can("remove-teamcategory"))
                <li>
                    <a href="{{ route('teamcategory.index')}}" class="{{ request()->routeIs('teamcategory.index')?'active':''}}">
                    <i class="bi bi-circle"></i><span>Team Categories</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        {{---------------------------------------------------------------- Team --------------------------------------------------}}
        @if (Auth::user()->can("create-teammember") || Auth::user()->can("view-teammember") || Auth::user()->can("edit-teammember") || Auth::user()->can("remove-teammember") || Auth::user()->can("view-teamcategory") || Auth::user()->can("create-teamcategory") || Auth::user()->can("edit-teamcategory") || Auth::user()->can("remove-teamcategory"))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('awards*')?'':'collapsed'}}" data-bs-target="#components-awards" data-bs-toggle="collapse" href="#">
                <i class="fas fa-award"></i><span>Awards</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-awards" class="nav-content collapse {{ request()->routeIs('awards*')?'show':''}}" data-bs-parent="#sidebar-nav">
                @if (Auth::user()->can("view-teammember"))
                <li>
                    <a href="{{ route('awards.index') }}" class="{{ request()->routeIs('awards.index')?'active':''}}">
                    <i class="bi bi-circle"></i><span>All Awards</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->can("create-teammember"))
                <li>
                    <a href="{{ route('awards.create')}}" class="{{ request()->routeIs('awards.create')?'active':''}}">
                    <i class="bi bi-circle"></i><span>Add New Awards</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->can("view-teamcategory") || Auth::user()->can("create-teamcategory") || Auth::user()->can("edit-teamcategory") || Auth::user()->can("remove-teamcategory"))
                <li>
                    <a href="{{ route('awardscategory.index')}}" class="{{ request()->routeIs('awardscategory.index')?'active':''}}">
                    <i class="bi bi-circle"></i><span>Awards Categories</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif



<br><br>
{{-- ------------------------------------------General Faqs------------------------------------- --}}
    @if (Auth::user()->can("view-generalfaq") || Auth::user()->can("create-generalfaq") || Auth::user()->can("edit-generalfaq") || Auth::user()->can("remove-general"))
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('generalFaq*')?'':'collapsed'}}" data-bs-target="#components-generalFaq" data-bs-toggle="collapse" href="#">
            <i class="fa fa-comment"></i><span>General FAQs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-generalFaq" class="nav-content collapse {{ request()->routeIs('generalFaq*')?'show':''}}" data-bs-parent="#sidebar-nav">
            @if (Auth::user()->can("view-generalfaq"))
            <li>
                <a href="{{ route('generalFaq.index') }}" class="{{ request()->routeIs('generalFaq.index')?'active':''}}">
                  <i class="bi bi-circle"></i><span>All Items</span>
                </a>
              </li>
            @endif
            @if (Auth::user()->can("create-generalfaq"))
            <li>
            <a href="{{ route('generalFaq.create')}}" class="{{ request()->routeIs('generalFaq.create')?'active':''}}">
              <i class="bi bi-circle"></i><span>Add New</span>
            </a>
          </li>
          @endif
        </ul>
      </li>
      @endif
      {{-- ---------------------------Out Partners------------------------------ --}}
      @if (Auth::user()->can("create-partner") || Auth::user()->can("edit-partner") || Auth::user()->can("view-partner") || Auth::user()->can("remove-partner"))
      <li class="nav-item ">
        <a class="nav-link  {{ request()->routeIs('partner.index') || request()->routeIs('partner.edit')?'':'collapsed'}}" href="{{ route('partner.index') }}">
          <i class="fa fa-handshake"></i>
          <span>Our Partners</span>
        </a>
      </li>
      @endif
      {{-- end --}}

      @if (Auth::user()->can("create-about") || Auth::user()->can("edit-about"))
      <li class="nav-item ">
        <a class="nav-link  {{ request()->routeIs('all-messages.index') || request()->routeIs('all-messages.edit')?'':'collapsed'}}" href="{{ route('all-messages.index') }}">
          <i class="bi bi-file-earmark-person"></i>
          <span>All Messages</span>
        </a>
      </li>
      @endif

      {{-- ----------------------------About Us----------------------------------- --}}
      @if (Auth::user()->can("create-about") || Auth::user()->can("edit-about"))
        <li class="nav-item ">
          <a class="nav-link  {{ request()->routeIs('about.index') || request()->routeIs('about.edit')?'':'collapsed'}}" href="{{ route('about.index') }}">
            <i class="bi bi-file-earmark-person"></i>
            <span>About Us</span>
          </a>
        </li>
        @endif
      {{-- ----------------------------/About Us----------------------------------- --}}
  </aside>
