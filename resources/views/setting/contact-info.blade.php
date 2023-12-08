<title>Contact Info</title>
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    table tbody, table thead
{
    display: block;
}
table tbody 
{
   overflow: auto;
   height: 300px;
}
</style>
<div class="container" data-name="iywAbPSa">
    <div class="row" data-name="RNrjZFPi">
        <div class="col-md-6 col-md-offset-3" data-name="AQVRIpGq">
            <div class="panel panel-login" data-name="JdgqgZKc">
                <center><h1>{{trans('settings.heading.contact')}}</h1></center>
                <div class="panel-body" data-name="ioNWAosT">
                    <div class="row" data-name="djTCaorw">
                        <div class="col-md-8 col-md-offset-2" data-name="JEaogNVJ">
                            <form action="{{ route('setting.contact.info') }}" method="post" role="form" style="display: block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group" data-name="jTJMVOkM">
                                    <input type="text" name="part_1" required tabindex="1" class="form-control" placeholder="Message id Part 1" value="{{isset($part_1) ? $part_1 : '' }}">
                                </div>
                                <div class="form-group" data-name="dmnoeKyU">
                                    <input type="text" name="part_2" tabindex="2" class="form-control" placeholder="Message id Part 2" value="{{isset($part_2) ? $part_2 : '' }}">
                                </div>
                                <center><button type="submit" class="btn btn-primary">{{trans('settings.button.submit')}}</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($results) && $results->count() > 0)
    <div class="row col-md-4 col-md-offset-4 custyle" data-name="wYMebjdI">
        <table class="table table-striped custab">
        <thead>
            <tr>
                <th>{{trans('settings.id_s')}}</th>
                <th style="padding-left: 50%">{{trans('settings.email_s')}}</th>
            </tr>
        </thead>
            @foreach($results as $result)
                <tr>
                    <td>{{$result->id}}</td>
                    <td>{{$result->email}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @elseif(isset($results))
    <center>Not Found</center>
    @endif
</div>