<div class="form-group row" data-name="NJysKUaL">
	<label class="col-form-label pl12 pr15">
	    {{trans('segments.add_new.field.select_broadcast')}}
	</label>
	<div class="col-md-4 pr0" data-name="lQwNcCFX">
	    <select id="opens-clicks-campaign" class="mt-multiselect btn btn-default form-control" data-placeholder="{{trans('segments.add_new.field.choose.campaign')}}" name="opens_clicks_campaign[]" onchange="getCampaignLinks()" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">
	        @foreach ($campaigns as $campaign)
	            <option value="{{ $campaign->id }}" {{ in_array($campaign->id, $selectedOpensClicksCampaignArray) ? 'selected' : '' }}>{{ $campaign->name }}</option>
	        @endforeach
	    </select>
	</div>
</div>