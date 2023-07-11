<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
        <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <title>Document</title>
</head>
<body>
        <legend>Donation</legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="donor_name" class="form-control" id="donor_name" value="{{ $donation->donor_name }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">E-Mail</label>
                    <input type="email" name="donor_email" class="form-control" id="donor_email" value="{{ $donation->donor_email }}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Jenis Donasi</label>
                    <input type="text" name="donation_type" class="form-control" id="donation_type" value="{{ $donation->donation_type }}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" name="amount" class="form-control" id="amount" value="{{ $donation->amount }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Catatan (Opsional)</label>
                    <textarea name="note" cols="30" rows="3" class="form-control" id="note" readonly>{{ $donation->amount }}</textarea>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" id="pay-button">Kirim</button>


    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });
    </script>
</body>

</html>
