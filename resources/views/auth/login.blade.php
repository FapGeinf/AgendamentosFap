<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="row">

      <!-- Left Blank Side -->
      <div class="col-lg-6"></div>
  
      <!-- Right Side Form -->
      <div class="col-lg-6 d-flex align-items-center justify-content-center right-side form-box">
        <div class="form-2-wrapper">
          <div class="logo text-center mb-4">
            <img src="{{ asset('/img/logo/logo-alone.png') }}" alt="">
          </div>

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 form-box">
              <label for="email">CPF:</label>
              <input type="email" class="form-control" id="email" name="email" :value="old('email')" placeholder="000.000.000-00" required autocomplete="username">

              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <div class="mb-3">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Mínimo de 8 caracteres" required autocomplete="current-password">

              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-0">
              <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded" name="remember">
                <span class="ml-1 text-sm">Lembrar de mim</span>
              </label>
            </div>

            <button type="submit" class="login-btn w-50 mt-4 mb-3">Entrar</button>
          </form>
  
          <!-- Register Link -->
          <div class="text-start register-link mt-4">
            <a href="{{ route('password.request') }}" class="">Esqueceu a senha?</a>
            <p class="mt-1">Primeira vez usando o Agendaí? <a href="{{ route('register') }}" class="">Cadastre-se</a></p>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</body>
</html>