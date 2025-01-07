@foreach($conteudo as $i)
<p style="text-align:{{$alinhamento}}; padding-top:{{$msup}}px; padding-bottom:{{$minf}}px; margin-left:{{$mesq}}px; margin-right:{{$mdir}}px;">
    {!! $i !!}
</p>
@endforeach