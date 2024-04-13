@extends('layouts.app')

@section('content')
<!-- props não usam camel case as informações sempre chegaram no vue em caixa bvaixa,
ao invez de usar camel case para props usamos - e no vue camel case ex: numero-parcelar => numeroParcelas-->
<login-component csrf_token="{{ @csrf_token() }}"></login-component>
@endsection
