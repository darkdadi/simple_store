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
</style>

<div>
  LISTING - sample_module UI loaded
  <div class="margin-top">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody id="tbl-sample"></tbody>
    </table>
  </div>
  <div>
    <button type="button" id="btn-back">BACK TO SAMPLE MODULE</button>
  </div>
</div>
<script src="front/modules/sample_module/list/script.sample_list.js"></script>