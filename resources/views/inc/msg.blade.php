

   
              @if( session('success') )
                <div class="alert alert-primary alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong> {{ session('success') }} </strong> 
                </div>
              @elseif( session('error') )
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong> {{ session('error') }} </strong> 
                </div>
              @endif