
</div><!-- /.content-wrapper -->


<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2014-2015 {{ Helpers::get_option('company_name') }}.</strong> All rights reserved.
</footer>


<div class="control-sidebar-bg"></div>

</div><!-- ./wrapper -->


    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/admin/') }}/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/') }}/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/admin/') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- jquery raty -->
    <script src="{{ asset('assets/admin/plugins/raty/lib/jquery.raty.js') }}"></script>

    @yield('page-js')

<script type="text/javascript">
    $('div.showRating').raty({
        score: function() {
            return $(this).attr('data-score');
        },
        readOnly: function() {
            return $(this).attr('readonly');
        },
        half: false,
        halfShow : true,
        hints: ['1','2','3','4','5' ],
        starOn      : '{{ asset('assets/admin/plugins/raty/lib/images/star-on.png')  }}',
        starOff      : '{{ asset('assets/admin/plugins/raty/lib/images/star-off.png')  }}',
        starHalf      : '{{ asset('assets/admin/plugins/raty/lib/images/star-half.png')  }}'
    });


    $('div.showRating').click(function(){
        var currentSelector = $(this);
        var rateValue = $(this).find('input[name="score"]').val();
        var shopID = $('input[name="shopID"]').val();
        $.ajax({
            type : 'POST',
            url : '{{ route('post_shop_rating_api')  }}',
            data : { rateValue : rateValue, shopID : shopID },
            success : function( data ){
                currentSelector.append(data.msg);
            }
        });
    });


</script>

  </body>
</html>