<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-body box-profile">
    <img class="profile-user-img img-responsive img-circle" src="{{ $shop->get_logo() }}" alt="User profile picture">
    <h3 class="profile-username text-center">{{ $shop->name }}</h3>
    <p class="text-muted text-center">Slug: {{ $shop->slug }}</p>

      {{--
    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Agents </b> <a class="pull-right">{{ $shop->agents->count() }}</a>
      </li>
    </ul>

    <a href="{{ route('shop_single', $shop->slug) }}" target="_blank" class="btn btn-success btn-block">View Public Url</a>--}}

    {{--
    <hr />

    {!! Form::open(['route' => ['changeShopStatus', $shop->id] ]) !!}
    @if($shop->status == 1)
      <button class="btn btn-danger btn-block"><b>Block</b></button>
      <input type="hidden" name="shopStatus" value="2">
    @else
      <button class="btn btn-success btn-block"><b>Active</b></button>
      <input type="hidden" name="shopStatus" value="1">
    @endif
    {!! Form::close() !!}--}}
  </div><!-- /.box-body -->
</div><!-- /.box -->

<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">About Shop</h3>
  </div><!-- /.box-header -->
  <div class="box-body">


      <div class="list-group">
          <a href="{{ route('admin_shop_view', $shop->id) }}" class="list-group-item {{ Request::is('administrator/shop/*/view') ? 'active':'' }}">
              Overview
          </a>
          <a href="{{ route('admin_shop_products', $shop->id) }}" class="list-group-item {{ Request::is('administrator/shop/*/products') ? 'active':'' }}">
              Products
          </a>
          <a href="{{ route('admin_shop_stocks', $shop->id) }}" class="list-group-item {{ Request::is('administrator/shop/*/stocks') ? 'active':'' }}">
              Stock
          </a>
      </div>

    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
    <p class="text-muted">{{ $shop->address }}</p>

  </div><!-- /.box-body -->
</div><!-- /.box -->