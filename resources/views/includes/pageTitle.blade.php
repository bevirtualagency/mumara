<div class="pagetitle" data-name="MFLCQnJa">
    <h4 class="alert-heading">{!! $pageTitle !!}</h4>

    <?php if(isset($pageTitle2) && !empty($pageTitle2)):?>
      <p>{!! $pageTitle2 !!}</p>
    <?php endif;?>

    <?php if(isset($pageTitle3) && !empty($pageTitle3)):?>
      <p>{!! $pageTitle3 !!}</p>
    <?php endif;?>

    <?php if(isset($pageTitle4) && !empty($pageTitle4)):?>
      <?php if(strlen($pageTitle4) > 270):?>
        <p><?php echo substr($pageTitle4, 0, 270) . "... <a href='#'>More</a>" ?></p>
      <?php else: ?>
        <p>{!! $pageTitle4 !!}</p>
      <?php endif; ?>
    <?php endif;?>

    <p>{!! $pageDescription !!}</p>
</div>
@if($adminOnClient)
<div class="pagetitle" data-name="CBuJGRAJ" style="padding: 0;">
    <div class="alert alert-warning" data-name="kQceWPCG" >
        <span class="alert-text">{{isset($alertMsg) ? $alertMsg : trans('common.message.asset_not_allowed')}}: (<a href="{{route('user.edit',$owner->id)}}" target="_blank"><b>{{$owner->name}}</b></a>, {{$owner->id}})</span>
    </div>
</div>
@endif