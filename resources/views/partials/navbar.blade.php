<nav class="navbar navbar-expand-sm navbar-dark " style="background: #053946">
    <div class="container">
      <a class="navbar-brand" href="/"><img src="/img/IPB.png"  height="52.34"  alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> 
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link  {{ ($active === 'beranda')? 'active':''}}"  href="/">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link   {{ ($active === 'organisasi')? 'active':''}}" href="/organisasi">Organisasi</a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link  {{ ($active === 'konfirmasi')? 'active':''}}" href="/konfirmasi">Konfirmasi</a>
          </li>
          @endauth 
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" maxlength="2">
              <i class="bi bi-person-fill"></i> <?php $name = auth()->user()->name; $name=explode(' ',$name,3); ?>
              @if (str_word_count(auth()->user()->name)>1)
              {{ $name[0] . ' ' . $name[1]  }}
              @else
              {{ $name[0] }}
              @endif
               
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>

              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout <i class="bi bi-box-arrow-right">
                  </i></button>
                </form>
              </li>
            </ul>
          </li>
          @else    
          <li class="nav-item">
            <a href="/login" class="nav-link {{ ($active === 'login')? 'active':''}}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
          @endauth
         
        </ul>
      </div>
    </div>
  </nav>
