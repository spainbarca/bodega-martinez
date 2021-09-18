<x-admin-layout>

    <div class="container py-6">

        <div class="rounded-t-xl overflow-hidden bg-gradient-to-r from-yellow-50 to-yellow-100 p-10">
            <div class="text-center text-5xl font-bold leading-none tracking-tight">
                <span class="decoration-clone bg-clip-text text-transparent bg-gradient-to-b from-yellow-400 to-red-500">
                  Listado Histórico de Pedidos
                </span>
            </div>
        </div>

        @if ($orders->count())

            <section class="bg-white shadow-lg rounded-lg px-5 py-5 mt-8 text-gray-700">
                <div class="w-full my-2">
                    <div class="flex justify-between pb-2">
                        <button type="button" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-1 px-4 border border-gray-400 rounded shadow text-3xl disabled:opacity-80" disabled>Todos los pedidos</button>
                        <a href="{{ route('admin.orders.index')}}">
                            <button type="button" class="group inline-flex items-center py-2 px-4 bg-orange-400 text-white font-bold rounded-lg shadow-md focus:bg-orange-600 focus:outline-none text-xl">
                                <svg fill="currentColor" viewBox="0 0 20 20" class="-ml-1 mr-3 w-5 h-5 text-white group-focus:text-amber-300"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                                Pedidos recientes
                            </button>
                        </a>

                    </div>

                    <ul>
                        @foreach ($orders as $order)
                            <li>
                                <a href="{{route('admin.orders.show', $order)}}" class="flex items-center py-2 px-4 hover:bg-gray-100">
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
                                    <strong>{{ Illuminate\Support\Carbon::parse($order->created_at)->format('F j, Y, g:i a') }}</strong>  ----> <b><code style="color: #ff5454">{{'Hace '.str_replace('después','', Illuminate\Support\Carbon::now()->diffForHumans($order->created_at))}}</code></b>
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
                    {{ $orders->links() }}
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

</x-admin-layout>
