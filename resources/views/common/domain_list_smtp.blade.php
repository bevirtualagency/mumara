@if($domain->domain_status == 1 || $unauth_sending_domain != 'on')
<option value="{{ $domain->id }}" {{ (isset($masked_domain_id) && $masked_domain_id == $domain->id) ? 'selected' : '' }}>{{ $domain->tracking_domain }}.{{ $domain->domain }}</option>
@else 
    @php 
       $disableTxt = "inactive";
        if($domain->domain_status == 3) $disableTxt = "authentication failed";
        if($domain->domain_status == 4) $disableTxt = "pending authentication";
       
    @endphp
    <option value="{{ $domain->id }}" {{ (isset($masked_domain_id) && $masked_domain_id == $domain->id) ? 'selected' : '' }}>{{ $domain->tracking_domain }}.{{ $domain->domain }}</option>
@endif