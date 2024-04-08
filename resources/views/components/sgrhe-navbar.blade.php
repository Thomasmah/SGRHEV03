<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" id="pushmenu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!--Configuara o Midle nav links-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <form method="POST" action="{{ route('logout') }}" x-data>
      @csrf
      <button class="btn btn-danger" href="{{ route('logout') }}"
         @click.prevent="$root.submit();">
            Sair / Logout
      </button>
    </form>
    </ul>
  </nav>