@include("header")
<body>
@include("navigation")
  <div class="container-fluid">
        <div class="card">
            <div class="flex-center">
              <form action="http://rolem-warehouse-bv03ddl124056.codeanyapp.com/scanthis" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_stockID" value="{{ $scanid }}">

                <p class="h5 text-center mb-4">Scan for Stock Taking #{{$scanid}} <i><small><br><?php echo date('Y-m-d'); ?></small></i></p>

                <div class="md-form">
                    <input type="text" id="inputSAPCode" name="inputSAPCodeN" class="form-control inputs" maxlength="11" placeholder="SAP Code">
                </div>
                <div class="md-form">
                    <input type="text" id="inputSAPLoc" name="inputSAPLocN" class="form-control inputs" placeholder="Location" disabled>
                </div>
                <div class="md-form">
                    <input type="text" id="inputSAPQuantity" name="inputSAPQuantityN" maxlength="11" class="form-control inputs" placeholder="Quantity">
                </div><noscript>
    <a href="next_page.php?nojs=1">Next Page</a>
</noscript>
                <div class="text-center">
                  <button class="btn btn-primary" type="submit">Add to stock</button>
                </div>
              </form>
          </div>
        </div>
  </div>
  @include("footer")