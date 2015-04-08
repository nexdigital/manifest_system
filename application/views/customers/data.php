<script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
          $('#example').dataTable();
           $('#example1').dataTable();
          });

    </script>
<style>

.table-responsive {
width: 100%;
margin-bottom: 15px;
overflow-y: hidden;
-ms-overflow-style: -ms-autohiding-scrollbar;

}

</style>

<div id="wrapper">
 <div id="page-wrapper">
 <div class="table-responsive">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
   <thead>
        <tr>
         <th>Reference ID</th>
         <th>Name</th>
         <th>Sort Name</th>
         <th>Address</th>
         <th>City</th>
         <th>Country</th>
         <th>Email</th>
         <th>Phone</th>
         <th>Due Date Payment</th>
         <th>Action</th>
     </tr>
   </thead>

   <tbody>
         <?php foreach($dataResult as $key => $val)
          {
         echo '<tr>';
          echo "<td>".$val->reference_id."</td>";
          echo "<td>".$val->name."</td>";
          echo "<td>".$val->sort_name."</td>";
          echo "<td>".$val->address."</td>";
          echo "<td>".$val->city."</td>";
          echo "<td>".$val->country."</td>";
          echo "<td>".$val->email."</td>";
          echo "<td>".$val->phone."</td>";
          echo "<td>".$val->due_date_payment."</td>";
          echo "<td><a href='customers/detail/".$val->reference_id."'><i class='glyphicon glyphicon-search' data-toggle='tooltip' data-placement='left' title='View Customer'></i></a></td>";
          echo '</tr>';
         }
         ?>


   </tbody>
</table>
</div>



</div>
</div>
