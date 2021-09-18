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
                                            Fiadoooo

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

<div class="mt-6">
    {{ $orders->links() }}
</div>
