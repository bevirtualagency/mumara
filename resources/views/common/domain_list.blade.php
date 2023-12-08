@if($domain->domain_status == 1 || $unauth_sending_domain != 'on')
<option value="{{ $domain->id }}" >{{ $domain->domain }}  </option>
@else 
    @php 
        $disableTxt = "inactive";
        if($domain->domain_status == 3) $disableTxt = "authentication failed";
        if($domain->domain_status == 4) $disableTxt = "pending authentication";
       
    @endphp
    <option disabled value="{{ $domain->id }}" >{{ $domain->domain }}  <small>({{$disableTxt}}) </small></option>
@endif