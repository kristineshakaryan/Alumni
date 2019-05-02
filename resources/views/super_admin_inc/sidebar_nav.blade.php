<div class="sidebar">
<nav class="sidebar-nav">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('super_admin.dashboard') }}">
        <i class="nav-icon icon-speedometer"></i> Dashboard
      </a>
    </li>
    <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon icon-cursor"></i> Group</a>
      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.AllGroups') }}">
            <i class="nav-icon icon-cursor"></i> All Groups</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.NewGroup') }}">
            <i class="nav-icon icon-cursor"></i> Add Group</a>
        </li>
      </ul>
    </li>
    <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon icon-pencil"></i> Client</a>
      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.AllClients') }}">
            <i class="nav-icon icon-pencil"></i>All Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.NewClient') }}">
            <i class="nav-icon icon-pencil"></i>Add Client</a>
        </li>
      </ul>
    </li>
{{--    <li class="nav-item nav-dropdown">--}}
{{--      <a class="nav-link nav-dropdown-toggle" href="#">--}}
{{--        <i class="nav-icon icon-puzzle"></i> Degrees</a>--}}
{{--      <ul class="nav-dropdown-items">--}}
{{--        <li class="nav-item">--}}
{{--          <a class="nav-link" href="{{ route('super_admin.AllDegrees') }}">--}}
{{--            <i class="nav-icon icon-puzzle"></i> All Degrees</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--          <a class="nav-link" href="{{ route('super_admin.NewDegree') }}">--}}
{{--            <i class="nav-icon icon-puzzle"></i>Add Degree</a>--}}
{{--        </li>--}}
{{--      </ul>--}}
{{--    </li>--}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('super_admin.EmailingAllUsers') }}">
        <i class="nav-icon icon-calculator"></i> Emailing
        <!-- <span class="badge badge-primary">NEW</span> -->
      </a>
    </li>
    <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon icon-cursor"></i> Companies</a>
      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.AllCompanies') }}">
            <i class="nav-icon icon-cursor"></i> All Companies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.NewCompany') }}">
            <i class="nav-icon icon-cursor"></i>Add Company</a>
        </li>
      </ul>
    </li>
    <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon icon-user"></i> Users</a>
      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.AllUsers') }}">
            <i class="nav-icon icon-user"></i> All Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.NewUser') }}">
            <i class="nav-icon icon-user"></i>Add User</a>
        </li>
      </ul>
    </li>
    <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon icon-user"></i> Surveys</a>
      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.AllSurveys') }}">
            <i class="nav-icon icon-user"></i> All Surveys</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.NewSurvey') }}">
            <i class="nav-icon icon-star"></i>Add Survey</a>
        </li>
      </ul>
    </li>
  <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon icon-bell"></i> Blog Post</a>
      <ul class="nav-dropdown-items">
          <li class="nav-item">
              <a class="nav-link" href="{{ route('super_admin.AllBlogs') }}">
                  <i class="nav-icon icon-bell"></i> All Blogs</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('super_admin.NewBlog') }}">
                  <i class="nav-icon icon-bell"></i>Add Blog</a>
          </li>
      </ul>
  </li>
    <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon icon-star"></i> Job Bord</a>
      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.AllJobBoards') }}" >
            <i class="nav-icon icon-star"></i> All Job board </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('super_admin.NewJobBoard') }}" >
            <i class="nav-icon icon-star"></i>Add Job Board</a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('super_admin.ShowDatabase') }}">
        <i class="nav-icon icon-calculator"></i> Database
        <!-- <span class="badge badge-primary">NEW</span> -->
      </a>
    </li>
    <!-- <li class="nav-item mt-auto">
      <a class="nav-link nav-link-success" href="https://coreui.io" target="_top">
        <i class="nav-icon icon-cloud-download"></i> Download CoreUI</a>
    </li>
    <li class="nav-item">
      <a class="nav-link nav-link-danger" href="https://coreui.io/pro/" target="_top">
        <i class="nav-icon icon-layers"></i> Try CoreUI
        <strong>PRO</strong>
      </a>
    </li> -->
  </ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>