<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }

  table {
    margin-top: 15px;
    margin-bottom: 15px;
  }

  th, td {
    padding: 15px;
    text-align: left;
  }

  .margin-top {
    margin-top:15px;
  }

  .margin-bottom {
    margin-bottom:15px;
  }
</style>

<div>
  UPDATE - sample_module UI loaded
  <div class="margin-top">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th colspan='2'>Name</th>
        </tr>
      </thead>
      <tbody id="tbl-sample"></tbody>
    </table>
  </div>
  <div class="margin-bottom">
    <h3>SELECTED ITEM:</h3>
    <form id="frm-update">
      <input type="hidden" id="_txt-row_id">
      <input type="text" id="txt-gen_id" readonly>
      <input type="text" id="txt-item_name" required>
      <button type="submit">UPDATE ITEM</button>
    </form>
  </div>
  <div>
  <div>
    <button type="button" id="btn-back">BACK TO SAMPLE MODULE</button>
  </div>
</div>
<script src="front/modules/sample_module/update/script.sample_update.js"></script>