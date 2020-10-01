(function () {
  console.log("LISTING - sample_module javascript loaded");
  // =============== PRE LOADED DATA ===============
  $.post(
    "back/request_handler.php",
    {
      cmd: "sampleList",
      data: {},
    },
    function (res) {
      if (res.valid) {
        const DOM_table = document.getElementById("tbl-sample");
        populateTable(DOM_table, res.data);
      } else {
        alert(res.message);
      }
    },
    "json"
  ).always(function () {
    // turn off loader if any
  });

  // =============== EVENT HANDLERS ===============
  // BACK TO SAMPLE MODULE MAIN
  $("#btn-back").on("click", function () {
    $.post("front/modules/sample_module/ui.sample_module.php", function (res) {
      $("#app").html(res);
    });
  });

  // =============== FUNCTIONS ===============
  function populateTable(dom_element, data) {
    let template = ``;
    if (data.length != 0) {
      data.forEach((item) => {
        template += `<tr id="${item.row_id}">
                      <td class="txt-gen_id">${item.generated_id}</td>
                      <td class="txt-name">${item.item_name}</td>
                     </tr>`;
      });
    } else {
      template = `<tr><td colspan="2" style="color:#555555;text-align:center;">No item to display.</td></tr>`;
    }
    // clean table first
    while (dom_element.firstChild) {
      dom_element.removeChild(dom_element.firstChild);
    }

    // repopulate table with new content
    dom_element.innerHTML = template;
  }
})();
