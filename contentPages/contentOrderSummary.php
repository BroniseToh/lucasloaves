<div class="container">
    <h3 class="text-center">Order Summary</h3>
    <p><strong>Order number: </strong><span id="orderNumber"></span></p>
    <p><strong>Customer name: </strong><span id="customerName"></span></p>
    <p><strong>Order date and time: </strong><span id="orderDateAndTime"></span></p>
    
    <table class="table mx-auto">
      <thead>
        <tr>
          <th scope="col">Item</th>
          <th scope="col">Unit Price</th>
          <th scope="col">Quantity Ordered</th>
          <th scope="col">Total</th>
          <th scope="col">Pick-up date</th>
          <th scope="col">Pick-up time</th>
        </tr>
      </thead>
      <tbody>
        <!-- INSERT RECORDS HERE -->
        <tr class="grandTotalRow">
          <th scope="col" colspan="3">Grand Total: </th>
          <th scope="col" colspan="3" id="grandTotal"></th>
        </tr>
      </tbody>
    </table>
</div><!-- <div class="container"> -->