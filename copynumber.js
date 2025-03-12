function copiarNumero() {
  var telefono = "3054293185";
  navigator.clipboard.writeText(telefono).then(
    function () {},
    function (err) {}
  );
}
