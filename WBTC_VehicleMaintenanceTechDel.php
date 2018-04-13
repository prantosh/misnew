

       <?php
        session_start();
	include('Connections/cstccon.php');
        
        error_reporting(E_ERROR|E_WARNING);
        
        $id1=$_GET['maint_id'];
	
        $sql_itm="delete from cstcmis.maint_tran where id = " . $id1 ;
        $result_itm=mysqli_query($cstccon,$sql_itm);

        
        
       
 ?>
        <script language="javascript">
            alert("Record Deleted Successfuly");
                              
    document.location='WBTC_VehicleMaintenanceTech.php';
       </script>
					
								