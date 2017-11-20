@include("header")
<body>
@include("navigation")
  <div class="container-fluid">
        <!-- <Table> -->
    <div class="row">
      <div class="col-12">
        <div class="card">
           <h4 class="card-title d-flex p-2">Create</h4>
            <div class="card-body">
              <table class="table table-striped table-fluid" id="stockTable">
                <tr>
                  <th>#</th>
                  <th>Creation Date</th>
                  <th>Requested By</th>
                  <th>Plant</th>
                  <th>Workplace</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
                <?php $i = 1; ?>
                @foreach($takings as $take)
                <tr>
                  <td><?php echo $i; $i++; ?></td>
                  <td>{{$take->dateTime}}</td>
                  <td>{{$take->requestedBy}}</td>
                  <td>{{$take->plant}}</td>
                  <td>{{$take->work}}</td>
                  <td>{{($take->work != 0 ? 'Work in Progress' : 'Finished')}}</td>
                  <td>
                  @if($take->finishDateTime === null)
                    <a href="{{url('/scan')}}/{{$take->id}}" class="btn btn-small btn-primary">Participate</a>
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
    </div>
  </div>
  @include("footer")