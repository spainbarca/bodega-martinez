<div>
    @php

    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 container py-8">

        <div class="order-2 lg:order-1 xl:col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span> Orden-{{$order->id}}</p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg font-semibold uppercase">Envío</p>

                        @if ($order->envio_type == 1)
                            <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                            <p class="text-sm">Bodega Martinez</p>
                        @else
                            <p class="text-sm">Los productos Serán enviados a:</p>
                            <p class="text-sm">{{ $envio->address }}</p>
                            <p>{{ $envio->department }} - {{ $envio->city }} - {{ $envio->district }}
                            </p>
                        @endif


                    </div>

                    <div>
                        <p class="text-lg font-semibold uppercase">Datos de contacto</p>

                        <p class="text-sm">Persona que recibirá el producto: {{ $order->contact }}</p>
                        <p class="text-sm">Teléfono de contacto: {{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                <p class="text-xl font-semibold mb-4">Resumen</p>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio</th>
                            <th>Cant</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                            alt="">
                                        <article>
                                            <h1 class="font-bold">{{ $item->name }}</h1>
                                            <div class="flex text-xs">

                                                @isset($item->options->color)
                                                    Color: {{ __($item->options->color) }}
                                                @endisset

                                                @isset($item->options->size)
                                                    - {{ $item->options->size }}
                                                @endisset
                                            </div>
                                        </article>
                                    </div>
                                </td>

                                <td class="text-center">
                                    S/. {{ $item->price }}
                                </td>

                                <td class="text-center text-blue-700 font-bold">
                                    {{ $item->qty }}
                                </td>

                                <td class="text-center">
                                    S/. {{ $item->price * $item->qty }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="order-1 lg:order-2 xl:col-span-2">
            <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                <div class="flex justify-between items-center mb-4">
                    <img class="h-8" src="{{ asset('img/MC_VI_DI_2-1.jpg') }}" alt="">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: S/. {{ $order->total - $order->shipping_cost }}
                        </p>
                        <p class="text-sm font-semibold">
                            Envío: S/. {{ $order->shipping_cost }}
                        </p>
                        <p class="text-lg font-semibold uppercase">
                            Total: S/. {{ $order->total }}
                        </p>

                        <div class="cho-container">

                        </div>
                    </div>
                </div>

                <div id="paypal-button-container"></div>
            </div>


            <div class="bg-white rounded-lg shadow-lg px-6 my-6 py-2">
                <div class="flex justify-between items-center mb-4">
                    <img class="h-16" src="{{ asset('img/mp_banner3.png') }}" alt="">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: S/. {{ $order->total - $order->shipping_cost }}
                        </p>
                        <p class="text-sm font-semibold">
                            Envío: S/. {{ $order->shipping_cost }}
                        </p>
                        <p class="text-lg font-semibold uppercase">
                            Total: S/. {{ $order->total }}
                        </p>
                    </div>
                    <div class="cho-container2">

                    </div>
                </div>

            </div>

            <div class="bg-white rounded-lg shadow-lg px-6 my-3 py-1">
                <div class="flex justify-between items-center mb-2">
                    <img class="h-14" src="{{ asset('img/efectivo.png') }}" alt="">
                    <div class="text-gray-700">
                        <p class="text-sm font-bold">Pago en tienda</p>
                        <p class="text-lg font-semibold uppercase">
                            Total: S/. {{ $order->total }}
                        </p>
                    </div>
                    <button wire:click="$emit('payOrder')" class="bg-green-300 hover:bg-green-600 text-green-900 font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span>Efectivo</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    @push('script')

        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}">
            // Replace YOUR_CLIENT_ID with your sandbox client ID

        </script>

        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: "{{ $order->total }}"
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {

                        Livewire.emit('payOrder');

                        /* console.log(details);

                        alert('Transaction completed by ' + details.payer.name.given_name); */
                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page

        </script>


    @endpush

</div>
