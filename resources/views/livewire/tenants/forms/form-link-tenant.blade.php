<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <form method="POST" wire:submit.prevent="save" class="flex flex-col gap-2" >
        @csrf
        <div class="grid grid-cols-12 gap-4 overflow-y-auto">
            <div class="col-span-12">
                <div x-data="{ imagePreview: null }" class="flex flex-col items-start gap-4">
                    <input
                        id="file_input"
                        type="file"
                        accept="image/*"
                        wire:model="logoFile"
                        @change="const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => imagePreview = e.target.result;
                                    reader.readAsDataURL(file);
                                }"
                        class="block w-full text-sm text-gray-900 p-2 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    />

                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Preview da Imagem" class="rounded shadow max-w-[200px] max-h-[200px] border mt-2"/>
                    </template>
                    @error('logoFile')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="col-span-12">
                <x-input
                    name="titleTenant"
                    label="Titulo principal"
                    type="text"
                    required="true"
                    placeholder="Titulo"
                    error-message="{{ $errors->first('titleTenant') }}"
                    wire:model="titleTenant"
                    maxlength="40"
                />
            </div>

            <div class="col-span-12">
                <x-input
                    name="since"
                    label="Atual desde que ano ?"
                    type="date"
                    required="true"
                    placeholder="Desde de algum ano ?"
                    error-message="{{ $errors->first('since') }}"
                    wire:model="since"
                />
            </div>

            <div class="col-span-12">
                <div x-data="{ description: @entangle('description') }" class="text-black flex flex-col gap-0.5">
                    <p class="text-gray-700 text-[14px] font-medium">Descrição *</p>

                    <textarea
                        x-model="description"
                        name="description"
                        cols="20"
                        rows="3"
                        maxlength="150"
                         @class([
                        'w-full border text-sm outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500 resize-none',
                            'border-gray-300' => !$errors->first('description'),
                            'border-red-300' => $errors->first('description'),
                        ])
                    ></textarea>

                    @error('description')
                    <span class="text-red-500 text-[13px]">{{ $message }}</span>
                    @enderror

                    <small>Caracteres <span x-text="description ? description.length : 0"></span> / 150</small>

                </div>
            </div>

            <div class="col-span-12 md:col-span-4">
                <x-input
                    name="zip_code"
                    label="Digite o CEP"
                    type="text"
                    required="true"
                    mask="CEP"
                    placeholder="Digite o CEP"
                    error-message="{{ $errors->first('address.zip_code') }}"
                    wire:model.blur="address.zip_code"
                />
            </div>

            <div class="col-span-12 md:col-span-8">
                <x-input
                    name="street"
                    label="Digite o Rua/Avenida"
                    type="text"
                    required="true"
                    placeholder="Digite o Rua/Avenida"
                    error-message="{{ $errors->first('address.street') }}"
                    wire:model.blur="address.street"
                />
            </div>

            <div class="col-span-12 md:col-span-8">
                <x-input
                    name="neighborhood"
                    label="Bairro"
                    type="text"
                    required="true"
                    placeholder="Bairro"
                    error-message="{{ $errors->first('address.neighborhood') }}"
                    wire:model.blur="address.neighborhood"
                />
            </div>

            <div class="col-span-12 md:col-span-4">
                <x-input
                    name="neighborhood"
                    label="Digite o Complemento"
                    type="text"
                    required="true"
                    placeholder="Digite o Complemento"
                    error-message="{{ $errors->first('address.complement') }}"
                    wire:model.blur="address.complement"
                />
            </div>

            <div class="col-span-12 md:col-span-2">
                <x-input
                    name="number"
                    label="Número"
                    type="text"
                    required="true"
                    placeholder="Número"
                    error-message="{{ $errors->first('address.number') }}"
                    wire:model.blur="address.number"
                />
            </div>

            <div class="col-span-12 md:col-span-8">
                <x-input
                    name="number"
                    label="Cidade"
                    type="text"
                    required="true"
                    placeholder="Cidade"
                    error-message="{{ $errors->first('address.city') }}"
                    wire:model.blur="address.city"
                    :disable-input="$address['city']"
                />
            </div>

            <div class="col-span-12 md:col-span-2">
                <x-input
                    name="uf"
                    label="Estado"
                    type="text"
                    required="true"
                    placeholder="Digite o Estado"
                    error-message="{{ $errors->first('address.uf') }}"
                    wire:model.blur="address.uf"
                    maxlength="2"
                    :disable-input="$address['uf']"
                />
            </div>

                {{-- WhatsApp --}}
                <div class="col-span-12 md:col-span-4">
                    <x-input
                        name="whatsapp"
                        label="WhatsApp"
                        type="tel"
                        placeholder="Digite o número com DDD"
                        error-message="{{ $errors->first('whatsapp') }}"
                        wire:model.blur="whatsapp"
                        maxlength="15" x-mask:dynamic="maskPhone"
                    />
                </div>

                {{-- Instagram --}}
                <div class="col-span-12 md:col-span-4">
                    <x-input
                        name="instagram"
                        label="Instagram"
                        type="url"
                        placeholder="https://instagram.com/..."
                        error-message="{{ $errors->first('instagram') }}"
                        wire:model.blur="instagram"
                    />
                </div>

                {{-- Facebook --}}
                <div class="col-span-12 md:col-span-4">
                    <x-input
                        name="facebook"
                        label="Facebook"
                        type="url"
                        placeholder="https://facebook.com/..."
                        error-message="{{ $errors->first('facebook') }}"
                        wire:model.blur="facebook"
                    />
                </div>

                {{-- YouTube --}}
                <div class="col-span-12 md:col-span-4">
                    <x-input
                        name="youtube"
                        label="YouTube"
                        type="url"
                        placeholder="https://youtube.com/..."
                        error-message="{{ $errors->first('youtube') }}"
                        wire:model.blur="youtube"
                    />
                </div>

                {{-- TikTok --}}
                <div class="col-span-12 md:col-span-4">
                    <x-input
                        name="tiktok"
                        label="TikTok"
                        type="url"
                        placeholder="https://tiktok.com/@..."
                        error-message="{{ $errors->first('tiktok') }}"
                        wire:model.blur="tiktok"
                    />
                </div>



            <div class="col-span-12 space-y-4">
                <h3 class="text-sm font-semibold mb-2">Horário de Atendimento</h3>

                @foreach ($days as $day => $enabled)
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gray-50 p-2 rounded shadow-sm">
                        <div class="flex items-center gap-2 w-full md:w-1/4">
                            <input
                                type="checkbox"
                                wire:model.live="days.{{ $day }}"
                                id="{{ $day }}"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                            >
                            <label for="{{ $day }}" class="text-sm font-medium capitalize select-none">{{ $day }}</label>
                        </div>

                        @if ($days[$day])
                            <div class="flex flex-col sm:flex-row gap-4 w-full">
                                <div class="w-full">
                                    <x-input
                                        name="hours[{{ $day }}][start]"
                                        label="Início"
                                        type="time"
                                        required="true"
                                        wire:model.defer="hours.{{ $day }}.start"
                                        error-message="{{ $errors->first('hours.' . $day . '.start') }}"
                                    />
                                </div>

                                <div class="w-full">
                                    <x-input
                                        name="hours[{{ $day }}][end]"
                                        label="Fim"
                                        type="time"
                                        required="true"
                                        wire:model.defer="hours.{{ $day }}.end"
                                        error-message="{{ $errors->first('hours.' . $day . '.end') }}"
                                    />
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @error('form')
                <span class="col-span-12 text-red-500 text-[13px] my-1 block">{{ $message }}</span>
            @enderror

            <button wire:loading.attr="disabled" type="submit"
                    class="relative bg-blue-button w-full font-bold text-white-color rounded-[5px] py-2 transition-all duration-200 active:scale-[0.99] flex flex-row justify-center col-span-12">
                <span>Salvar</span>
                <div wire:loading wire:target="save" class="absolute top-0 left-0 w-full h-full z-10">
                    <div class="w-full h-full rounded-md flex items-center justify-center bg-white/60">
                        <x-heroicon-s-arrow-path class="text-blue-link w-5 h-5 animate-spin"/>
                    </div>
                </div>
            </button>
        </div>
    </form>
</div>
