@extends('layouts.main')

@section('title', $ref)
@section('header-left')
    <img src="img/FACTURA.jpg" alt='logo'"/>

@endsection
@section('header-right')
    <h3>DATOS DE ENVÍO</h3>
<ul class="list-group">
    <li class="list-group-item">{{ $customer['name'] }}  {{ $customer['surname'] }}</li>
    <li class="list-group-item">{{ $customer['address'] }} </li>
    <li class="list-group-item">{{ $customer['city'] }} {{ $customer['zip'] }}</li>
    <li class="list-group-item">{{ $customer['state'] }} </li>
    <li class="list-group-item">{{ $customer['country'] }} </li>
    <li class="list-group-item">Fijo: {{ $customer['telf'] }}, Móvil:{{ $customer['movil'] }} </li>
    <li class="list-group-item">{{ $customer['modo'] }} </li>
    <li class="list-group-item">{{ $customer['email'] }} </li>

</ul>

@endsection

@section('content')
    <?php $total = 0; ?>
    <div class="table-responsive">
        <table class="table-bordered" width="100%">
            <tr><th>Ref</th><th>Nombre</th><th>Unidades</th><th>Precio</th><th>Importe</th></tr>
            @foreach ($data as $prod)
                <?php // var_dump($prod); exit ?>
                <?php $total += $prod['prodPrice'] * $prod['amount']; ?>
                <tr><td>{{ $prod['prodRef'] }}</td><td>{{ $prod['proName'] }}</td><td>{{ $prod['amount'] }}</td>
                    <td>{{ $prod['prodPrice'] }}</td><td>{{  $prod['prodPrice'] * $prod['amount'] }}</td></tr>
            @endforeach
            <tr><td colspan="6" style="text-align: right">Total: <?php echo $total; ?></td></tr>
            <tr>
                <td colspan="6" style="text-align: right">
                    IVA aplicado 21%: <?php
                    $totalIva = $total - ($total / 1.21);
                    print round($totalIva * 100) / 100;
                    ?>
                </td>
            </tr>

        </table>

    </div>
@endsection