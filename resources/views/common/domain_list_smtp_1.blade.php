@php
    isset($from_email_part2) ? '@'.$from_email_part2 : '';
    $order = array("http://", "https://", "www", "http://www", "https://www");
    $replace = '';
    $subdomain = str_replace($order, $replace, $domain->domain);
@endphp

@if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
<option {{isset($owner_email_part2) && $owner_email_part2==$subdomain ? 'selected' :'' }} value="{{ '@' . $subdomain }}">{{ $subdomain }}</option>
@else 
    @php 
       $disableTxt = "inactive";
                    if($domain->domain_status == 3) $disableTxt = "authentication failed";
                    if($domain->domain_status == 4) $disableTxt = "pending authentication";
    
    @endphp
        <option disabled @if(!empty($from_email_part2) and $from_email_part2 == $domain->domain) selected @endif value="{{ '@' . $subdomain }}">{{ $subdomain }} <small>({{$disableTxt}}) </small></option>
@endif
