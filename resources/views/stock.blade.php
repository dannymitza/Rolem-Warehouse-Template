@include("header")
<body>
@include("navigation")
  <div class="container">
    <div class="row">
       <ul id="tabs-swipe-demo" class="tabs">
          <li class="tab col s3"><a class="active" href="#stockTakingInDepth">In Depth</a></li>
          <li class="tab col s3"><a href="#stockTakingResults">Results</a></li>
        </ul>
        <div id="stockTakingInDepth" class="col s12">
          <table class="table table-striped table-fluid" id="stockTable">

            <!-- <Table head> -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>SAP Code</th>
                    <th>Client's Code</th>
                    <th>Material</th>
                    <th>Veneer</th>
                    <th>Quantity</th>
                    <th>Location</th>
                </tr>
            </thead>
            <!--/ <Table head> -->
            <?php $i = 1; ?>
            <!-- <Table body> -->
            <tbody id="stockRow">
             @foreach($stock as $part)
                <!-- Display each line of stock -->
                <tr>
                  <td>
                    <?php echo $i; $i++; ?>
                  </td>
                  <td>{{$part->SAP }}</td>
                  <td>{{$part->client_code}}</td>
                  <td>{{$part->material}}</td>
                  <td>{{$part->veneer}}</td>
                  <td>{{$part->quantity}}</td>
                  <td>{{$part->rack}}-{{$part->location}}-{{$part->slot}}</td>
                </tr>
                <!-- Finish displaying line of stock -->
              @endforeach
            </tbody>
          <!-- </Table body> -->
        </table>
        @if( $status == 0)
          <a href="{{ url('/stock/maketotal') }}/{{ $uid }}" class="btn btn-danger pull-right red">Make Totals</a>
        @endif
       </div>
      <div id="stockTakingResults" class="col s12 l12"><table class="table table-striped table-fluid" id="stockTable">

            <!-- <Table head> -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>SAP Code</th>
                    <th>Client's Code</th>
                    <th>Material</th>
                    <th>Veneer</th>
                    <th>Quantity</th>
                    <th>Location</th>
                </tr>
            </thead>
            <!--/ <Table head> -->
            <?php $i = 1; ?>
            <!-- <Table body> -->
            <tbody id="stockRow">
             @foreach($results as $result)
                <!-- Display each line of stock -->
                <tr>
                  <td>
                    <?php echo $i; $i++; ?>
                  </td>
                  <td>{{$result->SAP }}</td>
                  <td>{{$result->client_code}}</td>
                  <td>{{$result->material}}</td>
                  <td>{{$result->veneer}}</td>
                  <td>{{$result->quantity}}</td>
                  <td><a data-target="locations-{{ $result->id }}" class="btn btn-small blue modal-trigger">View Locations</a></td>
                </tr>
                <!-- Finish displaying line of stock -->
              @endforeach
            </tbody>
          <!-- </Table body> -->
        </table>
      </div>
    </div>
  </div>
  
@foreach($results as $result)
 <?php $locationsArray = explode(";", $result->locations); ?>
  @foreach($locationsArray as $location)
    <div id="locations-{{$result->id}}" class="modal">
    <div class="modal-content">
      <h4>Locations for {{$result->quantity}}x[{{$result->SAP}}]</h4>
      <p><span class="new badge red" data-badge-caption="">{{$location}}</span></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-3">Agree</a>
    </div>
  </div>
  @endforeach
@endforeach
  
  @include("footer")