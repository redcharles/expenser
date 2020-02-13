<pre>
<?php 
// print_r($user); exit;
$charges = [];
foreach($user as $k => $v){
    // print_r($v->BillAddr->Line4);
    // print_r($v); exit;
    $balance = $v->Balance;
    $lineItems = [];
    foreach($v->Line as $k => $v){
        $lineItems[] = [
            'Description' => $v->Description,
            'Amount'      => $v->Amount,
        ];
    }
    $billInfo = new stdClass();
    $CitStateZip = $v->BillAddr->Line4;
    if(property_exists('v', 'BillAddr')){
        $billInfo->Customer = $v->BillAddr->Line2;
        $billInfo->Address = $v->BillAddr->Line3 . ' ' . $v->BillAddr->Line4;
    }
    
    $billInfo->LineItems = $lineItems;
    $charges[] = $billInfo;
}
print_r($charges);
// print_r($user);

?>
</pre>