<x-app-layout>

    <div class="container py-12">

        <section class="grid grid-cols-5 gap-6 text-white">
            <a href="{{ route('orders.index') . "?status=1" }}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$pendiente}}
                </p>
                <p class="uppercase text-center">Pendiente</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-business-time"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=2" }}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$recibido}}
                </p>
                <p class="uppercase text-center">Recibido</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=3" }}" class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$fiado}}
                </p>
                <p class="uppercase text-center">Fiado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=4" }}" class="bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$entregado}}
                </p>
                <p class="uppercase text-center">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=5" }}" class="bg-pink-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$anulado}}
                </p>
                <p class="uppercase text-center">Anulado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        @if ($orders->count())

            <section class="bg-white shadow-lg rounded-lg px-5 py-5 mt-8 text-gray-700">
                <div class="w-full my-2">
                    <div class="flex justify-between pb-2">
                        <button type="button" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-1 px-4 border border-gray-400 rounded shadow text-3xl disabled:opacity-80" disabled>Pedidos recientes</button>
                        <a href="{{ route('orders.indexall')}}">
                            <button type="button" class="group inline-flex items-center py-2 px-4 bg-orange-400 text-white font-bold rounded-lg shadow-md focus:bg-orange-600 focus:outline-none text-xl">
                                <svg fill="currentColor" viewBox="0 0 20 20" class="-ml-1 mr-3 w-5 h-5 text-white group-focus:text-amber-300"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                                Ver todos los pedidos
                            </button>
                        </a>
                    </div>

                    <ul>
                        @foreach ($orders as $order)
                            <li>
                                <a href="{{route('orders.show', $order)}}" class="flex items-center py-2 px-4 hover:bg-gray-100">
                                <span class="w-12 text-center">
                                    @switch($order->status)
                                        @case(1)
                                        <i class="fas fa-business-time text-red-500 opacity-50"></i>
                                        @break
                                        @case(2)
                                        <i class="fas fa-credit-card text-gray-500 opacity-50"></i>
                                        @break
                                        @case(3)
                                        <i class="fas fa-truck text-yellow-500 opacity-50"></i>
                                        @break
                                        @case(4)
                                        <i class="fas fa-check-circle text-green-500 opacity-50"></i>
                                        @break
                                        @case(5)
                                        <i class="fas fa-times-circle text-pink-500 opacity-50"></i>
                                        @break
                                        @default

                                    @endswitch
                                </span>

                                    <span>
                                    Orden: {{$order->id}}  -  <b><code style="color: #0066cc">({{ $order->contact }})</code></b>
                                    <br>
                                    <strong>{{ Illuminate\Support\Carbon::parse($order->created_at)->format('F j, Y, g:i a') }}</strong>  --> <b><code style="color: #ff5454">{{'Hace '.str_replace('después','', Illuminate\Support\Carbon::now()->diffForHumans($order->created_at))}}</code></b>
                                </span>


                                    <div class="ml-auto">
                                    <span class="font-bold
                                        @switch($order->status)
                                    @case(1)
                                        text-red-700">
                                            Pendiente

                                            @break
                                        @case(2)
                                             text-gray-700">
                                            Recibido

                                            @break
                                        @case(3)
                                            text-yellow-600">
                                            Fiado

                                            @break
                                        @case(4)
                                            text-green-700">
                                            Entregado

                                            @break
                                        @case(5)
                                            text-pink-700">
                                            Anulado

                                            @break
                                        @default

                                        @endswitch
                                    </span>

                                        <br>

                                        S/. {{$order->total}}
                                        </span>
                                    </div>

                                    <span>
                                    <i class="fas fa-angle-right ml-6"></i>
                                </span>

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6">
                    {{-- $orders->links() --}}
                </div>
            </section>

        @else
            <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <span class="font-bold text-lg">
                    No existe registros de ordenes
                </span>
            </div>
        @endif
    </div>



</x-app-layout>
