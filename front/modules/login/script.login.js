(function () {
  console.log("login javascript loaded");

  // =============== EVENT HANDLERS ===============
  // request to backend
  $("#btn-login").on("click", function () {
    $.post(
      "back/request_handler.php",
      {
        cmd: "login",
        data: {
          username: "username",
          password: "superSecureP@ssw0rd",
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
})();
