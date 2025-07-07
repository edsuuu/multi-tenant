<div>
    <div class="bg-blue-black h-screen flex flex-row justify-around items-center " id="content">
        <div class="flex flex-col w-[600px] text-white mb-[5rem] gap-10 items-center">
            <h1 class="font-bold text-5xl">
                Sistema de Agendamento Completo
            </h1>
            <p class="text-[17px]">
                Tenha o controle de todo seu negocio direto do seu celular ou computador,
                com poucos cliques seus clientes estaram agendados.
            </p>

            <a href="{{ route('register') }}" class="py-[8px] px-[25px] bg-blue-white rounded-[6px] font-medium active:scale-[0.97]">
                Teste Gratuitamente
            </a>
        </div>


        <div>
            <img src="{{ asset('images/cell.png') }}" alt="cell">
        </div>
    </div>

    {{--  Cards de informações  --}}

    <div class="h-2/3 flex flex-row ">
        <div class="border border-black w-full flex flex-row gap-6 justify-center
		items-center">
            <div class="flex flex-col gap-6 mt-6">
                <div class="w-48 h-48 border border-black rounded-2xl p-4">
                    Card1
                </div>
                <div class="w-48 h-48 border border-black rounded-2xl p-4">
                    Card2
                </div>
            </div>
            <div class="flex flex-col gap-6">
                <div class="w-48 h-48 border border-black rounded-2xl p-4">
                    Card3
                </div>
                <div class="w-48 h-48 border border-black rounded-2xl p-4">
                    Card4
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col justify-center items-center ">
            <div class="w-[500px] flex flex-col gap-5 items-center">
                <h1 class="font-bold text-5xl">
                    Você no controle com poucos cliques
                </h1>
                <p class="text-[17px]">
                    Invista em um ambiente personalizado para seu negócio.
                </p>

                <button
                    class="py-[8px] px-[25px] bg-blue-white rounded-[6px] font-medium active:scale-[0.97] text-white">
                    Veja mais...
                </button>
            </div>
        </div>
    </div>

    {{--    mais uma section --}}

{{--    <div class="h-2/3 bg-blue-black">--}}
{{--        <h1 class="text-white">mais uma section</h1>--}}
{{--    </div>--}}

    {{--    Planos --}}
    <div class="border bg-white-opaco h-4/5">
        <div class="w-full max-w-[1440px] mx-auto">
            <div class="flex flex-row justify-center">
                <h1 class="text-2xl font-medium">Nossos planos</h1>
            </div>

            <div class="border m-auto w-full">
                <div class="border border-black flex flex-row justify-center items-center gap-4">
                    <div class="border border-black rounded-[20px] p-1">
                        <button>Mensal</button>
                        <button>Semestral</button>
                    </div>
                </div>

                <div class="flex flex-row gap-5 justify-center">
                    @foreach($plans as $plan)
                        <div class="border border-gray-300 rounded-[10px] bg-white p-4 flex flex-col gap-4 w-[350px]">
                            <div class="text-center">
                                <h1 class="font-bold text-3xl">{{ $plan->name }}</h1>
                            </div>
                            <div class="text-center">
                                <p>Saia do caderninho ou planilha e venha para o novo mundo digital</p>
                            </div>
                            <div class="flex flex-col gap-2 ">
								<span class="flex flex-row gap-2 px-3">
									<p>R$</p>
									<span class="flex flex-row">
										<p class="font-bold text-4xl">32</p>
										<p>,99</p>
									</span>
								</span>
                                <small class="text-gray-text text-center">R$ 1999,00 ao ano em até 12x no cartão</small>
                            </div>

                            <ul>
                                <li>Beneficio 1</li>
                                <li>Beneficio 2</li>
                                <li>Beneficio 3</li>
                                <li>Beneficio 4</li>
                            </ul>

                            <div
                                class="bg-[#f6f9ff] text-blue-link flex flex-row gap-3 justify-between items-center p-2.5 rounded-[6px]">
                                <div>
                                    <img src=" {{ asset('images/card-icon.svg') }}" alt="card" class="w-9">
                                </div>
                                <p class="text-[12px]">Teste grátis por 15 dias sem cadastro de cartão de credito
                                    antecipado.</p>
                            </div>

                            <button class="border border-blue-hovers text-blue-hovers font-medium py-2 rounded-2xl
							hover:bg-blue-hovers hover:text-white transition-all duration-300 ease-in-out">Começar
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <footer class="h-2/3 bg-blue-black">
        <h1>Footer</h1>
    </footer>
</div>
