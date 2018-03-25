
<div class="box box-widget widget-user-2">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-yellow">
    <div class="widget-user-image">
      <img class="img-circle" src="http://placehold.it/100X100" alt="User Avatar">
    </div><!-- /.widget-user-image -->
    <h3 class="widget-user-username">{{ $agent->get_fullname() }}</h3>
    {{--<h5 class="widget-user-desc">Lead Developer</h5>--}}
  </div>
  <div class="box-footer no-padding">
    <ul class="nav nav-stacked">
      <li><a href="#">Total Earned <span class="pull-right badge bg-blue">{{ $agent->earningByShop($lShop->id)}} </span></a></li>
      <li><a href="#">Cash Payout <span class="pull-right badge bg-aqua">{{ $agent->cash_payout_by_shop($lShop->id)}} </span></a></li>
      <li><a href="#">Store Credit <span class="pull-right badge bg-green">{{ $agent->store_credit_by_shop($lShop->id)}} </span></a></li>
      <li><a href="#">Total Due <span class="pull-right badge bg-red">{{ $agent->earning_due_by_shop($lShop->id)}} </span></a></li>
    </ul>
  </div>
</div><!-- /.widget-user -->





<input type="hidden" name="agentID" value="{{ $agent->id }}" />