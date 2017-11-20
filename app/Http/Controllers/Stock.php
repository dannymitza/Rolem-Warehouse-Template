<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\stockTakingResultsModel;
  

class Stock extends Controller
{
    public function DisplayStock($id){
      $stock = \DB::table("warehouse_stock")->where("stockID", "=", $id)
          ->leftJoin("parts", function($join){
            $join->on("parts.sap", "=", "warehouse_stock.sap");
            $join->orOn("parts.client_code", "=", "warehouse_stock.sap");
          })
          ->get(array(
            "parts.SAP",
            "warehouse_stock.quantity",
            "warehouse_stock.rack",
            "warehouse_stock.location",
            "warehouse_stock.slot",
            "parts.material",
            "parts.client_code",
            "parts.veneer",
            "parts.carline"
          ));
      
      $stockStatus = \DB::table("stockTaking")->where("id", "=", $id)->pluck("status");
      
      return view('stock')->withStock($stock)->withUid($id)->withStatus($stockStatus[0])->withResults($this->stockTakingResults("11"));
    }
  
    public function CreateStockScreen(){
      $stockTakings = \DB::table("stockTaking")->get();
      return view('stocklist')->withTakings($stockTakings);
    }
  
    public function addStockTaking(Request $request){
      $stockTakingPlant = $request->input('stockTakingPlant');
      $stockTakingWork = $request->input('stockTakingWork');
      $stockTakingDateTime = date('Y-m-d H:i:s');
      
      $stockTakingObject = new \App\StockTakings;
      
      $stockTakingObject->plant = $stockTakingPlant;
      $stockTakingObject->work = $stockTakingWork;
      $stockTakingObject->dateTime = $stockTakingDateTime;
      
      $stockTakingObject->save();
      
      return $this->CreateStockScreen();
      
    }
  
    public function makeTotalStock($id){
      if($id != null){ // If we defined an stock ID, proceed
        
        //Select all rows from warehouse_stock based on $this->stockID
        $warehouseStockData = \DB::table('warehouse_stock')->where("stockID", "=", $id)->get();
        
        if($warehouseStockData == null){
          abort(404);
        } else { // There are results
          foreach($warehouseStockData as $stockRow){ // Iterate through results
            
            // Select SAP number based on warehouse_stock SAP (That should be entry, not SAP, but w/e)
            $getSAPCode = \DB::table('parts')->where("sap", "=", $stockRow->sap)->pluck("sap");
            
            if(is_null($getSAPCode)){ // SAP for this code, handle error laterrr
              echo "NO GETSAPCODE";
            } else { // We got the SAP code, YEY!!!
              
              // Let's check for stockResults if there is already this SAP Code
              $stockResultsQuery = \DB::table('stockTakingResults')->where("SAP", "=", $getSAPCode[0])->get();
              
              if($stockResultsQuery == null){ // No results, let create a row
                $stockResultsEntry = new stockTakingResultsModel;
                
                $stockResultsEntry->sap = $getSAPCode[0];
                $stockResultsEntry->quantity = $stockRow->quantity;
                $stockResultsEntry->locations = $stockRow->location . "-" . $stockRow->slot . ";";
                $stockResultsEntry->stockID = $id;
                
                $stockResultsEntry->save();
              } else { // There is already an entry with this SAP code, update the quantity
                // Create database object for this table
                $stockResultsEntry = new stockTakingResultsModel;
                
                // Add lastest quantity
                $stockResultsEntry->where("sap", "=", $getSAPCode[0])->increment("quantity", $stockRow->quantity);
                
                // Get that damn locations that are already for the parts
                $stockResultsEntryLocation = $stockResultsEntry->where("sap", "=", $getSAPCode[0])->pluck("locations");
                
                // Update locations to include the last addition
                \DB::update(\DB::raw("UPDATE `stockTakingResults` SET `locations` = '" . $stockResultsEntryLocation[0] . $stockRow->rack . "-" . $stockRow->location . "-" . $stockRow->slot . ";' WHERE `sap` = '" . $getSAPCode[0] . "';"));
                
                // Update stock taking status to complete
                \DB::table("stockTaking")->where("id", "=", $id)->update(["status" => 1]);
                
              }
              
            }
            
            //echo "Warehouse SAP: " . $stockRow->sap . "<br>";
            //echo "Parts SAP: " . $getSAPCode[0] . "<hr>";
            
          }
        }
        
        
        return redirect()->action('Stock@CreateStockScreen');
      } else {
        echo "404";
      }
    }
  
    public function stockTakingResults($id){
      if($id != null){ // We have a defined stock
        $stockTakingResults = \DB::table("stockTakingResults")->where("stockID", "=", $id)
          ->leftJoin("parts", function($join){
            $join->on("parts.sap", "=", "stockTakingResults.sap");
          })->get(array(
            "parts.SAP",
            "stockTakingResults.quantity",
            "stockTakingResults.id",
            "stockTakingResults.locations",
            "parts.material",
            "parts.client_code",
            "parts.veneer",
            "parts.carline",
          ));
        return $stockTakingResults;
      }
    }
    
    public function exportStockTakingResultsToExcel($take){
      // Get date and time for stock taking creation
      $getStockTakingDate = \DB::table("stockTaking")->where("id", "=", "1")->pluck("dateTime");
      
      // Create Excel file
      \Excel::create('Stock-Taking' . $getStockTakingDate[0], function($excel) {
        
        // Get work place for stock taking
        $getStockTakingWork = \DB::table("stockTaking")->where("id", "=", "1")->pluck("work");
        
        // Create sheet
        $excel->sheet('Plant - ' . $getStockTakingWork[0], function($sheet) {

        // Get stock taking results data
        $results = $this->stockTakingResults($take);
        $count = count($results);
          
            // I dont know why I didn't use ->toArray, but it converts the results from object to array
            foreach($results as $result){
              $data[] = array(
                $result->SAP,
                $result->client_code,
                $result->material,
                $result->veneer,
                $result->quantity,
              );
            }
            
            // Get plant for stock taking
            $getStockTakingPlant = \DB::table("stockTaking")->where("id", "=", "1")->pluck("plant");
          
            // Create Excel table headers
            $headings = array('SAP Code', 'Client Code', 'Material', 'Veneer', $getStockTakingPlant[0]);
            
            // Insert them to sheet
            $sheet->fromArray($data, null, 'A1', false, false)
              ->prependRow(1, $headings);
          
            // Set border and text align for each row of values
            for($i = 1; $i <= $count + 1; $i++){
              $area = "A" . $i . ":E" . $i;
              $sheet->setBorder($area, 'thin');
              $sheet->cell('E' . $i, function($cell){
                $cell->setAlignment('center');
              });
            }
          
            // Bold up the headers
            $sheet->cell('A1:E1', function($cell){
              $cell->setFontWeight('bold');
            });
          
            // Modify cell color and font color for "Quantity" column header
            $sheet->cell('E1', function($cell){
              $cell->setBackground('#E60000');
              $cell->setFontColor('#ffffff');
            });
        });
      })->export('xls'); // Export file to download
      
      ob_end_clean(); // Clean server memory
      
    }
  
    public function exportStockTakingResultsToPDF($id){
      $results = $this->stockTakingResults("1");
      return view("viewpdf")->withData($results);
    }
    
}
