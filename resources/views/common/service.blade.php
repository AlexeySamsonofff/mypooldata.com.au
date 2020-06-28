@extends('common_layout')
@section('common_content') 

<div>
<img class="content-img" src="/public/img/w2.jpg">
</div> 
<div>
<p id="pool_div" ></p>
<input type="hidden" id="startdate">
<input type="hidden" id="enddate">
</div>




   <section class="content">
      <div class="container-fluid">
        </div>    
          
        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


@endsection

@section('common_footer')
<footer class="fancy-footer-area fancy-bg-dark myfooter">
    <div class="footer-content section-padding-80-50">
        <div class="container">
            <div class="row">
                <!-- Footer Widget -->
               
                <div class="col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Link Categories</h6>
                        <nav>
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> PH</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> ORP</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Temperature</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Chlorine</a></li>
                               
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Footer Widget -->
                <div class="col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Contact Us</h6>
                        <p>info@brauerindustries.com/
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copywrite -->
    <div class="footer-copywrite-area myfooterdiv_d">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <div class="copywrite-content h-100 d-flex align-items-center justify-content-between">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | Swimming Pool<i class="fa fa-heart-o" aria-hidden="true"></i> 
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection

@section('common_js')
<script src="/public/upload/history.js"></script>

@endsection
