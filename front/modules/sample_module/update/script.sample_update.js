(function () {
  console.log("UPDATE - sample_module javascript loaded");
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

  // FORM SUBMITION
  $("#frm-update").submit(function (e) {
    e.preventDefault();
    const itemName = $("#txt-item_name").val();
    const rowID = $("#_txt-row_id").val();

    if (rowID != "") {
      if (
        itemName != "" &&
        itemName != $("#" + rowID + " .txt-name")[0].innerHTML
      ) {
        $.post(
          "back/request_handler.php",
          {
            cmd: "sampleUpdate",
            data: {
              rowID: rowID,
              itemName: itemName,
            },
          },
          function (res) {
            alert(res.message);
            if (res.valid) {
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
            }
          },
          "json"
        ).always(function () {
          // turn off loader if any
        });
      } else {
        alert("No change detected.");
      }
    } else {
      alert("Please select an item.");
    }
  });
})();

// =============== FUNCTIONS ===============
function populateTable(dom_element, data) {
  let template = ``;
  if (data.length != 0) {
    data.forEach((item) => {
      template += `<tr id="${item.row_id}">
                    <td class="txt-gen_id">${item.generated_id}</td>
                    <td class="txt-name">${item.item_name}</td>
                    <td>
                      <button type="button" onClick="setSelected(${item.row_id});">SELECT</button>
                    </td>
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

function setSelected(row_id) {
  const gen_id = $("#" + row_id + " .txt-gen_id")[0].innerHTML;
  const item_name = $("#" + row_id + " .txt-name")[0].innerHTML;

  $("#_txt-row_id").val(row_id);
  $("#txt-gen_id").val(gen_id);
  $("#txt-item_name").val(item_name);
}
