(function () {
  console.log("CREATE - sample_module javascript loaded");

  // =============== EVENT HANDLERS ===============
  // BACK TO SAMPLE MODULE MAIN
  $("#btn-back").on("click", function () {
    $.post("front/modules/sample_module/ui.sample_module.php", function (res) {
      $("#app").html(res);
    });
  });

  // FORM SUBMITION
  $("#frm-create").submit(function (e) {
    e.preventDefault();
    const itemName = $("#txt-item_name").val();
    if (itemName != "") {
      $.post(
        "back/request_handler.php",
        {
          cmd: "sampleCreate",
          data: {
            itemName: itemName,
          },
        },
        function (res) {
          alert(res.message);
          if (res.valid) {
            $.post(
              "front/modules/sample_module/ui.sample_module.php",
              function (res) {
                $("#app").html(res);
              }
            );
          }
        },
        "json"
      ).always(function () {
        // turn off loader if any
      });
    }
  });
})();
