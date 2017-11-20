<html>
  <h1>
    SAP Stock Taking - Results Sheet
  </h1>
  <table width="100%" border="1px" style="border-collapse:collapse;">
    <tr>
      <th align="center">SAP</th>
      <th align="center">Material</th>
      <th align="center">Veneer</th>
      <th align="center">Quantity</th>
    </tr>
      @foreach($data as $PDFrow)
    <tr>
        <td align="center">{{$PDFrow->SAP}}</td>
        <td>{{$PDFrow->material}}</td>
        <td align="center">{{$PDFrow->veneer}}</td>
        <td align="center">{{$PDFrow->quantity}}</td>
    </tr>
      @endforeach
  </table>
</html>