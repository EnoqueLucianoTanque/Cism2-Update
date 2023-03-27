@component('mail::message')
# {{$mailData['title']}}

{{$mailData['body']}}
<br>

<a href="{{$mailData['url']}}" target="_blank" class="primary" rel="noopener noreferrer">click here </a> to access our platform.
 <br>

<p>Best regards.</p><br>
<small>Centro de Investigação em Saúde da Manhiça - CISM</small>
@endcomponent
