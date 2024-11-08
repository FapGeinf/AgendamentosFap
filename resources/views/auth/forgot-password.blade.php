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

      <div class="col-lg-6"></div>

      <div class="col-lg-6 d-flex align-items-center justify-content-center right-side form-box">
        <div class="form-2-wrapper">
          <div class="logo text-center mb-4">
            <img src="{{ asset('/img/logo/logo-alone.png') }}" alt="">
          </div>

          <span>Insira seu email para receber um link de redefinição da sua senha</span>

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="meuemail@email.com" :value="old('email')" required>

              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button type="submit" class="login-btn w-50 mt-4 mb-3">Enviar Link</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

    {{-- <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div> --}}
