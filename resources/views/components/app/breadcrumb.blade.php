   <!-- Start of Page Header -->
   <div class="login-page">
       <div class="page-header">
           <div class="container">
               <h1 class="page-title mb-0">{{ $name }}</h1>
           </div>
       </div>
       <!-- End of Page Header -->

       <!-- Start of Breadcrumb -->
       <nav class="breadcrumb-nav mt-3 ">
           <div class="container">
               <ul class="breadcrumb" style="background-color: #fff">
                   <li><a href="{{ route('homepage') }}">Home</a></li>
                   <li>{{ $name }}</li>
               </ul>
           </div>
       </nav>
