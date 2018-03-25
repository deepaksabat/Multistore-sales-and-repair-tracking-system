<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-body box-profile">
    <img class="profile-user-img img-responsive img-circle" src="{{ $shop->get_logo() }}" alt="User profile picture">
    <h3 class="profile-username text-center">{{ $shop->name }}</h3>
    <p class="text-muted text-center">Slug: {{ $shop->slug }}</p>

    {{--<a href="{{ route('shop_single', $shop->slug) }}" target="_blank" class="btn btn-success btn-block">View Public Url</a>--}}

    @if(Auth::user()->isShopAdmin())

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Agents </b> <a class="pull-right">{{ $shop->agents->count() }}</a>
      </li>
    </ul>
    @endif

  </div><!-- /.box-body -->
</div><!-- /.box -->


@if(Auth::user()->isShopAdmin())
  <!-- About Me Box -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">About {{ $shop->name }}</h3>
    </div><!-- /.box-header -->



    <div class="box-body">

      <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
      <p class="text-muted">{{ $shop->address }}</p>

    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endif



@if(Auth::user()->isUser())
  <!-- About Me Box -->
  <div class="box box-primary">

    <div class="box-header with-border">
      <h3 class="box-title">About {{ $shop->name }}</h3>
    </div><!-- /.box-header -->
    <div class="box-body">

      <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
      <p class="text-muted">{{ $shop->address }}</p>

    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endif

<input type="hidden" name="shopID" value="{{ $shop->id }}" />