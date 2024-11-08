<!DOCTYPE html>
<html lang="pt-BR">
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
        <div class="form-3-wrapper">
          <div class="logo text-center mb-4">
            <img src="{{ asset('/img/logo/logo-alone.png') }}" alt="">
          </div>

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3 form-box">
              <label for="name">Nome Completo:</label>
              <input type="text" id="name" name="name" class="form-control" :value="old('name')" placeholder="Julliany Souza" required autocomplete="name">

              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-2">
              <label for="email">Seu Email:</label>
              <input type="email" id="email" name="email" class="form-control" :value="old('email')" placeholder="meuemail@email.com" required autocomplete="username">
  
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
  
            <!-- Password -->
            <div class="mt-2">
              <label for="password">Senha:</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Mínimo de 8 caracteres" required autocomplete="new-password">
  
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
  
            <!-- Confirm Password -->
            <div class="mt-2">
              <label for="password_confirmation">Repita a Senha:</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
  
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="mt-5">
              <button class="login-btn w-50 mt-4 mb-3" type="submit">Criar Conta</button>
            </div>

            <div class="text-start mt-5">
              <a href="{{ route('password.request') }}" class="">Esqueceu a senha?</a>
              <p class="mt-1">Já possui cadastro? <a href="{{ route('login') }}">Fazer login</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</body>

{{-- <body>
  <div class="container justify-content-center align-items-center">
    <div class="row justify-content-center">
      <div class="form-2-wrapper">
        <!-- <div class="logo text-center mb-4">
          <img src="{{ asset('/img/logo/logo-alone.png') }}" alt="">
        </div> -->

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <!-- Name -->
          <div>
            <label for="name">Nome Completo:</label>
            <input type="text" id="name" name="name" class="form-control" :value="old('name')" required autocomplete="name">

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>

          <!-- Email -->
          <div class="mt-2">
            <label for="email">Seu Email:</label>
            <input type="email" id="email" name="email" class="form-control" :value="old('email')" required autocomplete="username">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div class="mt-2">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <!-- Confirm Password -->
          <div class="mt-2">
            <label for="password_confirmation">Repita a Senha:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>

          <!-- Submit -->
          <div class="mt-5 centralize">
            <button type="submit">Criar Conta</button>
          </div>

          
          <div class="text-start mt-3">
            <p class="mt-5">Já possui cadastro? <a href="{{ route('register') }}">Fazer login</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</body> --}}

</html>


