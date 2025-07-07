<div class="border border-black h-screen w-full flex flex-col justify-center items-center p-4">
    <div class="flex flex-col justify-center mt-3 mb-3">
        <h1 class="text-2xl font-bold text-black">
            Crie sua conta
        </h1>
        <div>
            @if ($errors->first('google'))
                <span class="text-red-500 text-[15px] font-medium">{{ $errors->first('google') }}</span>
            @endif

            @if ($errors->first('error'))
                <div class="alert alert-danger">
                    <span class="text-red-500 text-[15px] font-medium">{{ $errors->first('error') }}</span>
                </div>
            @endif
        </div>
    </div>
    <div class="w-[800px]">
        <form method="POST" wire:submit.prevent="save" class="flex flex-col gap-2">
            @csrf
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-6">
                    <x-input
                        name="name"
                        label="Nome nome"
                        type="text"
                        required="true"
                        placeholder="Nome completo do responsável"
                        error-message="{{ $errors->first('name') }}"
                        wire:model="name"
                    />

                </div>

                <div class="col-span-12 md:col-span-6">
                    <x-input
                        name="email"
                        label="Digite o seu email"
                        type="email"
                        required="true"
                        placeholder="Nome completo do responsável"
                        error-message="{{ $errors->first('email') }}"
                        wire:model="email"
                    />
                </div>


                <div class="col-span-12 md:col-span-6">
                    <x-input
                        name="nameBusiness"
                        label="Nome do seu comercio"
                        type="text"
                        required="true"
                        placeholder="Nome do seu comercio"
                        error-message="{{ $errors->first('nameBusiness') }}"
                        wire:model="nameBusiness"
                    />
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label class="text-gray-700 text-[14px] font-medium block mb-1">
                        Nome do domínio para o seu comércio *
                    </label>
                    <div class="flex flex-row items-stretch border border-gray-300 focus-within:border-blue-link rounded overflow-hidden">
                    <input
                            type="text"
                            name="domain"
                            placeholder="ex: nomedaloja"
                            class="border-none flex-1 p-2 pl-3 outline-none focus:ring-0"
                            wire:model.defer="domain"
                            oninput="this.value = this.value.replace(/[^a-z0-9-]/g, '')">
                        <div class="flex items-center px-3 bg-gray-100 text-gray-700 text-sm whitespace-nowrap select-none">
                            .{{ config('app.base_domain', 'localhost') }}
                        </div>
                    </div>
                    @error('domain')
                        <span class="text-red-500 text-[13px] mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6">
                    <x-input
                        name="documents"
                        label="CPF/CNPJ"
                        type="text"
                        required="true"
                        placeholder="CPF/CNPJ"
                        error-message="{{ $errors->first('documents') }}"
                        wire:model.live="documents"
                        oninput="this.value = documentMask(this.value)"
                    />
                </div>

                <div class="col-span-12 md:col-span-6">
                    <x-input
                        name="cellphone"
                        label="Celular"
                        type="text"
                        required="true"
                        placeholder="Celular"
                        error-message="{{ $errors->first('cellphone') }}"
                        wire:model="cellphone"
                        x-mask="(99) 99999-9999"
                    />
                </div>

                <div class="col-span-12 md:col-span-6">
                    <x-input
                        name="password"
                        label="Digite sua senha"
                        type="password"
                        required="true"
                        placeholder="Senha para acesso"
                        error-message="{{ $errors->first('password') }}"
                        wire:model="password"
                    />
                </div>

                <div class="col-span-12 md:col-span-6">
                    <x-input
                        name="password_confirmation"
                        label="Confirme sua senha"
                        type="password"
                        required="true"
                        placeholder="Repita sua senha"
                        error-message="{{ $errors->first('passwordConfirmation') }}"
                        wire:model="passwordConfirmation"
                    />
                </div>


                <button type="submit" class="bg-blue-button w-full font-bold text-white-color rounded-[5px] py-2 transition-all duration-200 active:scale-[0.99] flex flex-row justify-center col-span-12" onclick="activeSpinner()">
                    <span id="loading-text">Criar minha conta</span>
                    <span id="loading-created" class="hidden">
                        <svg aria-hidden="true"
                             class="w-7 h-7 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor"/>
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill"/>
                        </svg>
                    </span>
                </button>
            </div>

        </form>
        <div class="flex flex-col gap-3 mt-4">
            <div class="flex flex-row justify-center text-[15px]">
                <p class="text-gray-700 font-medium ">
                    Já possuí uma conta? <span class="text-blue-link font-medium cursor-pointer hover:underline"
                                               onclick="window.location = '{{ route('login') }}'">Fazer Login</span>
                </p>
            </div>
            <div class="flex flex-row items-center w-full px-2 my-1">
                <span class="border-b border-[#747775c7] flex-grow"></span>
{{--                <p class="text-gray-700 mx-4">Ou</p>--}}
                <span class="border-b border-[#747775a9] flex-grow"></span>
            </div>

{{--            <div class="flex flex-row justify-center">--}}
{{--                <button--}}
{{--                    class="w-full flex justify-center bg-[#f6f6f6] border border-[#747775a9] rounded-[7px] px-3 py-2--}}
{{--                            text-[#1f1f1f] text-sm font-roboto cursor-pointer transition-all duration-200--}}
{{--                            hover:border-[#74777567] active:scale-[0.97]"--}}
{{--                    onclick="activeSpinnerAndRedirectRegister()">--}}
{{--                    <div class="flex items-center">--}}
{{--                        <div class="mr-2">--}}
{{--                        <span id="logo-google-register">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-[20px] h-[20px]">--}}
{{--                                <path fill="#EA4335"--}}
{{--                                      d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>--}}
{{--                                <path fill="#4285F4"--}}
{{--                                      d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>--}}
{{--                                <path fill="#FBBC05"--}}
{{--                                      d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>--}}
{{--                                <path fill="#34A853"--}}
{{--                                      d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>--}}
{{--                                <path fill="none" d="M0 0h48v48H0z"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                            <span class="hidden" id="spinner-register">--}}
{{--                            <svg class="spinner" width="20px" height="20px" viewBox="0 0 66 66"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33"--}}
{{--                                        r="30"></circle>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                        <span class="text-sm text-[#1f1f1f] flex flex-row gap-2 items-center">--}}
{{--                        Criar sua conta com o Google--}}
{{--                    </span>--}}
{{--                    </div>--}}
{{--                </button>--}}
{{--            </div>--}}
            <div class="mt-3">
                <p class="text-gray-700 font-medium text-[13.5px] text-center">
                    Ao continuar, você concorda com os <span
                        class="text-blue-link hover:underline cursor-pointer">Termos</span> e <span
                        class="text-blue-link hover:underline cursor-pointer">Política de
                    Privacidade</span>.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function activeSpinner() {
        document.getElementById('loading-text').classList.add('hidden');
        document.getElementById('loading-created').classList.remove('hidden')
    }

    function activeSpinnerAndRedirectRegister() {
        document.getElementById('logo-google-register').classList.add('hidden')
        document.getElementById('spinner-register').classList.remove('hidden');
        setTimeout(() => {
            window.location = '{{ route('google', ['business' => 'true']) }}';
        }, 1000);
    }
</script>
