function copiarPaypal() {
  var paypal = "YSXRZMT2AAG4G";
  navigator.clipboard.writeText(paypal).then(
    function () {},
    function (err) {}
  );
}
