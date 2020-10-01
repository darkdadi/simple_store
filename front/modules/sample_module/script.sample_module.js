(function () {
  console.log("sample_module javascript loaded");

  // =============== EVENT HANDLERS ===============
  // request to backend
  $("#btn-logout").on("click", function () {
    $.post(
      "back/request_handler.php",
      {
        cmd: "logout",
        data: {
          username: "username",
        },
      },
      function (res) {
        if (res.valid) {
          window.location.reload(true);
        } else {
          alert("ERROR: see request_handler");
        }
      },
      "json"
    ).always(function () {
      // turn off loader if any
    });
  });

  // CRUD actions
  // LIST
  $("#btn-list").on("click", function () {
    $.post("front/modules/sample_module/list/ui.sample_list.php", function (
      res
    ) {
      $("#app").html(res);
    });
  });
  // CREATE
  $("#btn-create").on("click", function () {
    $.post("front/modules/sample_module/create/ui.sample_create.php", function (
      res
    ) {
      $("#app").html(res);
    });
  });
  // UPDATE
  $("#btn-update").on("click", function () {
    $.post("front/modules/sample_module/update/ui.sample_update.php", function (
      res
    ) {
      $("#app").html(res);
    });
  });
})();
