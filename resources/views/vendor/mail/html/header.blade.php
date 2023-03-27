<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('assets/img/logo1.png')}}" class="logo" alt="CISM">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
