<div>
    <h2>
        {{ __('Informações do comercio') }}
    </h2>
    <form action="POST" wire:submit.prevent="saveBusiness">
        @csrf
        <div class="max-w-xl flex flex-col gap-4">
            <div class="text-black flex flex-col gap-0.5">
                <p class="text-gray-700 text-[14px] font-medium">Nome do Comercio</p>
                <input type="text" name="name" placeholder="Nome do Comercio"
                       wire:model="name"
                       class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link  @error('name') border-red-500 @enderror"
                       maxlength="20">
                @error('name')
                <span class="text-red-500 text-[13px]">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-row gap-4 w-full">
                <div class="text-black flex flex-col gap-0.5 w-full">
                    <p class="text-gray-700 text-[14px] font-medium">Tipo de Documento</p>
                    <select wire:model.live="documentType" class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full">
                        <option value="">Selecione o tipo de documento</option>
                        <option>CPF</option>
                        <option>CNPJ</option>
                    </select>
                </div>
               @if($documentType === 'CPF')
                    <div class="text-black flex flex-col gap-0.5 w-full">
                        <p class="text-gray-700 text-[14px] font-medium">CPF</p>

                        <input type="text" id="phone" wire:model="documents"
                               class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                               placeholder="CPF" x-mask="999.999.999-99"/>
                        @error('documents')
                        <span class="text-red-500 text-[13px]">{{ $message }}</span>
                        @enderror
                    </div>
                @elseif($documentType === 'CNPJ')
                    <div class="text-black flex flex-col gap-0.5 w-full">
                        <p class="text-gray-700 text-[14px] font-medium">CNPJ</p>

                        <input type="text" id="phone" wire:model="documents"
                               class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                               placeholder="CNPJ" x-mask="99.999.999/9999-99"/>
                        @error('documents')
                        <span class="text-red-500 text-[13px]">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

            </div>


            <div class="flex flex-row gap-4 w-full">
                <div class="text-black flex flex-col gap-0.5">
                    <p class="text-gray-700 text-[14px] font-medium">CEP</p>

                    <input type="text" id="phone" wire:model.blur="zipCode"
                           class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                           placeholder="99999-999" maxlength="9" x-mask="99999-999"/>
                    @error('zipCode')
                    <span class="text-red-500 text-[13px]">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-black flex flex-col gap-0.5 w-full">
                    <p class="text-gray-700 text-[14px] font-medium">Endereço</p>

                    <input type="text" id="phone" wire:model.defer="address"
                           class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                           placeholder="Endereço"/>
                    @error('address')
                    <span class="text-red-500 text-[13px]">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="flex flex-row gap-4 w-full">
                <div class="text-black flex flex-col gap-0.5 w-full">
                    <p class="text-gray-700 text-[14px] font-medium">Cidade</p>

                    <input type="text" id="phone" wire:model="city" disabled
                           class="border border-gray-300 bg-gray-200 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                           placeholder="Cidade"/>
                    @error('city')
                    <span class="text-red-500 text-[13px]">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-black flex flex-col gap-0.5 w-full">
                    <p class="text-gray-700 text-[14px] font-medium">Bairro</p>
                    <input type="text" id="phone" wire:model="neighborhood"
                           class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                           placeholder="Bairro"
                    @error('neighborhood')
                    <span class="text-red-500 text-[13px]">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="flex flex-row gap-4 w-full">
                <div class="text-black flex flex-col gap-0.5">
                    <p class="text-gray-700 text-[14px] font-medium">Número</p>

                    <input type="text" id="phone" wire:model="number"
                           class="border border-gray-300 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                           placeholder="1234"/>
                    @error('number')
                    <span class="text-red-500 text-[13px]">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-black flex flex-col gap-0.5 ">
                    <p class="text-gray-700 text-[14px] font-medium">Estado</p>

                    <input type="text" id="phone" wire:model="state"
                           class="border border-gray-300 bg-gray-200 outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 w-full"
                           placeholder="Estado" disabled/>
                    @error('state')
                    <span class="text-red-500 text-[13px]">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="mt-4 flex flex-row gap-5 items-center">
            <button type="submit" class="bg-blue-black text-white px-4 py-1 rounded-lg active:scale-[0.99]]">Salvar</button>
            <div x-data="{ shown: false, timeout: null }"
                 x-init="@this.on('successUpdateBusiness', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                 x-show.transition.out.opacity.duration.1500ms="shown"
                 x-transition:leave.opacity.duration.1500ms
                 style="display: none;" class="text-sm text-green-600">
                <h1>Salvo com sucesso</h1>
            </div>
        </div>
    </form>
</div>
