<!-- Main content -->
<div class="invoice p-3 mb-3">
   <!-- title row -->
   <div class="row">
      <div class="col-12">
         <h4>
            <i class="fas fa-globe"></i> Factura Comercial
            <small class="float-right">Fecha: {{ $invoiceheader->date }}</small>
         </h4>
      </div>
      <!-- /.col -->
   </div>
   <!-- info row -->
   <div class="row invoice-info">
      <div class="col-sm-5 invoice-col">
         Grower Name & Address / Nombre y Dirección Cultivo
         <address>
            <strong>{{ $logistics_company->name }}</strong><br>
            Address: {{ $logistics_company->address }}<br>
            Phone: {{ $logistics_company->phone }}<br>
            RUC: {{ $logistics_company->ruc }}
         </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
         Foreign Purchaser / Comprador Extranjero
         <address>
            <strong>{{ $company[0]->name }}</strong><br>
            Address: {{ $company[0]->address }}<br>
            Phone: {{ $company[0]->phone }}<br>
         </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-3 invoice-col">
         <b>Farm:</b> VF<br>
         <b>Date / Fecha:</b> {{ $invoiceheader->date }}<br>
         <b>Country:</b> GYE-EC<br>
         <b>Invoice #{{ $invoiceheader->invoice }}</b><br>
         <br>
         <b>BL:</b> {{ $invoiceheader->bl }}<br>
         <b>Carrier:</b> {{ $invoiceheader->carrier }}<br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Serial #</th>
            <th>Description</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>Call of Duty</td>
            <td>455-981-221</td>
            <td>El snort testosterone trophy driving gloves handsome</td>
            <td>$64.50</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Need for Speed IV</td>
            <td>247-925-726</td>
            <td>Wes Anderson umami biodiesel</td>
            <td>$50.00</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Monsters DVD</td>
            <td>735-845-642</td>
            <td>Terry Richardson helvetica tousled street art master</td>
            <td>$10.70</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Grown Ups Blue Ray</td>
            <td>422-568-642</td>
            <td>Tousled lomo letterpress</td>
            <td>$25.99</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
        <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
          Payment
        </button>
        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
          <i class="fas fa-download"></i> Generate PDF
        </button>
      </div>
    </div>
  </div>
  <!-- /.invoice -->