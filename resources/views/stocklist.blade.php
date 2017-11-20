@include("header")
<body>
@include("navigation")
  <div class="container-fluid">
        <!-- <Table> -->
    <div class="row">
      <div class="col s12 m2 l2">
        <div class="card small">
          <div class="card-content">
              <span class="card-title">Create Stock Taking</span>
              
              <form action="{{url('/stock/create')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="md-form">
                    <input type="text" id="inputStockTakingPlant" name="stockTakingPlant" class="form-control">
                    <label for="defaultForm-email">Plant</label>
                </div>
                <div class="md-form">
                    <input type="text" id="inputStockTakingWork" name="stockTakingWork" class="form-control">
                    <label for="defaultForm-email">Work</label>
                </div>
                <div class="text-center">
                  <button class="btn btn-primary" type="submit">Create</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      
      
      
      <div class="col l10">
        <div class="section">
          <h5>Available Stock Takings</h5>
        </div>
        <div class="divider"></div>
              <table class="table striped centered" id="stockTable">
                <tr>
                  <th class="center-align">#</th>
                  <th class="center-align">Creation Date</th>
                  <th class="center-align">Requested By</th>
                  <th class="center-align">Plant</th>
                  <th class="center-align">Workplace</th>
                  <th class="center-align">Status</th>
                  <th class="center-align">Options</th>
                </tr>
                <?php $i = 1; ?>
                @foreach($takings as $take)
                <tr>
                  <td><?php echo $i; $i++; ?></td>
                  <td>{{$take->dateTime}}</td>
                  <td>{{$take->requestedBy}}</td>
                  <td>{{$take->plant}}</td>
                  <td>{{$take->work}}</td>
                  <td>{{($take->status != 1) ? 'Work in Progress' : 'Finished'}}</td>
                  <td>
                  @if($take->finishDateTime === null)
                    <a href="{{url('/scan')}}/{{$take->id}}" class="btn btn-sm btn-primary"><i class="fa fa-barcode"> </i> Participate</a>
                    <a href="{{url('/stock')}}/{{$take->id}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"> </i> View</a>
                  @else
                    <span class="label label-primary">Completed</span>
                  @endif
                  </td>
                </tr>
                @endforeach
              </table>
       </div>
    </div>
  </div>
  @include("footer")