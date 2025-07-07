<div id="login-form" class=" w-[550px] p-4 flex flex-col">
    <div class="flex flex-col justify-center mt-5 mb-5">
        <h1 class="text-2xl font-bold text-black">
            Entre na sua conta
        </h1>
        <div>
            @if ($errors->has('google'))
                <span class="text-red-500 text-[15px] font-medium">{{ $errors->first('google') }}</span>
            @endif
            @if ($errors->has('error'))
                <div class="alert alert-danger">
                    <span class="text-red-500 text-[15px] font-medium">{{ $errors->first('error') }}</span>
                </div>
            @endif
            @if (session('success'))
                <span class="text-green-700 text-[13px] mt-2"> {{ session('success') }}</span>
            @endif
        </div>
    </div>
    <form method="POST" wire:submit.prevent="submit" class="flex flex-col gap-2">
        @csrf
        <div class="flex flex-col gap-4">
            <div class="text-black flex flex-col gap-0.5">
                <p class="text-gray-700 text-[15px] font-medium">Seu e-mail</p>
                <input type="email" name="email" placeholder="Digite o seu email" wire:model.defer="formData.email"
                       wire:change="handleChange('formData.email')"
                       class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500">
                @error('formData.email')
                <span class="text-red-500 text-[13px]">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-black flex flex-col gap-0.5">
                <p class="text-gray-700 text-[15px] font-medium">Senha</p>
                <input type="password" name="password" placeholder="Digite a sua senha"
                       wire:model.defer="formData.password" wire:change="handleChange('formData.password')"
                       class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500">
                @error('formData.password')
                <span class="text-red-500 text-[13px]">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex flex-row justify-between pl-0.5 pr-0.5 my-4">
            <div class="">
                <label for="remember"
                       class="flex flex-row items-center gap-2 cursor-pointer text-[14px] text-gray-700 font-medium">
                    <input type="checkbox" name="remember" id="remember" class="cursor-pointer"
                           wire:model="formData.remember">
                    Manter conectado
                </label>
            </div>
            <div>
                <a href="{{ route('forgot-password') }}" class="font-medium text-blue-link text-[15px] hover:underline">Esqueceu a senha ?</a>
            </div>
        </div>

        <button type="submit"
                class="bg-blue-button w-full font-bold text-white-color rounded-[5px] py-2 transition-all duration-200
                    active:scale-[0.99]">Entrar
        </button>
    </form>

    <div class="flex flex-col gap-3 mt-5">
        <div class="flex flex-row justify-center text-[15px]">
            <p class="text-gray-700 font-medium ">
                Ainda não possuí uma conta? <span class="text-blue-link font-medium cursor-pointer hover:underline"
                                                  onclick="window.location = '{{ route('register') }}';">Cadastre-se</span>
            </p>
        </div>
        <div class="flex flex-row items-center w-full px-2 my-3">
            <span class="border-b border-[#747775c7] flex-grow"></span>
            <p class="text-gray-700 mx-4">Ou</p>
            <span class="border-b border-[#747775a9] flex-grow"></span>
        </div>

        <div class="flex flex-row justify-center">
            <button
                class="w-full flex justify-center bg-[#f6f6f6] border border-[#747775a9] rounded-[7px] px-3 py-2 text-[#1f1f1f] text-sm font-roboto cursor-pointer transition-all duration-200 hover:border-[#74777567] active:scale-[0.97]"
                onclick="activeSpinnerAndRedirectLogin()">
                <div class="flex items-center">
                    <div class="mr-2">
                        <span id="logo-google">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-[20px] h-[20px]">
                                <path fill="#EA4335"
                                      d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4"
                                      d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                                <path fill="#FBBC05"
                                      d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                                <path fill="#34A853"
                                      d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                                <path fill="none" d="M0 0h48v48H0z"/>
                            </svg>
                        </span>
                        <span class="hidden" id="spinner-login">
                           <svg class="spinner" width="20px" height="20px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                           </svg>
                        </span>
                    </div>
                    <span class="text-sm text-[#1f1f1f] flex flex-row gap-2 items-center">
                        Entre com sua conta google
                    </span>
                </div>
            </button>
        </div>
        <div class="mt-3">
            <p class="text-gray-700 font-medium text-[13.5px] text-center">
                Utilizamos cookies para melhorar sua experiência em nossos serviços. Ao realizar seu login, consideramos
                que você aceita esta utilização. Para mais informações, acesse nossa <span
                    class="text-blue-link hover:underline cursor-pointer">Política de Privacidade</span>.
            </p>
        </div>
    </div>
</div>

<script>
    function activeSpinnerAndRedirectLogin() {
        document.getElementById('logo-google').classList.add('hidden')
        document.getElementById('spinner-login').classList.remove('hidden');
        setTimeout(() => {
            window.location = '{{ route('google', ['business' => 'true']) }}';
        }, 1000);
    }
</script>
